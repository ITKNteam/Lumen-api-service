<?php
$router->group(['prefix' => '/routes'], function () use ($router) {
    $controller = "RoutesController";

    /**
     * @OA\Get(
     *     path="/routes/welcome",
     *     tags={"Микросервис Маршруты"},
     *     summary="Базовый маршрут",
     *     description="Заглушка для базового маршрута, ничего не выполняет, а просто возвращает приветствие",
     *     operationId="index",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 description="Текст приветствия",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     */
    $router->get('/welcome', "$controller@index");
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
    $router->get('/headings', ['middleware' => 'auth', "uses" => "$controller@getHeadings"]);
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
    $router->post('/headings', ['middleware' => 'auth', "uses" => "$controller@setHeading"]);
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
    $router->put('/headings', ['middleware' => 'auth', "uses" => "$controller@updateHeading"]);

    /**
     * @OA\Get(
     *     path="/routes",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список маршрутов",
     *     description="Маршрут для получения списка маршрутов",
     *     operationId="getRoutes",
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
     *                         property="price",
     *                         description="Цена",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="rating",
     *                         description="Рейтинг",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя, создавшего маршрут",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Дополнительные данные о маршруте в формате JSON",
     *                         type="string"
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
    $router->get('/', ['middleware' => 'auth', "uses" => "$controller@getRoutes"]);
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
     *      @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="exception",
     *                 description="Сообщения об ошибках процесса сохранения маршрута",
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
    $router->post('/', ['middleware' => 'auth', "uses" => "$controller@setRoute"]);
    /**
     * @OA\Put(
     *     path="/routes",
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
     *                  required={"id", "name"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор объекта",
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
    $router->put('/', ['middleware' => 'auth', "uses" => "$controller@updateRoute"]);
    /**
     * @OA\Delete(
     *     path="/routes",
     *     tags={"Микросервис Маршруты"},
     *     summary="Удаление маршрутов",
     *     description="Маршрут для удаления маршрутов",
     *     operationId="deleteRoutes",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Идентификатор маршрута",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов маршрутов через запятую",
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
    $router->delete('/', ['middleware' => 'auth', "uses" => "$controller@deleteRoutes"]);

    /**
     * @OA\Get(
     *     path="/routes/user",
     *     tags={"Микросервис Маршруты"},
     *     summary="Список маршрутов пользователя",
     *     description="Маршрут для получения списка маршрутов",
     *     operationId="getUserRoutes",
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
     *                         property="name",
     *                         description="Название",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         description="Цена",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="rating",
     *                         description="Рейтинг",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя, создавшего маршрут",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="paidId",
     *                         description="Идентификатор привязки (покупки)",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Дополнительные данные о маршруте в формате JSON",
     *                         type="string"
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
    $router->get('/user', ['middleware' => 'auth', "uses" => "$controller@getUserRoutes"]);
    /**
     * @OA\Post(
     *     path="/routes/poster",
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
     *                  required={"id"},
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="exception",
     *                 description="Сообщения об ошибках процесса сохранения постера маршрута",
     *                 type="integer"
     *             )
     *         )
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
     *         description="Ошибка редактирования записи",
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
    $router->post('/poster', ['middleware' => 'auth', "uses" => "$controller@updatePosterRoute"]);

    /**
     * @OA\Post(
     *     path="/routes/paid",
     *     tags={"Микросервис Маршруты"},
     *     summary="Покупка маршрута",
     *     description="Маршрут для покупки маршрута.",
     *     operationId="paidRoute",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма покупки маршрута",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"routeId"},
     *                  @OA\Property(
     *                      property="routeId",
     *                      description="Идентификатор маршрута",
     *                      type="integer",
     *                      format="int64"
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
     *             ),
     *             @OA\Property(
     *                 property="exception",
     *                 description="Сообщения об ошибках процесса покупки маршрута",
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
    $router->post('/paid', ['middleware' => 'auth', "uses" => "$controller@paidRoute"]);

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
     *                         property="routeId",
     *                         description="Идентификатор маршрута",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="objectId",
     *                         description="Идентификатор приявязанного объекта",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="lat",
     *                         description="Широта",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="lng",
     *                         description="Долгота",
     *                         type="number"
     *                     ),
     *                     @OA\Property(
     *                         property="createdTs",
     *                         description="Дата и время создания",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="tail",
     *                         description="Отрезок трека, который принадлежит точке. в формате JSON",
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

    $router->get('/points', ['middleware' => 'auth', "uses" => "$controller@getPoints"]);
    /**
     * @OA\Post(
     *     path="/routes/points",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание точки",
     *     description="Маршрут для создания точки",
     *     operationId="setPoint",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания точки",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"routeId", "lat", "lng", "placeName"},
     *                  @OA\Property(
     *                      property="routeId",
     *                      description="Идентификатор маршрута",
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
     *                      property="placeName",
     *                      description="Название места, используется только для контрольных точек. Объязательное поле к заполнению для контрольной точки",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="tail",
     *                      description="Отрезок трека, который принадлежит точке. в формате JSON",
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
     *             ),
     *             @OA\Property(
     *                 property="objectData",
     *                 description="Идентификатор привязанного объекта. Только для контрольных точек",
     *                 type="object"
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
    $router->post('/points', ['middleware' => 'auth', "uses" => "$controller@setPoint"]);
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
    $router->put('/points', ['middleware' => 'auth', "uses" => "$controller@updatePoint"]);
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
     *         name="id",
     *         in="query",
     *         description="Идентификатор точки",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов точек через запятую",
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
    $router->delete('/points', ['middleware' => 'auth', "uses" => "$controller@deletePoints"]);

    /**
     * @OA\Post(
     *     path="/routes/points/arr",
     *     tags={"Микросервис Маршруты"},
     *     summary="Создание точек",
     *     description="Маршрут для создания точек",
     *     operationId="setPointArr",
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
     *                      description="Набор точек маршрута в формате JSON: [{'lat':12.12,'lng':12.12,'placeName':'name','tail':[[1,1],[2,2],...]},...]",
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
     *                              property="placeName",
     *                              description="Название места, используется только для контрольных точек. Объязательное поле к заполнению для контрольной точки",
     *                              type="string"
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
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 description="Идентификатор созданной записи",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="objectData",
     *                 description="Идентификатор привязанного объекта. Только для контрольных точек",
     *                 type="object"
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
    $router->post('/points/arr', ['middleware' => 'auth', "uses" => "$controller@setPointArr"]);

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
     *                         property="routeId",
     *                         description="Идентификатор маршрута",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="userId",
     *                         description="Идентификатор пользователя",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="rating",
     *                         description="Рейтинг",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="commentary",
     *                         description="Комментарий пользователя к маршруту",
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
    $router->get('/comments', ['middleware' => 'auth', "uses" => "$controller@getComments"]);
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
     *                  required={"routeId", "commentary"},
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
    $router->post('/comments', ['middleware' => 'auth', "uses" => "$controller@setComment"]);
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
     *                  required={"id", "commentary"},
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
    $router->put('/comments', ['middleware' => 'auth', "uses" => "$controller@updateComment"]);
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
    $router->delete('/comments', ['middleware' => 'auth', "uses" => "$controller@deleteComments"]);

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
     *     @OA\Parameter(
     *         name="filters",
     *         in="query",
     *         description="Описание фильтра в виде JSON",
     *         example="[{'property':'userId','value':1},{'property':'id','value':2}]",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
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
    $router->get('/audit', ['middleware' => 'auth', "uses" => "$controller@getAudit"]);
});