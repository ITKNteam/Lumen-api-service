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
        return $this->routesHandler->index($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка рубрик.
     */
    public function getHeadings(Request $request): array {
        $params = $request->all();
        return $this->routesHandler->getHeadings($params)->getResult();
    }

    /**
     * Метод маршрута для создания рубрики.
     */
    public function setHeading(Request $request): array {
        $this->getRequestFields($request, ['name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->setHeading($params)->getResult();
    }

    /**
     * Метод маршрута для редактирования рубрики.
     */
    public function updateHeading(Request $request): array {
        $this->getRequestFields($request, ['id', 'name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->updateHeading($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка маршрутов.
     */
    public function getRoutes(Request $request): array {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->getRoutes($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка маршрутов.
     */
    public function getUserRoutes(Request $request): array {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->getUserRoutes($params)->getResult();
    }

    /**
     * Метод маршрута для создания маршрута.
     */
    public function setRoute(Request $request): array {
        $this->getRequestFields($request, ['name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->setRoute($params, $request->allFiles())->getResult();
    }

    /**
     * Метод маршрута для редактирования постера маршрута.
     */
    public function updatePosterRoute(Request $request): array {
        $this->getRequestFields($request, ['id']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->updatePosterRoute($params, $request->allFiles())->getResult();
    }

    /**
     * Метод маршрута для редактирования маршрута.
     */
    public function updateRoute(Request $request): array {
        $this->getRequestFields($request, ['id', 'name']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->updateRoute($params)->getResult();
    }

    /**
     * Метод маршрута для удаления маршрутов.
     */
    public function deleteRoutes(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->deleteRoutes($params)->getResult();
    }

    /**
     * Метод маршрута для покупки маршрута пользователем.
     */
    public function paidRoute(Request $request): array {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->paidRoute($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка точек.
     */
    public function getPoints(Request $request): array {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        return $this->routesHandler->getPoints($params)->getResult();
    }

    /**
     * Метод маршрута для создания точки.
     */
    public function setPoint(Request $request): array {
        $this->getRequestFields($request, ['routeId', 'lat', 'lng', 'placeName']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->setPoint($params)->getResult();
    }

    /**
     * Метод маршрута для создания точек.
     */
    public function setPointArr(Request $request): array {
        $this->getRequestFields($request, ['routeId', 'points']);
        $params = $request->all();
        return $this->routesHandler->setPointArr($params)->getResult();
    }

    /**
     * Метод маршрута для редактирования точки.
     */
    public function updatePoint(Request $request): array {
        $this->getRequestFields($request, ['id', 'lat', 'lng', 'placeName']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->updatePoint($params)->getResult();
    }

    /**
     * Метод маршрута для удаления точек.
     */
    public function deletePoints(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->deletePoints($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка комментариев к маршруту.
     */
    public function getComments(Request $request): array {
        $this->getRequestFields($request, ['routeId']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->getComments($params)->getResult();
    }

    /**
     * Метод маршрута для создания комментария к маршруту.
     */
    public function setComment(Request $request): array {
        $this->getRequestFields($request, ['routeId', 'commentary']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->setComment($params)->getResult();
    }

    /**
     * Метод маршрута для редактирования комментария к маршруту.
     */
    public function updateComment(Request $request): array {
        $this->getRequestFields($request, ['id', 'commentary']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->updateComment($params)->getResult();
    }

    /**
     * Метод маршрута для удаления комментария к маршруту.
     */
    public function deleteComments(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->routesHandler->deleteComments($params)->getResult();
    }

    /**
     * Метод маршрута для получения списка действий пользователей.
     * Для выборки действий пользователя нужно указать его идентификатор.
     */
    public function getAudit(Request $request): array {
        $params = $request->all();
        return $this->routesHandler->getAudit($params)->getResult();
    }
}
