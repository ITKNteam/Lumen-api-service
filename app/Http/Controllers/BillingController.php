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
        $this->billingHandler = new BillingHandler(env('BIZ_URI'));
    }

    public function addCreditCard(Request $request) {
        $params = $this->getRequestFields($request, ['cardNumber', 'cvv2', 'expiryDate']);
        $params['user_id'] = $request->user()->getId();
        return $this->responseJSON($this->billingHandler->addCreditCard($params));
    }

    public function getCreditCard(Request $request) {
        return $this->responseJSON($this->billingHandler->getCreditCard([
            'user_id' => $request->user()->getId()
        ]));
    }

    public function deleteCreditCard(Request $request) {
        $params = $this->getRequestFields($request, ['cardId']);
        $params['user_id'] = $request->user()->getId();
        return $this->responseJSON($this->billingHandler->deleteCreditCard($params));
    }

    public function patchCreditCard(Request $request) {
        $params = $this->getRequestFields($request, ['cardId']);
        $params['user_id'] = $request->user()->getId();
        return $this->responseJSON($this->billingHandler->patchCreditCard($params));
    }

    public function addPay(Request $request) {
        $params = $this->getRequestFields($request, ['amount', 'orderId']);
        $params['user_id'] = $request->user()->getId();

        return $this->responseJSON($this->billingHandler->addPay($params));
    }

    public function createTariff(Request $request) {
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

        return $this->responseJSON($this->billingHandler->createTariff($options));
    }


    public function getTariff(Request $request) {
        return $this->billingHandler->getTariffs([
            'user_id' => $request->user()->getId()
        ])->getResult();
    }

    public function changeStatusTariff(Request $request) {
        $params = $this->getRequestFields($request, ['tariff_id', 'status_id']);
        $params['user_id'] = $request->user()->getId();

        return $this->responseJSON($this->billingHandler->changeStatusTariff($params));
    }

    public function bindTariffBindUser(Request $request) {
        return $this->responseJSON($this->billingHandler->bindTariffToUser(
            $this->getRequestFields($request, ['user_id', 'tariff_id'])
        ));
    }

    public function getAllWriteOffs(Request $request) {
        return $this->billingHandler->getAllWriteOffs([])->getResult();
    }

    public function getCurrentWriteOffs(Request $request) {
        return $this->responseJSON($this->billingHandler->getUserWriteOffs([
            'user_id' => $request->user()->getId()
        ]));
    }

    public function getUserWriteOffs(Request $request) {
        return $this->responseJSON($this->billingHandler->getUserWriteOffs());
    }

    public function payRent(Request $request) {
        return $this->responseJSON($this->billingHandler->payRent(
            $this->getRequestFields($request, ['user_id', 'history_json'])
        ));
    }

    public function getCurrentTariff(Request $request) {
        return $this->responseJSON($this->billingHandler->getTariffUser([
            'user_id' => $request->user()->getId()
        ]));
    }
}
