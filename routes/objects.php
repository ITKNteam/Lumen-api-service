<?php
$router->group(['prefix' => '/objects'], function () use ($router) {
    $controller = 'ObjectsController';

    /**
     * @OA\Get(
     *     path="/objects/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Список типов объекта",
     *     description="Маршрут для получения списка типов объекта",
     *     operationId="getObjectTypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/types', ['middleware' => 'auth', 'uses' => $controller . '@getObjectTypes']);
    /**
     * @OA\Post(
     *     path="/objects/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Создание типа объекта",
     *     description="Маршрут для создания типа объекта",
     *     operationId="setObjectType",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания типа объекта",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название типа объекта",
     *                      type="string"
     *                  )
     *             )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/types', ['middleware' => 'auth', 'uses' => $controller . '@setObjectType']);
    /**
     * @OA\Put(
     *     path="/objects/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование типа объекта",
     *     description="Маршрут для редактирования типа объекта",
     *     operationId="updateObjectType",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования типа объекта",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор типа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название типа объекта",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/types', ['middleware' => 'auth', 'uses' => $controller . '@updateObjectType']);
    /**
     * @OA\Delete(
     *     path="/objects/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление типов объектов",
     *     description="Маршрут для удаления типов объектов",
     *     operationId="deleteObjectTypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/types', ['middleware' => 'auth', 'uses' => $controller . '@deleteObjectTypes']);

    /**
     * @OA\Get(
     *     path="/objects/subtypes",
     *     tags={"Микросервис Объекты"},
     *     summary="Список подтипов объекта",
     *     description="Маршрут для получения списка подтипов объекта",
     *     operationId="getObjectSubtypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="typeId",
     *         in="query",
     *         description="Идентификатор типа объекта",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не найдено"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/subtypes', ['middleware' => 'auth', 'uses' => $controller . '@getObjectSubtypes']);
    /**
     * @OA\Post(
     *     path="/objects/subtypes",
     *     tags={"Микросервис Объекты"},
     *     summary="Создание типа объекта",
     *     description="Маршрут для создания типа объекта",
     *     operationId="setObjectSubtype",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания типа объекта",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"typeId", "name"},
     *                  @OA\Property(
     *                      property="typeId",
     *                      description="Идентификатор типа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название подтипа объекта",
     *                      type="string"
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/subtypes', ['middleware' => 'auth', 'uses' => $controller . '@setObjectSubtype']);
    /**
     * @OA\Put(
     *     path="/object/subtypes",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование подтипа объекта",
     *     description="Маршрут для редактирования подтипа объекта",
     *     operationId="updateObjectSubtype",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования подтипа объекта",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "typeId", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор подтипа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="typeId",
     *                      description="Идентификатор типа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название подтипа объекта",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/subtypes', ['middleware' => 'auth', 'uses' => $controller . '@updateObjectSubtype']);
    /**
     * @OA\Delete(
     *     path="/objects/subtypes",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление подтипов объектов",
     *     description="Маршрут для удаления подтипов объектов",
     *     operationId="deleteObjectSubtypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/subtypes', ['middleware' => 'auth', 'uses' => $controller . '@deleteObjectSubtypes']);

    /**
     * @OA\Get(
     *     path="/objects/list",
     *     tags={"Объекты"},
     *     summary="Список объектoв",
     *     description="Маршрут для получения списка объектов",
     *     operationId="getObjects",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество записей для выборки",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=25,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property':'name','value':'demo', 'operator':'='}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Сортировка по условию",
     *         required=false,
     *         example="[{'property':'name','direction':'desc'}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не найдено"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/list', ['middleware' => 'auth', 'uses' => $controller . '@getObjects']);
    /**
     * @OA\Post(
     *     path="/objects/list",
     *     tags={"Микросервис Объекты"},
     *     summary="Создание объекта",
     *     description="Маршрут для создания объекта. Может принимать любое количество дополнительных параметров, кроме указанных",
     *     operationId="setObject",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания объекта",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"subtypeId", "lat", "lng", "name"},
     *                  @OA\Property(
     *                      property="subtypeId",
     *                      description="Идентификатор подтипа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="lat",
     *                      description="Широта",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="lng",
     *                      description="Долгота",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название объекта",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *      @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/list', ['middleware' => 'auth', 'uses' => $controller . '@setObject']);
    /**
     * @OA\Put(
     *     path="/objects/list",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование объекта",
     *     description="Маршрут для редактирования объекта",
     *     operationId="updateObject",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания объекта",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="subtypeId",
     *                      description="Идентификатор подтипа объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="lat",
     *                      description="Широта",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="lng",
     *                      description="Долгота",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название объекта",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="isPublished",
     *                      description="Объект опубликован",
     *                      type="boolean"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/list', ['middleware' => 'auth', 'uses' => $controller . '@updateObject']);
    /**
     * @OA\Delete(
     *     path="/objects/list",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление объектов",
     *     description="Маршрут для удаления объектов",
     *     operationId="deleteObjects",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/list', ['middleware' => 'auth', 'uses' => $controller . '@deleteObjects']);

    /**
     * @OA\Get(
     *     path="/objects/comments",
     *     tags={"Микросервис Объекты"},
     *     summary="Список комментариев к объекту",
     *     description="Маршрут для получения списка комментариев к объекту",
     *     operationId="getObjectComments",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="objectId",
     *         in="query",
     *         description="Идентификатор объекта",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество записей для выборки",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=25,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property':'name','value':'demo', 'operator':'='}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Сортировка по условию",
     *         required=false,
     *         example="[{'property':'name','direction':'desc'}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не найдено"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/comments', ['middleware' => 'auth', 'uses' => $controller . '@getComments']);
    /**
     * @OA\Post(
     *     path="/objects/comments",
     *     tags={"Микросервис Объекты"},
     *     summary="Создание комментария к объекту",
     *     description="Маршрут для создания комментария к объекту",
     *     operationId="setObjectComment",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания комментария к объекту",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"objectId", "commentary"},
     *                  @OA\Property(
     *                      property="objectId",
     *                      description="Идентификатор объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="commentary",
     *                      description="Комментарий к объекту",
     *                      type="string"
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/comments', ['middleware' => 'auth', 'uses' => $controller . '@setComment']);
    /**
     * @OA\Put(
     *     path="/objects/comments",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование комментария к объекту",
     *     description="Маршрут для редактирования комментария к объекту",
     *     operationId="updateObjectComment",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования комментария к объекту",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "commentary"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор комментария",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="commentary",
     *                      description="Комментарий к объекту",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/comments', ['middleware' => 'auth', 'uses' => $controller . '@updateComment']);
    /**
     * @OA\Delete(
     *     path="/objects/comments",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление комментариев к объекту",
     *     description="Маршрут для удаления комментариев к объекту",
     *     operationId="deleteObjectComments",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/comments', ['middleware' => 'auth', 'uses' => $controller . '@deleteComments']);

    /**
     * @OA\Get(
     *     path="/objects/audit",
     *     tags={"Микросервис Объекты"},
     *     summary="Список действий пользователей",
     *     description="Маршрут для получения списка действий пользователей",
     *     operationId="getObjectsAudit",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество записей для выборки",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=25,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property':'name','value':'demo', 'operator':'='}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Сортировка по условию",
     *         required=false,
     *         example="[{'property':'name','direction':'desc'}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="items",
     *                 description="Список записей",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         description="Идентификатор",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="changes",
     *                         description="Лог изменений в формате JSON",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="createdTs",
     *                         description="Время создания",
     *                         type="string"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="total",
     *                 description="Количество записей",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="exception",
     *                 description="Причина сбоя",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     */
    $router->get('/audit', ['middleware' => 'auth', 'uses' => $controller . '@getAudit']);

    /**
     * @OA\Get(
     *     path="/objects/file/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Список типов файлов",
     *     description="Маршрут для получения списка типов файлов",
     *     operationId="getFileTypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/file/types', ['middleware' => 'auth', 'uses' => $controller . '@getFileTypes']);
    /**
     * @OA\Post(
     *     path="/objects/file/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Создание типа файла",
     *     description="Маршрут для создания типа файла",
     *     operationId="setFileType",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания типа файла",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название типа файла",
     *                      type="string"
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/file/types', ['middleware' => 'auth', 'uses' => $controller . '@setFileType']);
    /**
     * @OA\Put(
     *     path="/objects/file/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование типа файла",
     *     description="Маршрут для редактирования типа файла",
     *     operationId="updateFileType",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования типа файла",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор типа файла",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название типа файла",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/file/types', ['middleware' => 'auth', 'uses' => $controller . '@updateFileType']);
    /**
     * @OA\Delete(
     *     path="/objects/file/types",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление типов файлов",
     *     description="Маршрут для удаления типов файлов",
     *     operationId="deleteObjectsFileTypes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/file/types', ['middleware' => 'auth', 'uses' => $controller . '@deleteFileTypes']);

    /**
     * @OA\Get(
     *     path="/objects/file/attached",
     *     tags={"Микросервис Объекты"},
     *     summary="Список прикрепленных файлов",
     *     description="Маршрут для получения списка прикрепленных файлов к объекту",
     *     operationId="getAttachedFiles",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="objectId",
     *         in="query",
     *         description="Идентификатор объекта",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество записей для выборки",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=25,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property':'name','value':'demo', 'operator':'='}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Сортировка по условию",
     *         required=false,
     *         example="[{'property':'name','direction':'desc'}]",
     *         @OA\Schema(
     *             type="string",
     *             default=null
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/file/attached', ['middleware' => 'auth', 'uses' => $controller . '@getAttachedFiles']);
    /**
     * @OA\Post(
     *     path="/objects/file/attached",
     *     tags={"Микросервис Объекты"},
     *     summary="Сохранение файлов и прикрепление его к объекту",
     *     description="Маршрут для прикрепления файлов к объекту",
     *     operationId="setAttachedFiles",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма для прикрепления файлов к объекту",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"objectId", "files"},
     *                  @OA\Property(
     *                      property="objectId",
     *                      description="Идентификатор объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="files",
     *                      description="Выбранные файлы",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          format="binary"
     *                      )
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/file/attached', ['middleware' => 'auth', 'uses' => $controller . '@setAttachedFile']);
    /**
     * @OA\Put(
     *     path="/objects/file/attached",
     *     tags={"Микросервис Объекты"},
     *     summary="Редактирование данных прикрепленного файла",
     *     description="Маршрут для редактирования данных прикрепленного файла",
     *     operationId="updateAttachedFile",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования данных прикрепленного файла",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор прикрепленного файла",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="index",
     *                      description="Порядковый номер файла для отображения",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="linkId",
     *                      description="Идентификатор родительского файла для прикрепления",
     *                      type="integer",
     *                      format="int64"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/file/attached', ['middleware' => 'auth', 'uses' => $controller . '@updateAttachedFile']);
    /**
     * @OA\Delete(
     *     path="/objects/file/attached",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление прикрепленных файлов к объекту",
     *     description="Маршрут для удаления прикрепленных файлов к объекту",
     *     operationId="deleteAttachedFiles",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов файлов через запятую",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Записи для удаления не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка удаления записи"
     *     )
     * )
     */
    $router->delete('/file/attached', ['middleware' => 'auth', 'uses' => $controller . '@deleteAttachedFiles']);

    /**
     * @OA\Post(
     *     path="/objects/file/attached/link",
     *     tags={"Микросервис Объекты"},
     *     summary="Сохранение файлов и прикрепление их к файлу объекта",
     *     description="Маршрут для прикрепления файлов к файлу объекта",
     *     operationId="linkFileToFile",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма для прикрепления файлов к файлу объекта",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"objectId", "id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор файла",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="objectId",
     *                      description="Идентификатор объекта",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="index",
     *                      description="Порядковый номер для отображения",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="files",
     *                      description="Выбранные файлы",
     *                      type="string",
     *                      format="binary"
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->post('/file/attached/link', ['middleware' => 'auth', 'uses' => $controller . '@linkFileToFile']);
    /**
     * @OA\Put(
     *     path="/objects/file/attached/link",
     *     tags={"Микросервис Объекты"},
     *     summary="Разгрупировка файлов",
     *     description="Маршрут для разгрупировки файлов",
     *     operationId="unlinkFileFromFile",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма разгрупировки файлов",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор родительского файла",
     *                      type="integer",
     *                      format="int64"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка сохранения записи"
     *     )
     * )
     */
    $router->put('/file/attached/link', ['middleware' => 'auth', 'uses' => $controller . '@unlinkFileFromFile']);
});