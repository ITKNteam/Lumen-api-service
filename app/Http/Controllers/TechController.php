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
        $this->techHandler = new TechHandler(env('tech_uri'), env('tech_lumen_uri'));
        $this->billingHandler = new BillingHandler(env('biz_uri'));
    }

    public function getCoordinates(Request $request): array {
        $res = $this->techHandler->coordinates();
        $this->buildSuccessResponse(
            200, $res['messages'] ?? 'OK', $res['data'] ?? []
        );
    }

    /**
     * координаты телефона
     */
    public function putCoordinates(Request $request): array {
        return $this->techHandler->putCoordinates(
            $request->user()->getId(),
            $request->get('lat'),
            $request->get('lon'),
            $request->get('battery')
        )->getResult();
    }

    public function unlock(Request $request): array {
        if (!$request->has('id') && !$request->has('qrCode')) {
            abort(400, 'Impossible unlock by id and qrCode. Use id OR qrCode ');
        }

        $data = $request->all();
        $data['userId'] = $request->user()->getId();

        //TODO 500
        return $this->techHandler->unlock($data)->getResult();
    }


    /**
     *  Метод окончания аренды
     *  после чего необходимо дождаться подтверждения о том что все хорошо.
     *  Если поддтверждение не приходит в течении N времени,
     *  попробывать ещё раз заблокировать замок, или позвонить в службу поддержки
     *
     */
    public function rentEnd(Request $request): array {
        $this->getRequestFields($request, ['id']);
        $idVehicle = $request->get('id');

        $userId = $request->user()->getId();

        $resTech = $this->techHandler->rentEnd([
            'vehicleId' => $idVehicle,
            'userId' => $userId
        ]);

        if (!$resTech->isSuccess()) {
            $this->sentryAbort(new Exception($resTech->getMessage()));
        }

        $resBilling = $this->billingHandler->payRent([
            'user_id' => $userId,
            'history_json' => json_encode($resTech) ?? ''
        ]);

        if (!$resBilling->isSuccess()) {
            $this->sentryAbort(new Exception($resBilling->getMessage(), $resBilling->getRes()));
        }

        $resTechData = (array)$resTech->getData('sessionInfo');
        $resBillingData = (array)$resBilling->getData();

        return ResultDto::createResult(
            1,
            'Rent end',
            array_merge($resBillingData, [
                'sessionid' => $resTechData['session']['id'] ?? 0,
                'travelTime' => $resTechData['travelTime'] ?? 0,
                'travelTimeUnit' => $resTechData['travelTimeUnit'] ??
                    'minutes',
                'distance' => $resTechData['distance'] ?? 0,
                'distanceUnit' => $resTechData['distanceUnit'] ?? 'meter'
            ]));
    }


    public function ring(Request $request): array {
        $this->getRequestFields($request, ['id']);

        $idVehicle = $request->get('id');
        $resTech = $this->techHandler->ring([
            'vehicleId' => $idVehicle,
            'userId' => $request->user()->getId()
        ]);

        return $resTech->getResult();
    }

    public function booking(Request $request): array {
        $this->getRequestFields($request, ['id']);

        //TODO {"res":500,"message":"Not found message","data":[]}
        return $this->techHandler->booking([
            'userId' => $request->user()->getId(),
            'vehicleId' => $request->get('id')
        ])->getResult();
    }

    public function checkByQrCode(Request $request): array {
        $this->getRequestFields($request, ['qrCode']);

        return $this->techHandler->checkByQrCode([
            'userId' => $request->user()->getId(),
            'qrCode' => $request->get('qrCode')
        ])->getResult();
    }

    public function parking(Request $request): array {
        $this->getRequestFields($request, ['id']);

        //TODO {"res":500,"message":"Not found message","data":[]}
        return $this->techHandler->parking([
            'userId' => $request->user()->getId(),
            'vehicleId' => $request->get('id')
        ])->getResult();
    }

    public function getRidesShort(Request $request): array {
        $params = array_merge($request->all(), ['userId' => $request->user()->getId()]);

        return $this->techHandler->getRidesShort($params)->getResult();
    }

    public function userTechInfo(Request $request): array {
        return $this->techHandler->userTechInfo(['userId' => $request->user()->getId()])->getResult();
    }

    public function vehicleStatus(Request $request): array {
        return $this->techHandler->vehicleStatus($request->all())->getResult();
    }

    //mobile API

    public function availableTransport(Request $request): array {
        return $this->techHandler->availableTransport($request->all())->getResult();
    }

    public function rentStartMobile(Request $request): array {
        $idVehicle = 0;
        $qrCode = $request->get('qrCode') ?? 0;

        return $this->techHandler->unlock([
            'vehicleId' => $idVehicle,
            'userId' => $request->user()->getId(),
            'qrCode' => $qrCode
        ])->getResult();
    }

    public function unlockMobile(Request $request): array {
        $idVehicle = $request->get('id') ?? 0;
        $qrCode = 0;

        return $this->techHandler->unlock([
            'vehicleId' => $idVehicle,
            'userId' => $request->user()->getId(),
            'qrCode' => $qrCode
        ])->getResult();
    }

    public function onlineSessionCost(Request $request): array {
        $res = $this->techHandler->onlineSessionCost($request->all());

        if (!$res->isSuccess()) {
            $this->sentryAbort(new Exception($res->getMessage() ?? 'onlineSessionCost fail'));
        }

        $resTariff = $this->billingHandler->getTariffUser([
            'user_id' => $request->user()->getId()
        ]);

        if (!$resTariff->isSuccess()) {
            $this->sentryAbort(new Exception($resTariff->getMessage() ?? 'onlineSessionCost tarif'));
        }

        $rentCost = $resTariff->getData('usingCost');
        $parkingCost = $resTariff->getData('parkingCost');

        $travelCost = round(
            ($res->getData('rentTime') * $rentCost) + ($res->getData('parkingTime') * $parkingCost),
            2
        );

        return ResultDto::createResult(1, 'Cost', [
            'travelCost' => $travelCost,
            'currency' => 'Рубли',
            'currencyShort' => 'RUB',
            'travelTime' => $res->getData('rentTime') + $res->getData('parkingTime'),
            'travelTimeUnit' => 'minutes'
        ]);
    }

    /**
     *  Карточка велосипеда или самоката
     */
    public function vehicleInfo(Request $request): array {
        $id = $request->get('id');
        return $this->techHandler->vehicleInfo(['vehicleId' => $id])->getResult();
    }


    public function insuranceCompany(Request $request): array {
        return $this->techHandler->insuranceCompany()->getResult();
    }



    /***************************************************************/
    //ГЕОЗОНЫ GEOZONES
    /***************************************************************/

    public function geozonesMobile(Request $request): array {
        return $this->techHandler->geozonesMobile($request->all())->getResult();
    }

    public function checkGeozoneType(Request $request): array {
        return $this->techHandler->checkGeozoneType(
            $request->all(),
            ['userId' => $request->user()->getId()]
        );
    }


    public function addGeozone(Request $request): array {
        $params = $this->getRequestFields($request, ['name', 'cityId', 'partnerId', 'geoJson', 'statusId', 'typeId']);
        $params['userId'] = $request->user()->getId();
        return $this->techHandler->addGeozone($params)->getResult();
    }

    public function getGeozone(Request $request): array {
        return $this->techHandler->getGeozones($request->all())->getResult();
    }


    public function deleteGeozone(Request $request): array {
        return $this->techHandler->deleteGeozone([
            'userId' => $request->user()->getId(),
            'id' => $request->get('id')
        ])->getResult();
    }


    /***************************************************************/
    //КОНЕЦ ГЕОЗОНЫ  END GEOZONES
    //
    /***************************************************************/
}
