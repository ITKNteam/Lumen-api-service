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
     * Метод маршрута для получения списка типов объекта.
     */
    public function getObjectTypes(Request $request) {
        return $this->responseJSON($this->objectsHandler->getObjectTypes($request->all()));
    }

    /**
     * Метод маршрута для создания типа объекта.
     */
    public function setObjectType(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setObjectType($requestFields));
    }

    /**
     * Метод маршрута для редактирования типа объекта.
     */
    public function updateObjectType(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObjectType($requestFields));
    }

    /**
     * Метод маршрута для удаления типов объекта.
     */
    public function deleteObjectTypes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteObjectTypes($params));
    }

    /**
     * Метод маршрута для получения списка подтипов объекта.
     */
    public function getObjectSubtypes(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getObjectSubtypes($requestFields));
    }

    /**
     * Метод маршрута для создания подтипа объекта.
     */
    public function setObjectSubtype(Request $request) {
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
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObjectSubtype($requestFields));
    }

    /**
     * Метод маршрута для удаления подтипов объекта.
     */
    public function deleteObjectSubtypes(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteObjectSubtypes($params));
    }

    /**
     * Метод маршрута для получения списка объектов.
     */
    public function getObjects(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->getObjects($requestFields));
    }

    /**
     * Метод маршрута для создания объекта.
     */
    public function setObject(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setObject($requestFields));
    }

    /**
     * Метод маршрута для редактирования объекта.
     */
    public function updateObject(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateObject($requestFields));
    }

    /**
     * Метод маршрута для удаления объектов.
     */
    public function deleteObjects(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteObjects($requestFields));
    }

    /**
     * Метод маршрута для получения списка комментариев к объекту.
     */
    public function getComments(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getComments($requestFields));
    }

    /**
     * Метод маршрута для создания комментария к объекту.
     */
    public function setComment(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setComment($requestFields));
    }

    /**
     * Метод маршрута для редактирования комментария к объекту.
     */
    public function updateComment(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateComment($requestFields));
    }

    /**
     * Метод маршрута для удаления комментария к объекту.
     */
    public function deleteComments(Request $request) {
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
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->setFileType($requestFields));
    }

    /**
     * Метод маршрута для редактирования типа файла.
     */
    public function updateFileType(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->objectsHandler->updateFileType($requestFields)->getResult();
    }

    /**
     * Метод маршрута для удаления типов файлов.
     */
    public function deleteFileTypes(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteFileTypes($requestFields));
    }

    /**
     * Метод маршрута для получения списка прикрепленных файлов к объекту.
     */
    public function getAttachedFiles(Request $request) {
        $requestFields = $request->all();
        return $this->responseJSON($this->objectsHandler->getAttachedFiles($requestFields));
    }

    /**
     * Метод маршрута для прикрепления файлов к объекту.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setAttachedFile(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();

        return $this->responseJSON(
            $request->hasFile('files')
                ? $this->objectsHandler->setAttachedFile($requestFields, $request->allFiles())
                : $this->objectsHandler->setAttachedFile($requestFields)
        );
    }

    /**
     * Метод маршрута для редактирования файла.
     */
    public function updateAttachedFile(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->updateAttachedFile($requestFields));
    }

    /**
     * Метод маршрута для открепления прикрепленных файлов к объекту.
     */
    public function deleteAttachedFiles(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->deleteAttachedFiles($requestFields));
    }

    /**
     * Метод маршрута для прикрепления файлов к файлу объекта.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function linkFileToFile(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON(
            $request->hasFile('files')
                ? $this->objectsHandler->linkFileToFile($requestFields, $request->allFiles())
                : $this->objectsHandler->linkFileToFile($requestFields)
        );
    }

    /**
     * Метод маршрута для разгрупировки файлов.
     */
    public function unlinkFileFromFile(Request $request) {
        $requestFields = $request->all();
        $requestFields['userId'] = $request->user()->getId();
        return $this->responseJSON($this->objectsHandler->unlinkFileFromFile($requestFields));
    }
}
