<?php

namespace App\Http\Controllers;

use App\Providers\transport\TranslateHandler;
use Illuminate\Http\Request;
use Exception;

class TranslateController extends Controller {

    private $routesHandler;

    private $userCntrl;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->routesHandler = new TranslateHandler(env('routes_uri'));
        $this->userCntrl = new UserController();
    }

    /**
     * Метод маршрута для получения хеша текущего состояния переводов,
     * производится для определения факта наличия изменений.
     */
    public function getCurrentKey(Request $request): array {
        return $this->translateHandler->getCurrentKey();
    }

    /**
     * Метод маршрута для получения словаря.
     */
    public function getTranslations(Request $request): array {
        return $this->translateHandler->getTranslations($request->all());
    }

    /**
     * Метод маршрута для получения списка переводов с пагинацией.
     */
    public function getItems(Request $request): array {
        return $this->translateHandler->getItems($request->all());
    }

    /**
     * Метод маршрута для создания перевода.
     */
    public function setItem(Request $request): array {
        $this->getRequestFields($request, ['keyword']);
        $params = $request->all();
        $params['userId'] = $this->userCntrl->getUserId($request);
        return $this->translateHandler->setItem($params);
    }

    /**
     * Метод маршрута для редактирования перевода.
     */
    public function updateItem(Request $request): array {
        $this->getRequestFields($request, ['id', 'keyword']);
        $params = $request->all();
        $params['userId'] = $this->userCntrl->getUserId($request);
        return $this->translateHandler->updateItem($params);
    }

    /**
     * Метод маршрута для удаления перевода.
     */
    public function deleteItems(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $this->userCntrl->getUserId($request);
        return $this->translateHandler->deleteItems($params);
    }

}
