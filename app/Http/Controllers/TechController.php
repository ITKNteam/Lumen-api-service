<?php

namespace App\Http\Controllers;

use App\Models\ResultDto;
use App\Providers\transport\TechHandler;
use App\Providers\transport\BillingHandler;
use Illuminate\Http\Request;
use Exception;

class TechController extends Controller {

    private $techHandler;

    private $billingHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->techHandler = new TechHandler(env('TECH_URI'), env('TECH_LUMEN_URI'));
        $this->billingHandler = new BillingHandler(env('BIZ_URI'));
    }

    public function getCoordinates(Request $request) {
        return $this->responseJSON($this->techHandler->coordinates());
    }

    /**
     * координаты телефона
     */
    public function putCoordinates(Request $request) {
        return $this->responseJSON(
            $this->techHandler->putCoordinates(
                $request->user()->getId(),
                $request->get('lat'),
                $request->get('lon'),
                $request->get('battery')
            )
        );
    }

    public function unlock(Request $request) {
        if (!$request->has('id') && !$request->has('qrCode')) {
            abort(400, 'Impossible unlock by id and qrCode. Use id OR qrCode ');
        }

        $data = $request->all();
        $data['userId'] = $request->user()->getId();

        //TODO 500
        return $this->responseJSON($this->techHandler->unlock($data));
    }


    /**
     *  Метод окончания аренды
     *  после чего необходимо дождаться подтверждения о том что все хорошо.
     *  Если поддтверждение не приходит в течении N времени,
     *  попробывать ещё раз заблокировать замок, или позвонить в службу поддержки
     *
     */
    public function rentEnd(Request $request) {
        $this->getRequestFields($request, ['id']);
        $idVehicle = $request->get('id');

        $userId = $request->user()->getId();

        $resTech = $this->techHandler->rentEnd([
            'vehicleId' => $idVehicle,
            'userId' => $userId
        ]);

        if (!$resTech->isSuccess()) {
            return $this->failResponse($resTech);
        }

        $resBilling = $this->billingHandler->payRent([
            'user_id' => $userId,
            'history_json' => json_encode($resTech) ?? ''
        ]);

        if (!$resBilling->isSuccess()) {
            return $this->failResponse($resBilling);
        }

        $resTechData = (array)$resTech->getData('sessionInfo');
        $resBillingData = (array)$resBilling->getData();

        return $this->responseJSON(new ResultDto(1,
            'Rent end',
            array_merge($resBillingData, [
                'sessionid' => $resTechData['session']['id'] ?? 0,
                'travelTime' => $resTechData['travelTime'] ?? 0,
                'travelTimeUnit' => $resTechData['travelTimeUnit'] ??
                    'minutes',
                'distance' => $resTechData['distance'] ?? 0,
                'distanceUnit' => $resTechData['distanceUnit'] ?? 'meter'
            ])));
    }


    public function ring(Request $request) {
        $this->getRequestFields($request, ['id']);

        return $this->responseJSON(
            $this->techHandler->ring([
                'vehicleId' => $request->get('id'),
                'userId' => $request->user()->getId()
            ])
        );
    }

    public function booking(Request $request) {
        $this->getRequestFields($request, ['id']);

        //TODO {"res":500,"message":"Not found message","data":[]}
        return $this->responseJSON(
            $this->techHandler->booking([
                'userId' => $request->user()->getId(),
                'vehicleId' => $request->get('id')
            ])
        );
    }

    public function checkByQrCode(Request $request) {
        $this->getRequestFields($request, ['qrCode']);

        return $this->responseJSON(
            $this->techHandler->checkByQrCode([
                'userId' => $request->user()->getId(),
                'qrCode' => $request->get('qrCode')
            ])
        );
    }

    public function parking(Request $request) {
        $this->getRequestFields($request, ['id']);

        //TODO {"res":500,"message":"Not found message","data":[]}
        return $this->responseJSON(
            $this->techHandler->parking([
                'userId' => $request->user()->getId(),
                'vehicleId' => $request->get('id')
            ])
        );
    }

    public function getRidesShort(Request $request) {
        $params = array_merge($request->all(), ['userId' => $request->user()->getId()]);

        return $this->responseJSON($this->techHandler->getRidesShort($params));
    }

    public function userTechInfo(Request $request) {
        return $this->responseJSON($this->techHandler->userTechInfo(['userId' => $request->user()->getId()]));
    }

    public function vehicleStatus(Request $request) {
        return $this->responseJSON($this->techHandler->vehicleStatus($request->all()));
    }

    //mobile API

    public function availableTransport(Request $request) {
        return $this->responseJSON($this->techHandler->availableTransport($request->all()));
    }

    public function rentStartMobile(Request $request) {
        $idVehicle = 0;
        $qrCode = $request->get('qrCode') ?? 0;

        return $this->responseJSON(
            $this->techHandler->unlock([
                'vehicleId' => $idVehicle,
                'userId' => $request->user()->getId(),
                'qrCode' => $qrCode
            ])
        );
    }

    public function unlockMobile(Request $request) {
        $idVehicle = $request->get('id') ?? 0;
        $qrCode = 0;

        return $this->responseJSON(
            $this->techHandler->unlock([
                'vehicleId' => $idVehicle,
                'userId' => $request->user()->getId(),
                'qrCode' => $qrCode
            ])
        );
    }

    public function onlineSessionCost(Request $request) {
        $res = $this->techHandler->onlineSessionCost($request->all());

        if (!$res->isSuccess()) {
            return $this->failResponse($res);
        }

        $resTariff = $this->billingHandler->getTariffUser([
            'user_id' => $request->user()->getId()
        ]);

        if (!$resTariff->isSuccess()) {
            return $this->failResponse($resTariff);
        }

        $rentCost = $resTariff->getData('usingCost');
        $parkingCost = $resTariff->getData('parkingCost');

        $travelCost = round(
            ($res->getData('rentTime') * $rentCost) + ($res->getData('parkingTime') * $parkingCost),
            2
        );

        return $this->responseJSON(
            new ResultDto(1, 'Cost', [
                'travelCost' => $travelCost,
                'currency' => 'Рубли',
                'currencyShort' => 'RUB',
                'travelTime' => $res->getData('rentTime') + $res->getData('parkingTime'),
                'travelTimeUnit' => 'minutes'
            ])
        );
    }

    /**
     *  Карточка велосипеда или самоката
     */
    public function vehicleInfo(Request $request) {
        $id = $request->get('id');
        return $this->responseJSON($this->techHandler->vehicleInfo(['vehicleId' => $id]));
    }


    public function insuranceCompany(Request $request) {
        return $this->responseJSON($this->techHandler->insuranceCompany());
    }



    /***************************************************************/
    //ГЕОЗОНЫ GEOZONES
    /***************************************************************/

    public function geozonesMobile(Request $request) {
        return $this->responseJSON($this->techHandler->geozonesMobile($request->all()));
    }

    public function checkGeozoneType(Request $request) {
        return $this->responseJSON(
            $this->techHandler->checkGeozoneType(
                $request->all(),
                ['userId' => $request->user()->getId()]
            )
        );
    }


    public function addGeozone(Request $request) {
        $params = $this->getRequestFields($request, ['name', 'cityId', 'partnerId', 'geoJson', 'statusId', 'typeId']);
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->techHandler->addGeozone($params));
    }

    public function getGeozone(Request $request) {
        return $this->responseJSON($this->techHandler->getGeozones($request->all()));
    }

    public function deleteGeozone(Request $request) {
        return $this->responseJSON($this->techHandler->deleteGeozone([
            'userId' => $request->user()->getId(),
            'id' => $request->get('id')
        ]));
    }


    /***************************************************************/
    //КОНЕЦ ГЕОЗОНЫ  END GEOZONES
    //
    /***************************************************************/
}
