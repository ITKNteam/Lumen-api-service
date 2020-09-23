<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class AuthHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'auth';
    }

    /**
     * @param array $params
     * @return ResultDto
     */
    public function login(array $params): ResultDto {
        return $this->post('/getToken', $params);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function validateToken(array $options): ResultDto {
        return $this->post('/validateToken', $options);
    }
}