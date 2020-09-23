<?php

namespace App\Http\Controllers;

use App\Providers\transport\RoutesHandler;
use Illuminate\Http\Request;
use Exception;

class RoutesController extends Controller {

    private $routesHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->routesHandler = new RoutesHandler(env('ROUTES_URI'));
    }

    /**
     * Метод маршрута для получения списка рубрик.
     */
    public function getHeadings(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getHeadings($params));
    }

    /**
     * Метод маршрута для создания рубрики.
     */
    public function setHeading(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setHeading($params));
    }

    /**
     * Метод маршрута для редактирования рубрики.
     */
    public function updateHeading(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateHeading($params));
    }

    /**
     * Метод маршрута для удаления рубрик.
     */
    public function deleteHeadings(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteHeadings($params));
    }

    /**
     * Метод маршрута для получения списка маршрутов для магазина.
     */
    public function getRoutesShop(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getRoutesShop($params));
    }

    /**
     * Метод маршрута для получения списка маршрутов пользователя.
     */
    public function getRoutesUser(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getRoutesUser($params));
    }

    /**
     * Метод маршрута для создания маршрута.
     */
    public function setRoute(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setRoute($params, $request->allFiles()));
    }

    /**
     * Метод маршрута для редактирования маршрута.
     */
    public function updateRoute(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateRoute($params));
    }

    /**
     * Метод маршрута для удаления маршрутов.
     */
    public function deleteRoutes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteRoutes($params));
    }

    /**
     * Метод маршрута для редактирования постера маршрута.
     */
    public function updatePosterRoute(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updatePosterRoute($params, $request->allFiles()));
    }

    /**
     * Метод маршрута для покупки маршрута пользователем.
     */
    public function purchaseRoute(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->purchaseRoute($params));
    }

    /**
     * Метод маршрута для удаления покупок.
     */
    public function deletePurchasesRoutes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deletePurchasesRoutes($params));
    }

    /**
     * Метод маршрута для получения списка точек.
     */
    public function getPoints(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getPoints($params));
    }

    /**
     * Метод маршрута для создания точек.
     */
    public function setPoints(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setPoints($params));
    }

    /**
     * Метод маршрута для редактирования точки.
     */
    public function updatePoint(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updatePoint($params));
    }

    /**
     * Метод маршрута для удаления точек.
     */
    public function deletePoints(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deletePoints($params));
    }

    /**
     * Метод маршрута для получения списка комментариев к маршруту.
     */
    public function getComments(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getComments($params));
    }

    /**
     * Метод маршрута для создания комментария к маршруту.
     */
    public function setComment(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setComment($params));
    }

    /**
     * Метод маршрута для редактирования комментария к маршруту.
     */
    public function updateComment(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateComment($params));
    }

    /**
     * Метод маршрута для удаления комментария к маршруту.
     */
    public function deleteComments(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteComments($params));
    }

    /**
     * Метод маршрута для получения списка статистики оценок и отзывав.
     */
    public function getRouteCommentsRatingReviews(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getRouteCommentsRatingReviews($params));
    }

    /**
     * Метод маршрута для получения списка действий пользователей.
     * Для выборки действий пользователя нужно указать его идентификатор.
     */
    public function getAudit(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getAudit($params));
    }

    /**
     * Метод маршрута для получения списка фильтров.
     */
    public function getFilters(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getFilters($params));
    }

    /**
     * Метод маршрута для создания фильтра.
     */
    public function setFilter(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setFilter($params));
    }

    /**
     * Метод маршрута для редактирования фильтра.
     */
    public function updateFilter(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateFilter($params));
    }

    /**
     * Метод маршрута для удаления фильтров.
     */
    public function deleteFilters(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteFilters($params));
    }

    /**
     * Метод маршрута для получения списка статусов.
     */
    public function getStatuses(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getStatuses($params));
    }

    /**
     * Метод маршрута для создания статуса.
     */
    public function setStatus(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setStatus($params));
    }

    /**
     * Метод маршрута для редактирования статуса.
     */
    public function updateStatus(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateStatus($params));
    }

    /**
     * Метод маршрута для удаления статусов.
     */
    public function deleteStatuses(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteStatuses($params));
    }
}
