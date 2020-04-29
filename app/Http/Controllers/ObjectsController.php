<?php

namespace App\Http\Controllers;

use App\Providers\transport\ObjectsHandler;
use Illuminate\Http\Request;
use Exception;

class ObjectsController extends Controller {

    private $objectsHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->objectsHandler = new ObjectsHandler(env('OBJECTS_URI'));
    }


    /**
     * Метод базового маршрута
     */
    public function index(Request $request) {
        return $this->responseJSON($this->objectsHandler->index($request->all()));
    }

    /**
     * Метод маршрута для получения списка типов объекта.
     */
    public function getObjectTypes(Request $request) {
        return $this->responseJSON($this->objectsHandler->getObjectTypes($request->all()));
    }

    /**
     * Метод маршрута для создания типа объекта.
     */
    public function setObjectType(Request $request) {
        $this->getRequestFields($request, ['name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setObjectType($requestFields));
    }

    /**
     * Метод маршрута для редактирования типа объекта.
     */
    public function updateObjectType(Request $request) {
        $this->getRequestFields($request, ['name', 'id']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObjectType($requestFields));
    }

    /**
     * Метод маршрута для получения списка подтипов объекта.
     */
    public function getObjectSubtypes(Request $request) {
        $this->getRequestFields($request, ['typeId']);
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getObjectSubtypes($requestFields));
    }

    /**
     * Метод маршрута для создания подтипа объекта.
     */
    public function setObjectSubtype(Request $request) {
        $this->getRequestFields($request, ['typeId', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setObjectSubtype($requestFields));
    }

    /**
     * Метод маршрута для редактирования подтипа объекта.
     * @param Request $request
     * @return array
     */
    public function updateObjectSubtype(Request $request) {
        $this->getRequestFields($request, ['id', 'typeId', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObjectSubtype($requestFields));
    }

    /**
     * Метод маршрута для получения списка публичных объектов.
     */
    public function getPublicObjects(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->getPublicObjects($requestFields));
    }

    /**
     * Метод маршрута для получения списка объектов.
     */
    public function getListObjects(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getListObjects($requestFields));
    }

    /**
     * Метод маршрута для получения списка объектов пользователя.
     */
    public function getUserObjects(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->getUserObjects($requestFields));
    }

    /**
     * Метод маршрута для создания объекта.
     */
    public function setObject(Request $request) {
        $this->getRequestFields($request, ['subtypeId', 'lat', 'lng', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setObject($requestFields));
    }

    /**
     * Метод маршрута для редактирования объекта.
     */
    public function updateObject(Request $request) {
        $this->getRequestFields($request, ['id', 'subtypeId', 'lat', 'lng', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObject($requestFields));
    }

    /**
     * Метод маршрута для удаления объектов.
     */
    public function deleteObjects(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }

        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteObjects($requestFields));
    }

    /**
     * Метод маршрута для получения списка комментариев к объекту.
     */
    public function getComments(Request $request) {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getComments($requestFields));
    }

    /**
     * Метод маршрута для создания комментария к объекту.
     */
    public function setComment(Request $request) {
        $this->getRequestFields($request, ['objectId', 'commentary']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setComment($requestFields));
    }

    /**
     * Метод маршрута для редактирования комментария к объекту.
     */
    public function updateComment(Request $request) {
        $this->getRequestFields($request, ['id', 'commentary']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateComment($requestFields));
    }

    /**
     * Метод маршрута для удаления комментария к объекту.
     */
    public function deleteComments(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteComments($requestFields));
    }

    /**
     * Метод маршрута для получения списка действий пользователей.
     * Для выборки действий пользователя нужно указать его идентификатор.
     */
    public function getAudit(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getAudit($requestFields));
    }

    /**
     * Метод маршрута для получения списка типов файлов.
     */
    public function getFileTypes(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getFileTypes($requestFields));
    }

    /**
     * Метод маршрута для создания типа файла.
     */
    public function setFileType(Request $request) {
        $this->getRequestFields($request, ['name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setFileType($requestFields));
    }

    /**
     * Метод маршрута для редактирования типа файла.
     */
    public function updateFileType(Request $request) {
        $this->getRequestFields($request, ['id', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateFileType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка прикрепленных файлов к объекту.
     */
    public function getAttachedFiles(Request $request) {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getAttachedFiles($requestFields));
    }

    /**
     * Метод маршрута для прикрепления файлов к объекту.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setAttachedFile(Request $request) {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();

        return $this->responseJSON(
            $request->hasFile()
                ? $this->objectsHandler->setAttachedFile($requestFields, $this->request->getUploadedFiles())
                : $this->objectsHandler->setAttachedFile($requestFields)
        );
    }

    /**
     * Метод маршрута для открепления прикрепленных файлов к объекту.
     */
    public function deleteAttachedFiles(Request $request) {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->deleteAttachedFiles($requestFields));
    }

    /**
     * Метод маршрута для редактирования файла.
     */
    public function updateAttachedFile(Request $request) {
        $this->getRequestFields($request, ['id', 'index']);
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->updateAttachedFile($requestFields));
    }

    /**
     * Метод маршрута для прикрепления файлов к файлу объекта.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function linkFileToFile(Request $request) {
        $this->getRequestFields($request, ['id', 'objectId']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON(
            $request->hasFile()
                ? $this->objectsHandler->linkFileToFile($requestFields, $this->request->getUploadedFiles())
                : $this->objectsHandler->linkFileToFile($requestFields)
        );
    }

    /**
     * Метод маршрута для разгрупировки файлов.
     */
    public function unlinkFileFromFile(Request $request) {
        $this->getRequestFields($request, ['id']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->unlinkFileFromFile($requestFields));
    }
}
