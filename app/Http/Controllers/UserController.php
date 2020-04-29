<?php

namespace App\Http\Controllers;

use App\Providers\transport\AuthHandler;
use App\Providers\transport\ProfileHandler;
use App\Providers\transport\NotifierHandler;
use Illuminate\Http\Request;
use Exception;
use App\Models\ResultDto;
use Sentry;

class UserController extends Controller {

    const TMP_TOKEN_SALT = 'cZpxu4DA';

    /**
     * @var AuthHandler
     */
    private $authHandler;

    private $profileHandler;

    private $notifierHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->authHandler = new AuthHandler(getenv('AUTH_URI'));
        $this->profileHandler = new ProfileHandler(getenv('BIZ_URI'));
        $this->notifierHandler = new NotifierHandler(getenv('NOTIFIER_URI'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function login(Request $request) {
        $this->requestHas($request, ['login', 'password']);

        $login = $request->get('login');
        $password = $request->get('password');

        $phoneCountryCode = $request->get('phoneCountryCode') ?? '7';

        try {
            $resProfile = $this->profileHandler->loginUser(
                [
                    'login' => $login,
                    'password' => $password,
                    'phoneCountryCode' => $phoneCountryCode
                ]
            );
        } catch (Exception $e) {
            Sentry\captureException($e);
            return ResultDto::createResult($e->getCode(), $e->getMessage());
        }

        if (!$resProfile->isSuccess()) {
            $this->sentryAbort(new Exception($resProfile->getMessage(), $resProfile->getRes()));
        }

        $responseClientProfile = $resProfile->getData();
        $user_id = $responseClientProfile['userId'];

        $resAuth = $this->authHandler->login(['id' => $user_id]);

        if (!$resAuth->isSuccess()) {
            $this->sentryAbort(new Exception($resProfile->getMessage(), $resProfile->getRes()));
        }

        return $this->responseJSON($resAuth);
    }


    /**
     * @param Request $request
     * @return array
     * @throws \App\Providers\Exceptions\IncorrectLoginException
     */
    public function registration(Request $request) {
        $this->requestHas($request, ['login']);


        $login = $request->get('login');
        $resProfile = $this->profileHandler->createUser([
            'login' => $login
        ]);

        $profileData = $resProfile->getData();

        if (!isset($profileData['hash'])) {
            $this->sentryAbort(new Exception($resProfile->getMessage(), $resProfile->getRes()));
        }

        $hashOrSmsCode = $profileData['hash'];
        $resNotifier = null;
        $resEmailNotifier = null;

        $data = [
            'secret' => $hashOrSmsCode
        ];

        if (ProfileHandler::loginIsEmailOrPhone($login) === 'email') {
            //notifier
            // отправка проверочного hash
            $emailActivationUri = env('EMAIL_ACTIVATION_URI');

            $data['sendEmailResult'] = $this->notifierHandler
                ->sendEmailHash($profileData['userId'], $hashOrSmsCode, $emailActivationUri, $login)
                ->getResult();
        } else {
            //notifier
            // отправка проверочного кода
            $country_code = $request->get('phoneCountryCode') ?? '7';

            $data['sendSmsResult'] = $this->notifierHandler
                ->sendSmsCode($profileData['userId'], $hashOrSmsCode, $country_code . $login)
                ->getResult();
        }

        return $this->responseJSON(new ResultDto(200, 'Success create', $data));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUser(Request $request) {
        return $this->responseJSON($this->profileHandler->getUser(['id' => $request->user()->getId()]));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUsers(Request $request) {
        $auth = $this->getAuthUser($request);

        if (!$auth->isSuccess()) {
            return $auth->getResult();
        }

        return $this->responseJSON($this->profileHandler->getUsers([]));
    }

    /**
     * @param Request $request
     * @return ResultDto
     */
    private function getAuthUser(Request $request): ResultDto {
        $token = $request->header('authorization');

        if (empty($token)) {
            abort(403, 'Permission denied');
        }

        return $this->authHandler->validateToken([
            'token' => trim(str_replace("Bearer", "", $token))
        ]);
    }

    /**
     * get user fields for create or update user in profile service
     *
     * @return array
     */
    private function getUserFields() {
        return [
            'name',
            'lastName',
            'patronymic',
            'gender',
            'birthDate',
            'countryId',
            'regionId',
            'cityId',
            'timezone',
            'currencyId',
            'languageId'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updateUser(Request $request) {
        $this->requestHas($request, $this->getUserFields());

        $requestParams = [
            'id' => $request->user()->getId()
        ];

        foreach ($this->getUserFields() as $field) {
            $requestParams[$field] = $request->get($field);
        }

        return $this->responseJSON($this->profileHandler->updateUser($requestParams));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function setPasswordApplyByPhone(Request $request) {
        $resSetPassword = $this->profileHandler->setPasswordApplyByPhone(
            $this->getRequestFields($request, ['password', 'rePassword', 'code', 'phone'])
        );

        //TODO выполняет запрос верно, но отвечает 500
        if ($resSetPassword->isSuccess()) {
            return $this->responseJSON(
                $this->authHandler->login(['user_id' => $resSetPassword->getData()['userId']])
            );
        } else {
            $this->sentryAbort(new Exception($resSetPassword->getMessage(), $resSetPassword->getRes()));
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function setPasswordApplyByEmail(Request $request) {
        $profileHandler = $this->profileHandler->setPasswordApplyByEmail(
            $this->getRequestFields($request, ['password', 'rePassword', 'hash'])
        );

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        //TODO выполняет запрос верно, но отвечает 500
        return $this->responseJSON($this->authHandler->login(['user_id' => $profileHandler->getData()['userId']]));
    }


    /**
     * add not active email and push hash
     * @param Request $request
     * @return array
     */
    public function changeEmail(Request $request) {
        $this->requestHas($request, 'email');

        $userId = $request->user()->getId();
        $email = $request->get('email');
        $profileHandler = $this->profileHandler->addNotActiveEmailToUser([
            'userId' => $userId,
            'email' => $email
        ]);

        if ($profileHandler->isSuccess()) {
            $emailActivationUri = env('EMAIL_ACTIVATION_URI');

            if (empty($emailActivationUri)) {
                abort(500, 'Missing env parameter for email activation uri');
            }

            $notifierHandler = $this->notifierHandler->sendEmailHash(
                $userId,
                $profileHandler->getData()['hash'],
                $emailActivationUri . 'notpswd/',
                $email
            );

            return $this->responseJSON(
                new ResultDto(200, $profileHandler->getMessage(), array_merge(
                    $profileHandler->getData(),
                    [
                        'sendEmailResult' => $notifierHandler->getResult()
                    ]
                ))
            );
        } else {
            abort(400, $profileHandler->getMessage());
        }
    }

    /**
     * activate email and delete old emails
     * @param Request $request
     * @return array
     */
    public function activateEmail(Request $request) {
        $this->requestHas($request, ['hash']);
        $profileHandler = $this->profileHandler->activateEmail(['hash' => $request->get('hash')]);

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        return $this->responseJSON($profileHandler);
    }

    /**
     * add not active phone and push hash
     * @param Request $request
     * @return array
     */
    public function changePhone(Request $request) {
        $this->requestHas($request, ['phone', 'country_code']);

        $number = $request->get('phone');
        $countryCode = $request->get('country_code');

        $profileHandler = $this->profileHandler->addNotActivePhoneToUser([
            'phone' => $number,
            'userId' => $request->user()->getId(),
            'country_code' => $countryCode
        ]);

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $profileData = $profileHandler->getData();

        //notifier
        // отправка проверочного кода
        $phoneNumber = $countryCode . $number;

        $resNotifier = $this->notifierHandler->sendSmsCode($profileData['userId'], $profileData['hash'], $phoneNumber);
        $data = $profileHandler->getResult();
        $data['sendSmsResult'] = $resNotifier->getResult();

        return $this->responseJSON(new ResultDto(200, $profileHandler->getMessage(), $data));
    }

    /**
     * activate phone and delete old phones numbers
     * @param Request $request
     * @return array
     */
    public function activatePhone(Request $request) {
        return $this->responseJSON($this->profileHandler->activatePhone(
            $this->getRequestFields($request, ['phone', 'code'])
        ));
    }

    /**
     * generate new hash for email after can set new password
     * @param Request $request
     * @return array
     */
    public function resetEmail(Request $request) {
        $this->getRequestFields($request, ['email']);

        $email = $request->get('email');

        $res = $this->profileHandler->generateNewHashEmail(['email' => $email]);

        if (!$res->isSuccess()) {
            $this->sentryAbort(new Exception($res->getMessage(), $res->getRes()));
        }

        $emailActivationUri = env('EMAIL_ACTIVATION_URI');

        $result = $res->getResult();
        $result['notifier'] = $this->notifierHandler->sendEmailHash(0, $res->getData()['hash'], $emailActivationUri, $email)->getResult();

        return $this->responseJSON(new ResultDto(200, $res->getMessage(), $result));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function resetPhone(Request $request) {
        $this->requestHas($request, ['phone', 'country_code']);

        $phone = $request->get('phone');
        $countryCode = $request->get('country_code');

        $profileHandler = $this->profileHandler->generateNewHashPhone(['phone' => $phone, 'country_code' => $countryCode]);

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $hash = $profileHandler->getData()['hash'];

        if (empty($hash)) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $phoneNumber = $countryCode . $phone;
        $resNotifier = $this->notifierHandler->sendSmsCode(0, $hash, $phoneNumber)->getResult();
        $resNotifier['hash'] = $hash;

        return $this->responseJSON(
            new ResultDto(200, $profileHandler->getMessage(), ['sendSmsResult' => $resNotifier])
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function setPushToken(Request $request) {
        return $this->responseJSON(
            $this->profileHandler->setPushToken(
                array_merge(
                    ['user_id' => $request->user()->getId()],
                    $this->getRequestFields($request, ['push_token', 'is_android', 'device_id', 'device_brand'])
                )
            )
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function addPay(Request $request) {
        return $this->responseJSON(
            $this->profileHandler->addPay(array_merge(
                ['user_id' => $request->user()->getId()],
                $this->getRequestFields($request, ['ammount', 'orderId'])
            ))
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function deleteUserByPhone(Request $request) {
        return $this->responseJSON(
            $this->profileHandler->deleteUserByPhone(
                $this->getRequestFields($request, ['phone'])
            )
        );
    }

    /**
     * Registration user from promo app
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function registrationPromo(Request $request) {
        $this->requestHas($request, [
            'userName',
            'email',
            'phone',
            'os'
        ]);


        $res = $this->profileHandler->createUserFromPromo(
            $this->getRequestFields($request, [
                'regId',
                'senderId',
                'isNotifier'
            ])
        )->getData();

        if (!isset($res['hash'])) {
            throw new Exception('Fail service create ticket');
        }

        $resNotifier = $this->notifierHandler->sendSmsCode($res['userId'], $res['smsCode'], $request->get('phone'));
        $resEmailNotifier = null;

        if (isset($res['hashEmail'])) {

            $resEmailNotifier = $this->notifierHandler->sendEmailHash(
                $res['userId'],
                $res['hashEmail'],
                env('EMAIL_ACTIVATION_URI'),
                $request->get('email')
            );
        }

        $data = [
            'responseData' => $res,
            'input' => $this->getRequestFields(),
            'sendSmsResult' => $resNotifier
        ];

        if ($resEmailNotifier) {
            $data['sendEmailResult'] = $resEmailNotifier;
        }

        return $this->responseJSON(new ResultDto(200, 'Success create', $data));
    }

    /**
     * Short registration on mobile app
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function mobileCreateUser(Request $request) {
        //biz
        $profileHandler = $this->profileHandler->mobileCreateUser($this->getRequestFields(
            $request,
            ['phone', 'phoneCountryCode']
        ));

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $hashOrSmsCode = $profileHandler->getData()['hash'];

        if (empty($hashOrSmsCode)) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        //notifier
        // отправка проверочного кода
        $countryCode = $request->get('phoneCountryCode') ?? '7';
        $phone = $request->get('phone');

        $resNotifier = $this->notifierHandler->sendSmsCode(
            $profileHandler->getData()['userId'],
            $hashOrSmsCode,
            $countryCode . $phone
        );

        return $this->responseJSON(new ResultDto(200, 'Success', [
            'secret' => $hashOrSmsCode,
            'sendSmsResult' => $resNotifier
        ]));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function mobileRegistartionUser(Request $request) {
        $retProfile = $this->profileHandler->mobileRegistartionUser(
            $this->getRequestFields($request, [
                'phone',
                'phoneCountryCode',
                'code',
                'name'
            ])
        );

        if (!$retProfile->isSuccess()) {
            $this->sentryAbort(new Exception($retProfile->getMessage(), $retProfile->getRes()));
        }

        return $this->responseJSON($this->authHandler->login([
            'id' => $retProfile->getData()['userId']
        ]));
    }


    /**
     * @param Request $request
     * @return array
     */
    public function mobileConfirmTerm(Request $request) {
        $token = $request->header('authorization');
        if (empty($token)) {
            abort(403, 'Permission denied');
        }

        $token = trim(str_replace("Bearer", "", $token));
        $token = substr($token, 0, -strlen(self::TMP_TOKEN_SALT));

        $userId = $this->authHandler->validateToken(['token' => $token])->getData()['user_id'];

        return $token-$this->responseJSON($this->profileHandler->mobileConfirmTerm(['userId' => $userId]));
    }


    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function getSmsCode(Request $request) {
        $profileHandler = $this->profileHandler->getSmsCode(
            $this->getRequestFields($request, [
                'phone',
                'phoneCountryCode'
            ])
        );

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $hashOrSmsCode = $profileHandler->getData()['hash'];

        if (empty($hashOrSmsCode)) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        //notifier
        // отправка проверочного кода
        $countryCode = $request->get('phoneCountryCode') ?? '7';
        $phone = $request->get('phone');
        $result = $this->notifierHandler->sendSmsCode(0, $hashOrSmsCode, $countryCode . $phone)->getResult();
        $result['hash'] = $hashOrSmsCode;
        return $this->responseJSON(200, 'Sms code', $result);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function mobileLogin(Request $request) {
        $profileHandler = $this->profileHandler->mobileLoginUser(
            $this->getRequestFields($request, [
                'phone',
                'phoneCountryCode',
                'code'
            ])
        );

        if (!$profileHandler->isSuccess()) {
            $this->sentryAbort(new Exception($profileHandler->getMessage(), $profileHandler->getRes()));
        }

        $data = $profileHandler->getData();
        $confirmTerm = $data['confirmTerm'];

        $authHandler = $this->authHandler->login(['id' => $data['userId']]);

        if (!$authHandler->isSuccess()) {
            $this->sentryAbort(new Exception($authHandler->getMessage(), $authHandler->getRes()));
        }

        $token = $authHandler->getData()['token'];

        if ($confirmTerm == 0) {
            $token = $token . self::TMP_TOKEN_SALT;
        }

        return $this->responseJSON(
            new ResultDto(200, 'Confirm OK', [
                'token' => $token,
                'confirmTerm' => $confirmTerm
            ])
        );
    }
}
