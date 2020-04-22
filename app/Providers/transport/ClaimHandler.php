<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class ClaimHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-claim';
    }

    /**
     * @param array $input
     * @return array
     */
    private function prepareGetParams(array $input = []): array {
        $prepare = [];

        foreach ($input as $key => $value) {
            if ($key === '_url') {
                continue;
            }

            $prepare[$key] = $value;
        }

        return $prepare;
    }

    public function deleteCreditCard(array $input): ResultDto {
        return $this->delete('billing/creditCard', $this->prepareGetParams($input));
    }

    public function listClaims(array $options): ResultDto {
        return $this->get('claim/m/list', $this->prepareGetParams($options));
    }

    public function createClaim(array $options): ResultDto {
        return $this->post('claim/m/create', $options);
    }

    public function changeClaimStatus(array $options): ResultDto {
        return $this->put('claim/m/update', $options);
    }

    public function createClaimComment(array $options): ResultDto {
        return $this->post('claim/m/comment', $options);
    }

    public function listClaimComments(array $options): ResultDto {
        return $this->get('claim/m/commentList', $options);
    }
}