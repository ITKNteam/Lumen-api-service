<?php


namespace App\Providers\transport;

use App\Models\ResultDto;

class NotifierHandler extends Handler {

    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'Notifier';
    }

    /**
     * @param int $userId
     * @param string $code
     * @param string $phone
     * @return ResultDto
     */
    public function sendSmsCode(int $userId, string $code, string $phone): ResultDto {

        $template = 'Код активации: {code}';
        $channels = ' {"email": false, "push": false,"sms": true}';
        $messageData = '{"code": ' . $code . '}';

        $options = [
            'user_id' => $userId,
            'template' => $template,
            'channels' => $channels,
            'message_data' => $messageData,
            'email' => '',
            'phone' => $phone
        ];

        return $this->post('notifications/send', $options);
    }


    /**
     * @param int $userId
     * @param string $hash
     * @param string $emailActivationUri
     * @param string $email
     * @return ResultDto
     */
    public function sendEmailHash(int $userId, string $hash, string $emailActivationUri, string $email): ResultDto {

        $link = $emailActivationUri . $hash;

        $template = 'Ссылка на активацию email  ' . $link;
        $channels = ' {"email": true, "push": false,"sms": false}';
        $messageData = '';

        $options = [
            'user_id' => $userId,
            'template' => $template,
            'channels' => $channels,
            'message_data' => $messageData,
            'email' => $email,
            'phone' => ''
        ];

        return $this->post('notifications/send', $options);
    }
}