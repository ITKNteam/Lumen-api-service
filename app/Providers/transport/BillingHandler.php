<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class BillingHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-billing';
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


    public function patchCreditCard(array $input): ResultDto {
        return $this->patch('billing/creditCard', $this->prepareGetParams($input));
    }

    public function createTariff(array $options): ResultDto {
        return $this->post('billing/tariff', $options);
    }


    public function getTariffs(array $params): ResultDto {
        return $this->get('billing/tariff', $this->prepareGetParams($params));

    }

    public function changeStatusTariff(array $options): ResultDto {
        return $this->post('billing/tariffChangeStatus', $options);
    }


    public function addCreditCard(array $options): ResultDto {
        return $this->post('billing/creditCard', $options);
    }

    public function getCreditCard(array $params): ResultDto {
        return $this->get('billing/creditCard', $this->prepareGetParams($params));
    }


    public function addPay(array $options): ResultDto {
        return $this->post('billing/addPay', $options);
    }

    public function bindTariffToUser(array $options): ResultDto {
        return $this->post('billing/tariffBindUser', $options);
    }

    public function getAllWriteOffs(array $options): ResultDto {
        return $this->get('billing/writeOffs', [], [
            'form_params' => $options
        ]);
    }

    public function getUserWriteOffs(array $options): ResultDto {
        return $this->get('billing/writeOffs/user', $this->prepareGetParams($options));
    }

    public function payRent(array $options): ResultDto {
        return $this->post('billing/writeOffs', $options);
    }

    public function getTariffUser(array $options): ResultDto {
        return $this->get('billing/tariff/user', $this->prepareGetParams($options));
    }

    //ROBOKASSA

    public function robokassaResult(array $options): ResultDto {
        return $this->post('billing/robokassaResult', $options);
    }

    public function robokassaOk(array $options): ResultDto {
        return $this->post('billing/robokassaOk', $options);
    }

    public function robokassaFail(array $options): ResultDto {
        return $this->post('billing/robokassaFail', $options);
    }

    public function robokassaRedirectUrl(array $options): ResultDto {
        return $this->get('billing/robokassaRedirectUrl', $this->prepareGetParams($options));
    }

    //ROBOKASSA END
}