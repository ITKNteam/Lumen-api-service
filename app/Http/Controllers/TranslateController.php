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
    public function getCurrentKey(Request $request) {
        return $this->responseJSON($this->translateHandler->getCurrentKey([]));
    }

    /**
     * Метод маршрута для получения словаря.
     */
    public function getTranslations(Request $request) {
        $this->getRequestFields($request, ['language']);
        return $this->responseJSON($this->translateHandler->getTranslations($request->all()));
    }

    /**
     * Метод маршрута для получения списка переводов с пагинацией.
     */
    public function getItems(Request $request) {
        return $this->responseJSON($this->translateHandler->getItems($request->all()));
    }

    /**
     * Метод маршрута для создания перевода.
     */
    public function setItem(Request $request) {
        $this->getRequestFields($request, ['keyword']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->translateHandler->setItem($params));
    }

    /**
     * Метод маршрута для редактирования перевода.
     */
    public function updateItem(Request $request) {
        $this->getRequestFields($request, ['id', 'keyword']);
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->translateHandler->updateItem($params));
    }

    /**
     * Метод маршрута для удаления перевода.
     */
    public function deleteItems(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->translateHandler->deleteItems($params));
    }
}
