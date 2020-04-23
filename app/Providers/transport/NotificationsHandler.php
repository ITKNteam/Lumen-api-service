<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class NotificationsHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-claim';
    }

    private function prepareMultipartForm(array $input = []) {
        $prepare = [];

        foreach ($input as $key => $value) {
            $prepare[] = [
                'name' => $key,
                'contents' => $value
            ];
        }

        return $prepare;
    }

    public function sendNotifications(array $input): ResultDto {
        return $this->post('notifications/send', [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }
}