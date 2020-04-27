<?php
$router->group(['prefix' => '/objects'], function () use ($router) {
    $controller = "ObjectsController";

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
     *                         property="name",
     *                         description="Название",
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
    $router->get('/types', "$controller@getObjectTypes");
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
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
     *         description="Ошибка создания записи",
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
    $router->post('/types', "$controller@setObjectType");
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
     *         description="Ошибка создания записи",
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
    $router->put('/types', "$controller@updateObjectType");

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
     *                         property="typeId",
     *                         description="Идентификатор типа",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         description="Название",
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
    $router->get('/subtypes', "$controller@getObjectSubtypes");
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
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
     *         description="Ошибка создания записи",
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
    $router->post('/subtypes', "$controller@setObjectSubtype");
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
     *         description="Ошибка создания записи",
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
    $router->put('/subtypes', "$controller@updateObjectSubtype");

    /**
     * @OA\Get(
     *     path="/objects/list",
     *     tags={"Объекты"},
     *     summary="Список объектoв",
     *     description="Маршрут для получения списка объектов",
     *     operationId="getListObjects",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="filters",
     *         in="query",
     *         description="Фильтр для выборки",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="object",
     *                  @OA\Property(
     *                      property="property",
     *                      description="Параметр поиска",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="value",
     *                      description="Значение для поиска",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="operation",
     *                      default="=",
     *                      description="Операция для поиска (=, like, ilike, or, in)",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество записей для выборки",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
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
     *                         property="subtypeId",
     *                         description="Идентификатор подтипа",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя, создавшего объект",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="lat",
     *                         description="Широта",
     *                         type="number"
     *                     ),
     *
     *                     @OA\Property(
     *                         property="lng",
     *                         description="Долгота",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         description="Название",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Дополнительные данные о объекте в формате JSON",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="isPublic",
     *                         description="Признак публичности",
     *                         type="boolean"
     *                     ),
     *                     @OA\Property(
     *                         property="createdTs",
     *                         description="Дата и время создания",
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
    $router->get('/list', "$controller@getListObjects");
    /**
     * @OA\Get(
     *     path="/objects/user",
     *     tags={"Микросервис Объекты"},
     *     summary="Список объектов пользователя",
     *     description="Маршрут для получения списка объектов пользователя",
     *     operationId="getUserObjects",
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
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
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
     *                         property="subtypeId",
     *                         description="Идентификатор подтипа",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="lat",
     *                         description="Широта",
     *                         type="number"
     *                     ),
     *
     *                     @OA\Property(
     *                         property="lng",
     *                         description="Долгота",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         description="Название",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Дополнительные данные о объекте в формате JSON",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="isPublic",
     *                         description="Признак публичности объекта",
     *                         type="boolean"
     *                     ),
     *                     @OA\Property(
     *                         property="createdTs",
     *                         description="Дата и время создания",
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
    $router->get('/user', "$controller@getUserObjects");

    /**
     * @OA\Get(
     *     path="/objects",
     *     tags={"Микросервис Объекты"},
     *     summary="Список публичных объектoв",
     *     description="Маршрут для получения списка публичных объектов, включая все объекты, созданные пользователем",
     *     operationId="getPublicObjects",
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
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
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
     *                         property="subtypeId",
     *                         description="Идентификатор подтипа",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя, создавшего объект",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="lat",
     *                         description="Широта",
     *                         type="number"
     *                     ),
     *
     *                     @OA\Property(
     *                         property="lng",
     *                         description="Долгота",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         description="Название",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Дополнительные данные о объекте в формате JSON",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="isPublic",
     *                         description="Признак публичности",
     *                         type="boolean"
     *                     ),
     *                     @OA\Property(
     *                         property="createdTs",
     *                         description="Дата и время создания",
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
    $router->get('/', "$controller@getPublicObjects");
    /**
     * @OA\Post(
     *     path="/objects",
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
     *                  ),
     *                  @OA\Property(
     *                      property="is_public",
     *                      description="Признак публичности объекта",
     *                      type="boolean"
     *                  )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Ошибка создания записи",
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
    $router->post('/', "$controller@setObject");
    /**
     * @OA\Put(
     *     path="/objects",
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
     *                  required={"id", "subtypeId", "lat", "lng", "name"},
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
     *                      property="is_public",
     *                      description="Признак публичности объекта",
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
     *         description="Ошибка создания записи",
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
    $router->put('/', "$controller@updateObject");
    /**
     * @OA\Delete(
     *     path="/objects",
     *     tags={"Микросервис Объекты"},
     *     summary="Удаление объектов",
     *     description="Маршрут для удаления объектов",
     *     operationId="deleteObjects",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Идентификатор объекта",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов объектов через запятую",
     *         required=false,
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
     *         description="Ошибка удаления записи",
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
    $router->delete('/', "$controller@deleteObjects");

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
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
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
     *                         property="objectId",
     *                         description="Идентификатор объекта",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="commentary",
     *                         description="Комментарий пользователя к объекту",
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
    $router->get('/comments', "$controller@getComments");
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
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
     *         description="Ошибка создания записи",
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
    $router->post('/comments', "$controller@setComment");
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
     *         description="Ошибка создания записи",
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
    $router->put('/comments', "$controller@updateComment");
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
     *         name="id",
     *         in="query",
     *         description="Идентификатор комментария",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов комментариев через запятую",
     *         required=false,
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
     *         description="Ошибка удаления записи",
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
    $router->delete('/comments', "$controller@deleteComments");

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
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
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
    $router->get('/audit', "$controller@getAudit");

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
     *                         property="name",
     *                         description="Название",
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
    $router->get('/file/types', "$controller@getFileTypes");
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
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
     *         description="Ошибка создания записи",
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
    $router->post('/file/types', "$controller@setFileType");
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
     *         description="Ошибка создания записи",
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
    $router->put('/file/types', "$controller@updateFileType");

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
     *         name="offset",
     *         in="query",
     *         description="Смещение",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *             format="int64"
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
     *                         property="fileTypeId",
     *                         description="Идентификатор типа файла",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="fileHash",
     *                         description="Hash файла для получения URL с микросервиса Медиа",
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
    $router->get('/file/attached', "$controller@getAttachedFiles");
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
     *                  required={"objectId"},
     *                  @OA\Property(
     *                      property="objectId",
     *                      description="Идентификатор объекта",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="file",
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
     *         description="Ошибка создания записи",
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
    $router->post('/file/attached', "$controller@setAttachedFile");
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
     *         name="id",
     *         in="query",
     *         description="Идентификатор файла",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов файлов через запятую",
     *         required=false,
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
     *         description="Ошибка удаления записи",
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
    $router->delete('/file/attached', "$controller@deleteAttachedFiles");
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
     *                  required={"id", "index"},
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
     *                      property="name",
     *                      description="Альтернативное название файла",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="parentId",
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
     *         description="Ошибка создания записи",
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
    $router->put('/file/attached', "$controller@updateAttachedFile");

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
     *                      property="file",
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
     *         description="Ошибка создания записи",
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
    $router->post('/file/attached/link', "$controller@linkFileToFile");
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
     *         description="Ошибка сохранения записи",
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
    $router->put('/file/attached/link', "$controller@unlinkFileFromFile");
});