<?php

namespace App\Http\Controllers;

use App\Providers\transport\TranslateHandler;
use Illuminate\Http\Request;
use Exception;

class TranslateController extends Controller {

    private $translateHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->translateHandler = new TranslateHandler(env('BIZ_URI'));
    }

    /**
     * Метод маршрута для получения хеша текущего состояния переводов,
     * производится для определения факта наличия изменений.
     */
    public function getCurrentKey(Request $request): array {
        return $this->translateHandler->getCurrentKey([])->getResult();
    }

    /**
     * Метод маршрута для получения словаря.
     */
    public function getTranslations(Request $request): array {
        $this->getRequestFields($request, ['language']);
        return $this->translateHandler->getTranslations($request->all())->getResult();
    }

    /**
     * Метод маршрута для получения списка переводов с пагинацией.
     */
    public function getItems(Request $request): array {
        return $this->translateHandler->getItems($request->all())->getResult();
    }

    /**
     * Метод маршрута для создания перевода.
     */
    public function setItem(Request $request): array {
        $this->getRequestFields($request, ['keyword']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->translateHandler->setItem($params)->getResult();
    }

    /**
     * Метод маршрута для редактирования перевода.
     */
    public function updateItem(Request $request): array {
        $this->getRequestFields($request, ['id', 'keyword']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->translateHandler->updateItem($params)->getResult();
    }

    /**
     * Метод маршрута для удаления перевода.
     */
    public function deleteItems(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->translateHandler->deleteItems($params)->getResult();
    }
}
