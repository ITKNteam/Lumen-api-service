<?php
$router->group(['prefix' => '/routes'], function () use ($router) {
    $controller = 'RoutesController';

    /**
     * @OA\Get(
     *     path="/routes/headings",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список рубрик",
     *     description="Маршрут для получения списка рубрик",
     *     operationId="getHeadings",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
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
    $router->get('/headings', ['middleware' => 'auth', 'uses' => $controller . '@getHeadings']);
    /**
     * @OA\Post(
     *     path="/routes/headings",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание рубрики",
     *     description="Маршрут для создания рубрики",
     *     operationId="setHeading",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания рубрики",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название рубрики",
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
    $router->post('/headings', ['middleware' => 'auth', 'uses' => $controller . '@setHeading']);
    /**
     * @OA\Put(
     *     path="/routes/headings",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование рубрики",
     *     description="Маршрут для редактирования рубрики",
     *     operationId="updateHeading",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования рубрики",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор рубрики",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название рубрики",
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
    $router->put('/headings', ['middleware' => 'auth', 'uses' => $controller . '@updateHeading']);
    /**
     * @OA\Delete(
     *     path="/routes/headings",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление рубрик",
     *     description="Маршрут для удаления рубрик",
     *     operationId="deleteHeadings",
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
    $router->delete('/headings', ['middleware' => 'auth', 'uses' => $controller . '@deleteHeadings']);

    /**
     * @OA\Get(
     *     path="/routes/list/shop",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список маршрутов",
     *     description="Маршрут для получения списка маршрутов для магазина",
     *     operationId="getRoutesShop",
     *     security={{"bearerAuth":{}}},
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
     *         response=404,
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/list/shop', ['middleware' => 'auth', 'uses' => $controller . '@getRoutesShop']);
    /**
     * @OA\Get(
     *     path="/routes/list/user",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список маршрутов пользователя",
     *     description="Маршрут для получения списка маршрутов",
     *     operationId="getRoutesUser",
     *     security={{"bearerAuth":{}}},
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
     *         response=404,
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/list/user', ['middleware' => 'auth', 'uses' => $controller . '@getRoutesUser']);
    /**
     * @OA\Post(
     *     path="/routes",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание маршрута",
     *     description="Маршрут для создания маршрута. Может принимать любое количество дополнительных параметров, кроме указанных",
     *     operationId="setRoute",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания маршрута",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название маршрута",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="price",
     *                      description="Цена",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="statusId",
     *                      description="Идентификатор статуса",
     *                      default=1,
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="length",
     *                      description="Длина, обновляется автоматически при манипуляциях с точками маршрута",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="poster",
     *                      description="Картинка для маркетинга",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="Краткое описание маршрута",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="headings",
     *                      description="Список идентификаторов рубрик в виде массива [1,2,3]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                          format="int64"
     *                      )
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
    $router->post('/list', ['middleware' => 'auth', 'uses' => $controller . '@setRoute']);
    /**
     * @OA\Put(
     *     path="/routes/list",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование маршрута",
     *     description="Маршрут для редактирования маршрута",
     *     operationId="updateRoute",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования маршрута",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор маршрута",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название маршрута",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="price",
     *                      description="Цена",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="length",
     *                      description="Длина, обновляется автоматически при манипуляциях с точками маршрута",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="statusId",
     *                      description="Идентификатор статуса",
     *                      default=1,
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="isPublished",
     *                      description="Маршрут опубликован",
     *                      type="boolean"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="Краткое описание маршрута",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="headings",
     *                      description="Список рубрик в виде массива",
     *                      type="array",
     *                      @OA\Items(
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
     *         description="Ошибка создания записи"
     *     )
     * )
     */
    $router->put('/list', ['middleware' => 'auth', 'uses' => $controller . '@updateRoute']);
    /**
     * @OA\Delete(
     *     path="/routes/list",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление маршрутов",
     *     description="Маршрут для удаления маршрутов",
     *     operationId="deleteRoutes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов маршрутов через запятую",
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
    $router->delete('/list', ['middleware' => 'auth', 'uses' => $controller . '@deleteRoutes']);
    /**
     * @OA\Post(
     *     path="/routes/list/poster",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование постера маршрута",
     *     description="Маршрут для редактирования постера маршрута.",
     *     operationId="updatePosterRoute",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования постера маршрута",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"id", "poster"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор маршрута",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="poster",
     *                      description="Картинка для маркетинга",
     *                      type="string",
     *                      format="binary"
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
     *         response=404,
     *         description="Запись для редактирования не найдена"
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Ошибка редактирования записи"
     *     )
     * )
     */
    $router->post('/list/poster', ['middleware' => 'auth', 'uses' => $controller . '@updatePosterRoute']);

    /**
     * @OA\Post(
     *     path="/routes/purchase",
     *     tags={"Микросервис Маршруты"},
     *     summary="Покупка маршрута",
     *     description="Маршрут для покупки маршрута.",
     *     operationId="purchaseRoute",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма покупки маршрута",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"routeId", "cost"},
     *                  @OA\Property(
     *                      property="routeId",
     *                      description="Идентификатор маршрута",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="cost",
     *                      description="Стоимость маршрута",
     *                      type="integer",
     *                      format="int64"
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
    $router->post('/purchase', ['middleware' => 'auth', 'uses' => $controller . '@purchaseRoute']);
    /**
     * @OA\Delete(
     *     path="/routes/purchase",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление покупок",
     *     description="Маршрут для удаления покупок",
     *     operationId="deleteRoutes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов покупок через запятую",
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
    $router->delete('/purchase', ['middleware' => 'auth', 'uses' => $controller . '@deletePurchasesRoutes']);

    /**
     * @OA\Get(
     *     path="/routes/points",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список точек",
     *     description="Маршрут для получения списка точек",
     *     operationId="getPoints",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="routeId",
     *         in="query",
     *         description="Идентификатор маршрута",
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
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/points', ['middleware' => 'auth', 'uses' => $controller . '@getPoints']);
    /**
     * @OA\Post(
     *     path="/routes/points",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание точек",
     *     description="Маршрут для создания точек",
     *     operationId="setPoints",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания точек",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"routeId", "points"},
     *                  @OA\Property(
     *                      property="routeId",
     *                      description="Идентификатор маршрута",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="points",
     *                      description="Набор точек маршрута в формате JSON: [{'lat':12.12,'lng':12.12,'tail':[[1,1],[2,2],...]},...]",
     *                      type="object",
     *                      default="[{}]",
     *                      @OA\Schema(
     *                          @OA\Property(
     *                              property="lat",
     *                              description="Широта",
     *                              type="number"
     *                          ),
     *                          @OA\Property(
     *                              property="lng",
     *                              description="Долгота",
     *                              type="number"
     *                          ),
     *                          @OA\Property(
     *                              property="tail",
     *                              description="Отрезок трека, который принадлежит точке. в формате JSON",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="array",
     *                                  @OA\Items(
     *                                      type="number"
     *                                  )
     *                              )
     *                          )
     *                      )
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
    $router->post('/points', ['middleware' => 'auth', 'uses' => $controller . '@setPoints']);
    /**
     * @OA\Put(
     *     path="/routes/points",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование точки",
     *     description="Маршрут для редактирования точки",
     *     operationId="updatePoint",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования точки",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "lat", "lng"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор точки",
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
     *                      property="tail",
     *                      description="Отрезок трека, который принадлежит точке. в формате JSON",
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
    $router->put('/points', ['middleware' => 'auth', 'uses' => $controller . '@updatePoint']);
    /**
     * @OA\Delete(
     *     path="/routes/points",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление точек",
     *     description="Маршрут для удаления точек",
     *     operationId="deletePoints",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов точек через запятую",
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
    $router->delete('/points', ['middleware' => 'auth', 'uses' => $controller . '@deletePoints']);

    /**
     * @OA\Get(
     *     path="/routes/comments",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список комментариев к маршруту",
     *     description="Маршрут для получения списка комментариев к маршруту",
     *     operationId="getRouteComments",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="routeId",
     *         in="query",
     *         description="Идентификатор маршрута",
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
     *         description="Записи не найдены"
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
     *     path="/routes/comments",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание комментария к маршруту",
     *     description="Маршрут для создания комментария к маршруту",
     *     operationId="setRouteComment",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания комментария к маршруту",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"routeId"},
     *                  @OA\Property(
     *                      property="routeId",
     *                      description="Идентификатор маршрута",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="commentary",
     *                      description="Комментарий к маршруту",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="rating",
     *                      description="Рейтинг",
     *                      type="integer",
     *                      default=0,
     *                      minimum=0,
     *                      maximum=5,
     *                      format="int64"
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
     *     path="/routes/comments",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование комментария к маршруту",
     *     description="Маршрут для редактирования комментария к маршруту",
     *     operationId="updateRouteComment",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования комментария к маршруту",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор комментария к маршруту",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="commentary",
     *                      description="Комментарий к маршруту",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="rating",
     *                      description="Рейтинг",
     *                      type="integer",
     *                      default=0,
     *                      minimum=0,
     *                      maximum=5,
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
    $router->put('/comments', ['middleware' => 'auth', 'uses' => $controller . '@updateComment']);
    /**
     * @OA\Delete(
     *     path="/routes/comments",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление комментариев к маршруту",
     *     description="Маршрут для удаления комментариев к маршруту",
     *     operationId="deleteRouteComments",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов комментариев через запятую",
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
     *     path="/routes/comments/rating_reviews",
     *     tags={"Микросервис Маршруты"},
     *     summary="Статистика оценки и отзывы",
     *     description="Маршрут для получения списка статистики оценок и отзывов",
     *     operationId="getRouteCommentsRatingReviews",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="routeId",
     *         in="query",
     *         description="Идентификатор маршрута",
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
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/comments/rating_reviews', ['middleware' => 'auth', 'uses' => $controller . '@getRouteCommentsRatingReviews']);

    /**
     * @OA\Get(
     *     path="/routes/audit",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список действий пользователей",
     *     description="Маршрут для получения списка действий пользователей",
     *     operationId="getRoutesAudit",
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
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/audit', ['middleware' => 'auth', 'uses' => $controller . '@getAudit']);

    /**
     * @OA\Get(
     *     path="/routes/filters",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список фильтров",
     *     description="Маршрут для получения списка фильтров",
     *     operationId="getFilters",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
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
     *         description="Записи не найдены"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ошибка выборки данных"
     *     )
     * )
     */
    $router->get('/filters', ['middleware' => 'auth', 'uses' => $controller . '@getFilters']);
    /**
     * @OA\Post(
     *     path="/routes/filters",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание фильтра",
     *     description="Маршрут для создания фильтра",
     *     operationId="setFilter",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания фильтра",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"category", "name"},
     *                  @OA\Property(
     *                      property="category",
     *                      description="Название категории фильтра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название фильтра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="property",
     *                      description="Название параметра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="operator",
     *                      description="Оператор сравнения",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="value",
     *                      description="Значение для сравнения",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="function",
     *                      description="Название функции для специальной выборки",
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
    $router->post('/filters', ['middleware' => 'auth', 'uses' => $controller . '@setFilter']);
    /**
     * @OA\Put(
     *     path="/routes/filters",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование фильтра",
     *     description="Маршрут для редактирования фильтра",
     *     operationId="updateFilter",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования фильтра",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "category", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор фильтра",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="category",
     *                      description="Название категории фильтра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название фильтра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="property",
     *                      description="Название параметра",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="operator",
     *                      description="Оператор сравнения",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="value",
     *                      description="Значение для сравнения",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="function",
     *                      description="Название функции для специальной выборки",
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
    $router->put('/filters', ['middleware' => 'auth', 'uses' => $controller . '@updateFilter']);
    /**
     * @OA\Delete(
     *     path="/routes/filters",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление фильтров",
     *     description="Маршрут для удаления фильтров",
     *     operationId="deleteFilters",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов комментариев через запятую",
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
    $router->delete('/filters', ['middleware' => 'auth', 'uses' => $controller . '@deleteFilters']);

    /**
     * @OA\Get(
     *     path="/routes/statuses",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список статусов",
     *     description="Маршрут для получения списка статусов",
     *     operationId="getStatuses",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех"
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
    $router->get('/statuses', ['middleware' => 'auth', 'uses' => $controller . '@getStatuses']);
    /**
     * @OA\Post(
     *     path="/routes/statuses",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание статуса",
     *     description="Маршрут для создания статуса",
     *     operationId="setStatus",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания статуса",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название статуса",
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
    $router->post('/statuses', ['middleware' => 'auth', 'uses' => $controller . '@setStatus']);
    /**
     * @OA\Put(
     *     path="/routes/statuses",
     *     tags={"Микросервис Маршруты"},
     *     summary="Редактирование статуса",
     *     description="Маршрут для редактирования статуса",
     *     operationId="updateStatus",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования статуса",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор статуса",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Название статуса",
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
    $router->put('/statuses', ['middleware' => 'auth', 'uses' => $controller . '@updateStatus']);
    /**
     * @OA\Delete(
     *     path="/routes/statuses",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление статусов",
     *     description="Маршрут для удаления статусов",
     *     operationId="deleteStatuses",
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
    $router->delete('/statuses', ['middleware' => 'auth', 'uses' => $controller . '@deleteStatuses']);
});