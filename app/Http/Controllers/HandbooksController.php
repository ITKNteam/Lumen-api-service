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
        $this->handbooksHandler = new HandbooksHandler(env('biz_uri'));
        $this->userCntrl = new UserController();
    }

    /**
     * Метод маршрута для получения списка справочников.
     */
    public function getHandbooks(Request $request): array {
        return $this->handbooksHandler->getHandbooks([
            'filters' => $request->get('filters')
        ])->getResult();
    }

    /**
     * Метод маршрута для создания справочника.
     */
    public function setHandbook(Request $request): array {
        return $this->handbooksHandler->setHandbook(
            array_merge(
                $this->getRequestFields($request, [
                    'userId', 'name'
                ]),
                [
                    'parentId' => $request->get('parentId')
                ]
            )
        )->getResult();
    }

    /**
     * Метод маршрута для редактирования справочника.
     */
    public function updateHandbook(Request $request): array {
        return $this->handbooksHandler->updateHandbook(array_merge(
            $this->getRequestFields($request, [
                'id', 'userId', 'name'
            ]),
            [
                'parentId' => $request->get('parentId')
            ]
        ))->getResult();
    }

    /**
     * Метод маршрута для получения списка значений справочника.
     */
    public function getHandbookData(Request $request): array {
        return $this->handbooksHandler->getHandbookData([
            'filters' => $request->get('filters')
        ])->getResult();
    }

    /**
     * Метод маршрута для создания значения справочника.
     */
    public function setHandbookData(Request $request): array {
        return $this->handbooksHandler->setHandbookData(array_merge(
            $this->getRequestFields($request, [
                'handbookId', 'userId', 'value'
            ]),
            [
                'parentId' => $request->get('parentId'),
                'isoCode' => $request->get('isoCode'),
                'symbol' => $request->get('symbol'),
                'description' => $request->get('description'),
            ]
        ))->getResult();
    }

    /**
     * Метод маршрута для редактирования значения справочника.
     */
    public function updateHandbookData(Request $request): array {
        return $this->handbooksHandler->updateHandbookData(array_merge(
            $this->getRequestFields($request, [
                'id', 'handbookId', 'userId', 'value'
            ]),
            [
                'parentId' => $request->get('parentId'),
                'isoCode' => $request->get('isoCode'),
                'symbol' => $request->get('symbol'),
                'description' => $request->get('description'),
            ]
        ))->getResult();
    }

    public function dumpHandbooks(Request $request): array {
        $handbooksHandler = $this->handbooksHandler->dumpHandbooks();

        if ($handbooksHandler->isSuccess()) {
            return $handbooksHandler->getResult();
        } else {
            $$this->sentryAbort(new Exception($handbooksHandler->getMessage(), $handbooksHandler->getRes()));
        }
    }
}
