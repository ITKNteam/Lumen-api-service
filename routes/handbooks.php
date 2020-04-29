<?php
$router->group(['prefix' => '/handbooks'], function () use ($router) {
    $controller = "HandbooksController";

    /**
     * @OA\Get(
     *     path="/handbooks",
     *     tags={"Справочники"},
     *     summary="Список справочников",
     *     description="Маршрут для получения списка справочников",
     *     operationId="getHandbooks",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="filters",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property'='name','value'='demo'}]",
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
     *                         property="name",
     *                         description="Название",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="parentId",
     *                         description="Идентификатор родителя",
     *                         default=0,
     *                         type="integer"
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
    $router->get('/', $controller . 'getHandbooks');
    /**
     * @OA\Post(
     *     path="/handbooks",
     *     tags={"Справочники"},
     *     summary="Создание справочника",
     *     description="Маршрут для создания справочника",
     *     operationId="setHandbook",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания справочника",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"userId", "name"},
     *                  @OA\Property(
     *                      property="userId",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название справочника",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="parentId",
     *                      description="Идентификатор родителя",
     *                      default=0,
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
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
    $router->post('/', $controller . 'setHandbook');
    /**
     * @OA\Put(
     *     path="/handbooks",
     *     tags={"Справочники"},
     *     summary="Редактирование справочника",
     *     description="Маршрут для редактирования справочника",
     *     operationId="updateHandbook",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования справочника",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "userId", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор справочника",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="userId",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название справочника",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="parentId",
     *                      description="Идентификатор родителя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
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
    $router->put('/', $controller . 'updateHandbook');

    /**
     * @OA\Get(
     *     path="/handbooks/value",
     *     tags={"Справочники"},
     *     summary="Список значений справочника",
     *     description="Маршрут для получения списка значений справочника",
     *     operationId="getHandbookData",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="filters",
     *         in="query",
     *         description="Фильтрация по условию",
     *         required=false,
     *         example="[{'property'='name','value'='demo'}]",
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
     *                         property="handbookId",
     *                         description="Идентификатор справочника",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="parentId",
     *                         description="Идентификатор родителя",
     *                         default=0,
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         description="Значение",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="isoCode",
     *                         description="ISO код значения",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="symbol",
     *                         description="Знак визуализации",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Описание",
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
    $router->get('/value', $controller . 'getHandbookData');
    /**
     * @OA\Post(
     *     path="/handbooks/value",
     *     tags={"Справочники"},
     *     summary="Создание значения справочника",
     *     description="Маршрут для создания значений справочника",
     *     operationId="setHandbookData",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания значения",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"userId", "handbookId", "value"},
     *                  @OA\Property(
     *                      property="userId",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="handbookId",
     *                      description="Идентификатор справочника",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="parentId",
     *                      description="Идентификатор родителя",
     *                      default=0,
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ), @OA\Property(
     *                      property="value",
     *                      description="Значение справочника",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="isoCode",
     *                      description="ISO код значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="symbol",
     *                      description="Символ для визуализации значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="description",
     *                      description="Описание значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
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
    $router->post('/value', $controller . 'setHandbookData');
    /**
     * @OA\Put(
     *     path="/handbooks/value",
     *     tags={"Справочники"},
     *     summary="Редактирование значения справочника",
     *     description="Маршрут для редактирования значения справочника",
     *     operationId="updateHandbookData",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования значения",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "userId", "handbookId", "value"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор справочника",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="userId",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="handbookId",
     *                      description="Идентификатор справочника",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="parentId",
     *                      description="Идентификатор родителя",
     *                      default=0,
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ), @OA\Property(
     *                      property="value",
     *                      description="Значение справочника",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="isoCode",
     *                      description="ISO код значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="symbol",
     *                      description="Символ для визуализации значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ), @OA\Property(
     *                      property="description",
     *                      description="Описание значения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
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
    $router->put('/value', $controller . 'updateHandbookData');
    /**
     * @OA\GET(path="/m/list",
     *   tags={"Справочники"},
     *   summary="List handbooks",
     *   description="This can only be done by the logged in user.",
     *   operationId="dumpHandbooks",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="get handbook list",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *                  @OA\Property(
     *                      description="field",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     * )
     */
    $router->get('/m/list', $controller . 'dumpHandbooks');
});