<?php

namespace App\Providers\transport;

use App\Models\ResultDto;
use App\Providers\Exceptions\IncorrectLoginException;

class ProfileHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'Biz';
    }

    /**
     * @param array $options
     * @return ResultDto
     * @throws IncorrectLoginException
     */
    public function createUser(array $options): ResultDto {
        if (!$this->validateLogin($options['login'])) {
            throw new IncorrectLoginException();
        }

        $options['loginIs'] = self::loginIsEmailOrPhone($options['login']);

        return $this->post('profile/create', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function updateUser(array $options): ResultDto {
        return $this->put('profile/update', $options);
    }


    /**
     * @return ResultDto
     */
    public function getUsers(): ResultDto {
        return $this->get('profile');
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function getUser(array $options): ResultDto {
        return $this->get('profile/' . $options['id'], []);
    }

    /**
     * @param array $options
     * @return ResultDto
     * @throws IncorrectLoginException
     */
    public function loginUser(array $options): ResultDto {
        if (!$this->validateLogin($options['login'])) {
            throw new IncorrectLoginException('Not valid login');
        }
        $options['loginIs'] = self::loginIsEmailOrPhone($options['login']);

        return $this->post('profile/login', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function setSmsCode(array $options): ResultDto {
        return $this->post('profile/setSmsCode', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function setEmailHash(array $options): ResultDto {
        return $this->post('profile/setEmailHash', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function verifySmsCode(array $options): ResultDto {
        return $this->post('profile/verifySmsCode', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function verifyEmailHash(array $options): ResultDto {
        return $this->post('profile/verifyEmailHash', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function setPasswordApplyByPhone(array $options): ResultDto  {
        return $this->post('profile/setPasswordApplyByPhone', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function setPasswordApplyByEmail(array $options): ResultDto  {
        return $this->post('profile/setPasswordApplyByEmail', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function addNotActiveEmailToUser(array $options): ResultDto  {
        return $this->post('profile/addEmailToUser', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function activateEmail(array $options): ResultDto  {
        return $this->post('profile/activateEmail', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function addNotActivePhoneToUser(array $options): ResultDto  {
        return $this->post('profile/addPhoneToUser', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function activatePhone(array $options): ResultDto  {
        return $this->post('profile/activatePhone', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function generateNewHashEmail(array $options): ResultDto {
        return $this->post('profile/generateEmailResetHash', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function generateNewHashPhone(array $options): ResultDto  {
        return $this->post('profile/generatePhoneResetHash', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function setPushToken(array $options): ResultDto  {
        return $this->post('profile/setPushToken', $options);
    }


    /**
     * @param array $options
     * @return ResultDto
     */
    public function addCreditCard(array $options): ResultDto  {
        return $this->post('profile/addCreditCard', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function addPay(array $options): ResultDto  {
        return $this->post('profile/addPay', $options);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function deleteUserByPhone(array $options): ResultDto  {
        return $this->post('profile/deleteUserByPhone', $options);
    }

    /**
     * @param $login
     *
     * @return bool
     */
    public function validateLogin($login): bool {
        return !(
            (filter_var($login, FILTER_VALIDATE_EMAIL) === false)
            && (preg_match('/^[0-9]{10}+$/', $login) === 0)
        );
    }

    /**
     * @param $login
     *
     * @return string
     */
    static public function loginIsEmailOrPhone($login): string {
        return filter_var($login, FILTER_VALIDATE_EMAIL) === false ? 'phone' : 'email';
    }

    /**
     * @param $options
     * @return ResultDto
     */
    public function createUserFromPromo($options): ResultDto {
        return $this->post('profile/create/promo', $options);
    }



    ///*******
    /// mobile registration
    ///
    /**
     * @param $options
     * @return ResultDto
     */
    public function mobileCreateUser($options): ResultDto {
        return $this->post('profile/m/create', $options);
    }

    /**
     * @param $options
     * @return ResultDto
     */
    public function mobileRegistartionUser($options): ResultDto {
        return $this->post('profile/m/registration', $options);
    }

    /**
     * @param $options
     * @return ResultDto
     */
    public function mobileConfirmTerm($options): ResultDto {
        return $this->post('profile/m/confirmTerm', $options);
    }

    /**
     * @param $options
     * @return ResultDto
     */
    public function getSmsCode($options): ResultDto {
        return $this->post('profile/m/smsCode', $options);
    }

    /**
     * @param $options
     * @return ResultDto
     */
    public function mobileLoginUser($options): ResultDto {
        return $this->post('profile/m/login', $options);
    }
}