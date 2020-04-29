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
    public function index(Request $request): array {
        return $this->objectsHandler->index($request->all())->getResult();
    }

    /**
     * Метод маршрута для получения списка типов объекта.
     */
    public function getObjectTypes(Request $request) {
        return $this->objectsHandler->getObjectTypes($request->all())->getResult();
    }

    /**
     * Метод маршрута для создания типа объекта.
     */
    public function setObjectType(Request $request): array {
        $this->getRequestFields($request, ['name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->setObjectType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования типа объекта.
     */
    public function updateObjectType(Request $request): array {
        $this->getRequestFields($request, ['name', 'id']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateObjectType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка подтипов объекта.
     */
    public function getObjectSubtypes(Request $request): array {
        $this->getRequestFields($request, ['typeId']);
        $requestFields = $request->all();
        return $this->objectsHandler->getObjectSubtypes($requestFields)->getResult();
    }

    /**
     * Метод маршрута для создания подтипа объекта.
     */
    public function setObjectSubtype(Request $request): array {
        $this->getRequestFields($request, ['typeId', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->setObjectSubtype($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования подтипа объекта.
     * @param Request $request
     * @return array
     */
    public function updateObjectSubtype(Request $request): array {
        $this->getRequestFields($request, ['id', 'typeId', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateObjectSubtype($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка публичных объектов.
     */
    public function getPublicObjects(Request $request): array {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->getPublicObjects($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка объектов.
     */
    public function getListObjects(Request $request): array {
        $requestFields = $request->all();
        return $this->objectsHandler->getListObjects($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка объектов пользователя.
     */
    public function getUserObjects(Request $request): array {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->getUserObjects($requestFields)->getResult();
    }

    /**
     * Метод маршрута для создания объекта.
     */
    public function setObject(Request $request): array {
        $this->getRequestFields($request, ['subtypeId', 'lat', 'lng', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->setObject($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования объекта.
     */
    public function updateObject(Request $request): array {
        $this->getRequestFields($request, ['id', 'subtypeId', 'lat', 'lng', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateObject($requestFields)->getResult();
    }

    /**
     * Метод маршрута для удаления объектов.
     */
    public function deleteObjects(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }

        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->deleteObjects($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка комментариев к объекту.
     */
    public function getComments(Request $request): array {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        return $this->objectsHandler->getComments($requestFields)->getResult();
    }

    /**
     * Метод маршрута для создания комментария к объекту.
     */
    public function setComment(Request $request): array {
        $this->getRequestFields($request, ['objectId', 'commentary']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->setComment($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования комментария к объекту.
     */
    public function updateComment(Request $request): array {
        $this->getRequestFields($request, ['id', 'commentary']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateComment($requestFields)->getResult();
    }

    /**
     * Метод маршрута для удаления комментария к объекту.
     */
    public function deleteComments(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->deleteComments($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка действий пользователей.
     * Для выборки действий пользователя нужно указать его идентификатор.
     */
    public function getAudit(Request $request): array {
        $requestFields = $request->all();
        return $this->objectsHandler->getAudit($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка типов файлов.
     */
    public function getFileTypes(Request $request): array {
        $requestFields = $request->all();
        return $this->objectsHandler->getFileTypes($requestFields)->getResult();
    }

    /**
     * Метод маршрута для создания типа файла.
     */
    public function setFileType(Request $request): array {
        $this->getRequestFields($request, ['name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->setFileType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования типа файла.
     */
    public function updateFileType(Request $request): array {
        $this->getRequestFields($request, ['id', 'name']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateFileType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для получения списка прикрепленных файлов к объекту.
     */
    public function getAttachedFiles(Request $request): array {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        return $this->objectsHandler->getAttachedFiles($requestFields)->getResult();
    }

    /**
     * Метод маршрута для прикрепления файлов к объекту.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setAttachedFile(Request $request): array {
        $this->getRequestFields($request, ['objectId']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();

        return $request->hasFile()
            ? $this->objectsHandler->setAttachedFile($requestFields, $this->request->getUploadedFiles())
            : $this->objectsHandler->setAttachedFile($requestFields);
    }

    /**
     * Метод маршрута для открепления прикрепленных файлов к объекту.
     */
    public function deleteAttachedFiles(Request $request): array {
        if (!$request->has('id') && !$request->has('listId')) {
            abort(400, 'Missing parameter: id or listId');
        }
        $requestFields = $request->all();
        return $this->objectsHandler->deleteAttachedFiles($requestFields)->getResult();
    }

    /**
     * Метод маршрута для редактирования файла.
     */
    public function updateAttachedFile(Request $request): array {
        $this->getRequestFields($request, ['id', 'index']);
        $requestFields = $request->all();
        return $this->objectsHandler->updateAttachedFile($requestFields)->getResult();
    }

    /**
     * Метод маршрута для прикрепления файлов к файлу объекта.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function linkFileToFile(Request $request): array {
        $this->getRequestFields($request, ['id', 'objectId']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $request->hasFile()
            ? $this->objectsHandler->linkFileToFile($requestFields, $this->request->getUploadedFiles())->getResult()
            : $this->objectsHandler->linkFileToFile($requestFields)->getResult();
    }

    /**
     * Метод маршрута для разгрупировки файлов.
     */
    public function unlinkFileFromFile(Request $request): array {
        $this->getRequestFields($request, ['id']);
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->unlinkFileFromFile($requestFields)->getResult();
    }

}
