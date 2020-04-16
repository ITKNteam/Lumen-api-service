<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class AuthHandler extends Handler {

    /**
     * @param array $params
     * @return ResultDto
     */
    public function login(array $params): ResultDto {
        return $this->post('user/getToken', $params);
    }

    /**
     * @param array $options
     * @return ResultDto
     */
    public function validateToken(array $options): ResultDto {
        return $this->post('user/validateToken', $options);
    }
}