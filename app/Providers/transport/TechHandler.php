<?php

namespace App\Providers\transport;

use App\Models\ResultDto;
use App\Providers\transport\QlickTechHandler;

class TechHandler extends Handler {

    const XDEBUG_ON = 1;

    const SEND_TO_QLICK = 1;

    private $qlick;

    /**
     * TechHandler constructor.
     * @param string $url
     * @param string $qlickUri
     * @throws \Exception
     */
    function __construct(string $url, string $qlickUri) {
        parent::__construct($url);
        $this->serviceName = 'tech';

        $this->qlick = new QlickTechHandler($qlickUri);
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

        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->unlock($options);
        }

        $method = 'external/start';
        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }


    public function booking(array $options): ResultDto {
        $session = uniqid('tech', true);
        $options['sessionId'] = $session;

        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->booking($options);
        }

        $method = 'external/booking';
        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }


    public function checkByQrCode(array $options): ResultDto {
        if (self::SEND_TO_QLICK === 0) {
            return $this->qlick->checkByQrCode($options);
        }

        $method = 'external/checkByQrCode';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }

    public function parking(array $options): ResultDto {
        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->parking($options);
        }

        $method = 'external/pause';
        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }

    public function rentEnd(array $options): ResultDto {
        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->rentEnd($options);
        }

        $method = 'external/finish';
        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }


    public function ring(array $options): ResultDto {
        if (self::SEND_TO_QLICK === 0) {
            return $this->qlick->ring($options);
        }

        $method = 'external/ring';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }


    public function userTechInfo(array $options): ResultDto {
        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->userTechInfo($options);
        }

        $method = 'external/userTechInfo';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }


    public function getAgentById($id) {
        $list = [
            '863921030920683' => '71367',
            '863921030920816' => '69085'
        ];
        return $list[$id];
    }

    public function coordinates() {
        return new ResultDto(1, 'coordinates', [
                [
                    "IDDevice" => 863921030920683, //ufa
                    'agent_id' => '71367',
                    "lat" => "54.750423",
                    "lon" => "55.998016"
                ],
                [
                    "IDDevice" => 863921030920816,
                    'agent_id' => '69085',
                    "lat" => "47.216034",
                    "lon" => "39.707112"
                ],
            ]
        );
    }

    public function putCoordinates($userId, $lat, $lon, $battery): ResultDto {
        return new ResultDto(1, 'putCoordinates save', [
                'echo' =>
                    [
                        'user_id' => $userId,
                        "lat" => $lat,
                        "lon" => $lon,
                        "battery" => $battery,
                    ]
            ]
        );
    }

    public function vehicleStatus(array $params): ResultDto {
        if (self::SEND_TO_QLICK === 0) {
            return $this->qlick->vehicleStatus($params);
        } else {
            $method = 'external/vehicle/list';
            if (self::XDEBUG_ON == 1) {
                $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
            }

            return $this->get($method, $this->prepareGetParams($params));
        }
    }


    public function availableTransport(array $params): ResultDto {
        if (self::SEND_TO_QLICK === 1) {
            return $this->qlick->availableTransport($params);

        } else {
            $method = 'external/vehicle/listByGeo';
            if (self::XDEBUG_ON == 1) {
                $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
            }
            return $this->get($method, $this->prepareGetParams($params));
        }
    }

    /**
     * Полная информация по выбранному велосипеду или скутеру
     *  (карточка устройства)
     *
     * @return array
     */
    public function vehicleInfo(array $params): ResultDto {
        //['vehicleId' => $id]
        $method = 'external/vehicle';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($params));
    }

    public function getRidesShort(array $options): ResultDto {
        $method = 'external/ridesShort';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($options));
    }


    /***************************************************************/
    //ГЕОЗОНЫ GEOZONES
    /***************************************************************/
    public function geozonesMobile(array $params): ResultDto {
        //['vehicleId' => $id]
        $method = 'external/mobileGeozones';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($params));
    }

    public function checkGeozoneType(array $params): ResultDto {
        //['vehicleId' => $id]
        $method = 'external/checkGeozoneType';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($params));
    }


    public function addGeozone(array $options): ResultDto {

        $method = 'external/geozone';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->post($method, $options);
    }

    public function deleteGeozone(array $options): ResultDto {
        $method = 'external/geozone';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->delete($method, $this->prepareGetParams($options));
    }

    public function getGeozones(array $options): ResultDto {
        $method = 'external/geozones';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }

        return $this->get($method, $this->prepareGetParams($options));
    }

    /***************************************************************/
    //КОНЕЦ ГЕОЗОНЫ  END GEOZONES
    /***************************************************************/

    public function onlineSessionCost(array $params): ResultDto {
        //['vehicleId' => $id]
        $method = 'external/onlineSessionCost';

        if (self::XDEBUG_ON == 1) {
            $method = $method . '?XDEBUG_SESSION_START=PHPSTORM';
        }
        return $this->get($method, $this->prepareGetParams($params));
    }

    public function userVehicle($user_id): ResultDto {
        $mediaUrl = env('media_uri');

        return new ResultDto(
            1,
            'userVehicle',
            [

                [
                    'id' => 1,
                    'name' => 'kick scooter № -1572510331',
                    'type_id' => 3,
                    'type' => "kick scooter",
                    'status_id' => 2,
                    'status' => 'BOOKED',
                    'status_time' => date('Y-m-d H:i:s'),
                    'images' => [
                        0 => $mediaUrl . 'eaf5619ee333156447a8c052cb72abaf',
                        1 => $mediaUrl . 'aa0036599ecd84cfe5ecaef29cc23124',
                        2 => $mediaUrl . 'aa0036599ecd84cfe5ecaef29cc23124',
                    ],
                    'lock' => [
                        'IDDevice' => '863921030920683',
                        'agentId' => 71367,
                        'gsmStatus' => 72,
                        'battery' => 34,
                        'lat' => '54.780223',
                        'lon' => '55.121116'
                    ],
                    [
                        'id' => 2,
                        'name' => 'kick scooter № -1572510332',
                        'type_id' => 1,
                        'status_id' => 2,
                        'status' => 'BOOKED',
                        'type' => "kick scooter",
                        'status_time' => date('Y-m-d H:i:s'),
                        'images' => [
                            0 => $mediaUrl . 'eaf5619ee333156447a8c052cb72abaf',
                            1 => $mediaUrl . 'aa0036599ecd84cfe5ecaef29cc23124',
                            2 => $mediaUrl . 'aa0036599ecd84cfe5ecaef29cc23124',
                        ],
                        'lock' => [
                            'IDDevice' => '863921030920683',
                            'agentId' => 71367,
                            'gsmStatus' => 72,
                            'battery' => 34,
                            'lat' => '54.780223',
                            'lon' => '55.121116'
                        ],
                    ]
                ],

            ]
        );
    }


    public function insuranceCompany(): ResultDto {
        $data = [
            'total' => 7,
            'items' => [
                ['id' => 1, 'name' => 'Alfa insurance'],
                ['id' => 2, 'name' => 'VTB insurance'],
                ['id' => 3, 'name' => 'SBER insurance'],
                ['id' => 4, 'name' => 'Soglasie insurance'],
                ['id' => 5, 'name' => 'Tinkoff insurance'],
                ['id' => 6, 'name' => 'Rosgorstrakh insurance'],
                ['id' => 7, 'name' => 'ROSNO insurance'],
            ]
        ];

        return new ResultDto(1, 'insuranceCompany', $data);
    }
}