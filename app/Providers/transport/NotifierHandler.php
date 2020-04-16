<?php


namespace App\Providers\transport;

use App\Models\ResultDto;

class NotifierHandler extends Handler {

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

        return $this->post($options);
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

        return $this->post($options);
    }
}