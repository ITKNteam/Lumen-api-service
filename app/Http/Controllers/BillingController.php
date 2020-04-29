<?php

namespace App\Http\Controllers;

use App\Providers\transport\BillingHandler;
use Illuminate\Http\Request;
use Exception;

class BillingController extends Controller {

    private $billingHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->billingHandler = new BillingHandler(env('biz_uri'));
    }

    public function addCreditCard(Request $request): array {
        $params = $this->getRequestFields($request, ['cardNumber', 'cvv2', 'expiryDate']);
        $params['user_id'] = $request->user()->getId();
        return $this->billingHandler->addCreditCard($params)->getResult();
    }

    public function getCreditCard(Request $request): array {
        return $this->billingHandler->getCreditCard([
            'user_id' => $request->user()->getId()
        ])->getResult();
    }

    public function deleteCreditCard(Request $request): array {
        $params = $this->getRequestFields($request, ['cardId']);
        $params['user_id'] = $request->user()->getId();
        return $this->billingHandler->deleteCreditCard($params)->getResult();
    }

    public function patchCreditCard(Request $request): array {
        $params = $this->getRequestFields($request, ['cardId']);
        $params['user_id'] = $request->user()->getId();
        return $this->billingHandler->patchCreditCard($params)->getResult();
    }

    public function addPay(Request $request): array {
        $params = $this->getRequestFields($request, ['amount', 'orderId']);
        $params['user_id'] = $request->user()->getId();

        return $this->billingHandler->addPay($params)->getResult();
    }

    public function createTariff(Request $request): array {
        $this->getRequestFields($request, ['name', 'cost']);

        $name = (string)$request->get('name');  //string
        $cost = (float)$request->get('cost');  //float
        $bookingTime = (int)$request->get('bookingTime');  //int
        $parkingCost = (float)$request->get('parkingCost'); //float
        $usingCost = (float)$request->get('usingCost'); //float
        $depositAmmount = (float)$request->get('depositAmmount'); //float
        $prepaidMinutes = (int)$request->get('prepaidMinutes'); //int
        $isDeposidReturned = (int)$request->get('isDeposidReturned'); //int
        $includedMinutes = (int)$request->get('includedMinutes'); //int
        $tariffInterval = (int)$request->get('tariffInterval'); //int
        $dtStart = (string)$request->get('dtStart'); //sring
        $dtEnd = (string)$request->get('dtEnd'); //sring
        $sessionDelayMinutes = (int)$request->get('sessionDelayMinutes'); //int
        $countFreeSessions = (int)$request->get('countFreeSessions'); //int

        $options = [
            'name' => $name,
            'cost' => $cost,
            'bookingTime' => $bookingTime,
            'parkingCost' => $parkingCost,
            'usingCost' => $usingCost,
            'depositAmmount' => $depositAmmount,
            'prepaidMinutes' => $prepaidMinutes,
            'isDeposidReturned' => $isDeposidReturned,
            'includedMinutes' => $includedMinutes,
            'tariffInterval' => $tariffInterval,
            'dtStart' => $dtStart,
            'dtEnd' => $dtEnd,
            'sessionDelayMinutes' => $sessionDelayMinutes,
            'countFreeSessions' => $countFreeSessions,
            'user_id' => $request->user()->getId()
        ];

        return $this->billingHandler->createTariff($options)->getResult();
    }


    public function getTariff(Request $request): array {
        return $this->billingHandler->getTariffs([
            'user_id' => $request->user()->getId()
        ])->getResult();
    }

    public function changeStatusTariff(Request $request): array {
        $params = $this->getRequestFields($request, ['tariff_id', 'status_id']);
        $params['user_id'] = $request->user()->getId();

        return $this->billingHandler->changeStatusTariff($params)->getResult();
    }

    public function bindTariffBindUser(Request $request): array {
        return $this->billingHandler->bindTariffToUser(
            $this->getRequestFields($request, ['user_id', 'tariff_id'])
        )->getResult();
    }

    public function getAllWriteOffs(Request $request): array {
        return $this->billingHandler->getAllWriteOffs([])->getResult();
    }

    public function getCurrentWriteOffs(Request $request): array {
        return $this->billingHandler->getUserWriteOffs([
            'user_id' => $request->user()->getId()
        ])->getResult();
    }

    public function getUserWriteOffs(Request $request): array {
        return $this->billingHandler->getUserWriteOffs();
    }

    public function payRent(Request $request): array {
        return $this->billingHandler->payRent(
            $this->getRequestFields($request, ['user_id', 'history_json'])
        )->getResult();
    }

    public function getCurrentTariff(Request $request): array {
        return $this->billingHandler->getTariffUser([
            'user_id' => $request->user()->getId()
        ])->getResult();
    }
}
