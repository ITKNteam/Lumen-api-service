<?php

namespace App\Http\Controllers;

use App\Providers\transport\HandbooksHandler;
use Illuminate\Http\Request;
use Exception;

class HandbooksController extends Controller {

    private $handbooksHandler;

    private $userCntrl;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->handbooksHandler = new HandbooksHandler(env('BIZ_URI'));
        $this->userCntrl = new UserController();
    }

    /**
     * Метод маршрута для получения списка справочников.
     */
    public function getHandbooks(Request $request) {
        return $this->responseJSON($this->handbooksHandler->getHandbooks([
            'filters' => $request->get('filters')
        ]));
    }

    /**
     * Метод маршрута для создания справочника.
     */
    public function setHandbook(Request $request) {
        return $this->responseJSON($this->handbooksHandler->setHandbook(
            array_merge(
                $this->getRequestFields($request, [
                    'userId', 'name'
                ]),
                [
                    'parentId' => $request->get('parentId')
                ]
            )
        ));
    }

    /**
     * Метод маршрута для редактирования справочника.
     */
    public function updateHandbook(Request $request) {
        return $this->responseJSON($this->handbooksHandler->updateHandbook(array_merge(
            $this->getRequestFields($request, [
                'id', 'userId', 'name'
            ]),
            [
                'parentId' => $request->get('parentId')
            ]
        )));
    }

    /**
     * Метод маршрута для получения списка значений справочника.
     */
    public function getHandbookData(Request $request) {
        return $this->responseJSON($this->handbooksHandler->getHandbookData([
            'filters' => $request->get('filters')
        ]));
    }

    /**
     * Метод маршрута для создания значения справочника.
     */
    public function setHandbookData(Request $request) {
        return $this->responseJSON($this->handbooksHandler->setHandbookData(array_merge(
            $this->getRequestFields($request, [
                'handbookId', 'userId', 'value'
            ]),
            [
                'parentId' => $request->get('parentId'),
                'isoCode' => $request->get('isoCode'),
                'symbol' => $request->get('symbol'),
                'description' => $request->get('description'),
            ]
        )));
    }

    /**
     * Метод маршрута для редактирования значения справочника.
     */
    public function updateHandbookData(Request $request) {
        return $this->responseJSON($this->handbooksHandler->updateHandbookData(array_merge(
            $this->getRequestFields($request, [
                'id', 'handbookId', 'userId', 'value'
            ]),
            [
                'parentId' => $request->get('parentId'),
                'isoCode' => $request->get('isoCode'),
                'symbol' => $request->get('symbol'),
                'description' => $request->get('description'),
            ]
        )));
    }

    public function dumpHandbooks(Request $request) {
        $handbooksHandler = $this->handbooksHandler->dumpHandbooks();

        if ($handbooksHandler->isSuccess()) {
            return $this->responseJSON($handbooksHandler);
        } else {
            return $this->failResponse($handbooksHandler);
        }
    }
}
