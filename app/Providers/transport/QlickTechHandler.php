<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class QlickTechHandler extends Handler {
    const XDEBUG_ON = 1;

    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'tech';
    }

    /**
     * разблокировка 601
     *
     * @param $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function unlock(array $options): ResultDto {
        if ($options['qrCode'] != 0) {
            $session = uniqid('tech', true);
            $options['sessionId'] = $session;
        }

        return $this->post('vehicle/start', $options);
    }


    public function booking(array $options): ResultDto {
        $session = uniqid('tech', true);
        $options['sessionId'] = $session;

        return $this->post('vehicle/booking', $options);
    }


    public function checkByQrCode(array $options): ResultDto {
        return $this->post('vehicle/checkByQrCode', $options);
    }

    public function parking(array $options): ResultDto {
        return $this->post('vehicle/pause', $options);
    }

    public function rentEnd(array $options): ResultDto {
        return $this->post('vehicle/finish', $options);
    }


    public function ring(array $options): ResultDto {
        return $this->post('vehicle/ring', $options);
    }


    public function userTechInfo(array $options): ResultDto {
        return $this->get('vehicle/userTechInfo', $this->prepareGetParams($options));
    }

    public function vehicleStatus(array $params): ResultDto {
        return $this->get('vehicle/list', $this->prepareGetParams($params));
    }

    public function availableTransport(array $params): ResultDto {
        $method = 'vehicle/listByGeo';
        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($params));
    }
}