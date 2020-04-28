<?php
$router->group(['prefix' => '/claim/m'], function () use ($router) {
    $controller = "ClaimController";

    /**
     * @OA\Post(
     *     path="/claim/m/create",
     *     tags={"Заявки и обращения"},
     *     summary="Создание обращения",
     *     description="Маршрут для создания заявки",
     *     operationId="createClaim",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Cоздание заявки",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"typeId"},
     *                  @OA\Property(
     *                      property="typeId",
     *                      description="Тип обращения",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="Текст обращения",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="vehicleId",
     *                      description="Id техники",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="photos",
     *                      description="Массив фото base64 в виде json",
     *                      type="string",
     *                      example="[{'0':'base64hash1','1':'base64hash2'}]",
     *                  ),
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
    $router->post('/create', ['middleware' => 'auth', "uses" => $controller . 'createClaim']);
    /**
     * @OA\Get(
     *     path="/claim/m/list",
     *     tags={"Заявки и обращения"},
     *     summary="Список заявок",
     *     description="Маршрут для получения списка заявок",
     *     operationId="getClaims",
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
     *                         property="userId",
     *                         description="Идентификатор пользователя",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="vehicleId",
     *                         description="Идентификатор велосипеда/самоката",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="typeId",
     *                         description="Идентификатор  типа обращения",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         description="Текст обращения",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="photos",
     *                         description="ссылки на фотографии обращения",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="statusId",
     *                         description="Идентификатор статуса обращения",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="createTs",
     *                         description="Дата и время создания",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="updateTs",
     *                         description="Дата и время обновления статуса",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="updateUid",
     *                         description="Идентификатор пользователя, обновившего обращение",
     *                         type="integer"
     *                     ),
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
    $router->get('/list', ['middleware' => 'auth', "uses" => $controller . 'listClaim']);
    /**
     * @OA\Put(
     *     path="/claim/m/update",
     *     tags={"Заявки и обращения"},
     *     summary="Редактирование статуса обращения",
     *     description="Маршрут для редактирования статуса обращения",
     *     operationId="updateClaimStatus",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования статуса обращения",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"claimId", "statusId"},
     *                  @OA\Property(
     *                      property="claimId",
     *                      description="Идентификатор рубрики",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="statusId",
     *                      description="Идентификатор статуса",
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
    $router->put('/update', ['middleware' => 'auth', "uses" => $controller . 'updateClaim']);

    /***
     * COMMENTS
     */

    /**
     * @OA\Post(
     *     path="/claim/m/comment",
     *     tags={"Заявки и обращения"},
     *     summary="Создание комментария",
     *     description="Маршрут для создания комментария",
     *     operationId="createClaimComment",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Cоздание комментария",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"claimId"},
     *                  @OA\Property(
     *                      property="claimId",
     *                      description="Id заявки",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="txt",
     *                      description="Текст комментария",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="photos",
     *                      description="Массив фото base64 в виде json",
     *                      type="string",
     *                      example="[{'0':'base64hash1','1':'base64hash2'}]",
     *                  ),
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
    $router->post('/comment', ['middleware' => 'auth', "uses" => $controller . 'createClaimComment']);
    /**
     * @OA\Get(
     *     path="/claim/m/comments",
     *     tags={"Заявки и обращения"},
     *     summary="Список коментарий заявок",
     *     description="Маршрут для получения списка коментарий заявок",
     *     operationId="getClaimsComments",
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
     *         name="claimId",
     *         in="query",
     *         description="Идентификатор заявки",
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
     *                         property="usersClaimsId",
     *                         description="Идентификатор заявки",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="txt",
     *                         description="Текст комментария",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="photos",
     *                         description="ссылки на фотографии обращения",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="createTs",
     *                         description="Дата и время создания",
     *                         type="integer"
     *                     ),
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
    $router->get('/comments', ['middleware' => 'auth', "uses" => $controller . 'listClaimComments']);
});