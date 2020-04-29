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
     * Метод базового маршрута
     */
    public function index(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->index($params));
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
        $this->getRequestFields($request, ['name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setHeading($params));
    }

    /**
     * Метод маршрута для редактирования рубрики.
     */
    public function updateHeading(Request $request) {
        $this->getRequestFields($request, ['id', 'name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateHeading($params));
    }

    /**
     * Метод маршрута для получения списка маршрутов.
     */
    public function getRoutes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getRoutes($params));
    }

    /**
     * Метод маршрута для получения списка маршрутов.
     */
    public function getUserRoutes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getUserRoutes($params));
    }

    /**
     * Метод маршрута для создания маршрута.
     */
    public function setRoute(Request $request) {
        $this->getRequestFields($request, ['name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setRoute($params, $request->allFiles()));
    }

    /**
     * Метод маршрута для редактирования постера маршрута.
     */
    public function updatePosterRoute(Request $request) {
        $this->getRequestFields($request, ['id']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updatePosterRoute($params, $request->allFiles()));
    }

    /**
     * Метод маршрута для редактирования маршрута.
     */
    public function updateRoute(Request $request) {
        $this->getRequestFields($request, ['id', 'name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateRoute($params));
    }

    /**
     * Метод маршрута для удаления маршрутов.
     */
    public function deleteRoutes(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteRoutes($params));
    }

    /**
     * Метод маршрута для покупки маршрута пользователем.
     */
    public function paidRoute(Request $request) {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->paidRoute($params));
    }

    /**
     * Метод маршрута для получения списка точек.
     */
    public function getPoints(Request $request) {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getPoints($params));
    }

    /**
     * Метод маршрута для создания точки.
     */
    public function setPoint(Request $request) {
        $this->getRequestFields($request, ['routeId', 'lat', 'lng', 'placeName']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setPoint($params));
    }

    /**
     * Метод маршрута для создания точек.
     */
    public function setPointArr(Request $request) {
        $this->getRequestFields($request, ['routeId', 'points']);
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->setPointArr($params));
    }

    /**
     * Метод маршрута для редактирования точки.
     */
    public function updatePoint(Request $request) {
        $this->getRequestFields($request, ['id', 'lat', 'lng', 'placeName']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updatePoint($params));
    }

    /**
     * Метод маршрута для удаления точек.
     */
    public function deletePoints(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deletePoints($params));
    }

    /**
     * Метод маршрута для получения списка комментариев к маршруту.
     */
    public function getComments(Request $request) {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->getComments($params));
    }

    /**
     * Метод маршрута для создания комментария к маршруту.
     */
    public function setComment(Request $request) {
        $this->getRequestFields($request, ['routeId', 'commentary']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->setComment($params));
    }

    /**
     * Метод маршрута для редактирования комментария к маршруту.
     */
    public function updateComment(Request $request) {
        $this->getRequestFields($request, ['id', 'commentary']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->updateComment($params));
    }

    /**
     * Метод маршрута для удаления комментария к маршруту.
     */
    public function deleteComments(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->routesHandler->deleteComments($params));
    }

    /**
     * Метод маршрута для получения списка действий пользователей.
     * Для выборки действий пользователя нужно указать его идентификатор.
     */
    public function getAudit(Request $request) {
        $params = $request->all();
        return $this->responseJSON($this->routesHandler->getAudit($params));
    }
}
