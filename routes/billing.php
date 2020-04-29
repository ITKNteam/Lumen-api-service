<?php
$router->group(['prefix' => '/billing'], function () use ($router) {
    $controller = "BillingController";

    /**
     * @OA\Post(path="/billing/creditCard",
     *   tags={"billing"},
     *   summary="Добавление кредитной карты",
     *   description="Добавление кредитной карты",
     *   operationId="addCreditCard",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Make a pay",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"cardNumber", "cvv2", "expiryDate"},
     *                  @OA\Property(
     *                      property="cardNumber",
     *                      description="cardNumber",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="cvv2",
     *                      description="cvv2",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="expiryDate",
     *                      description="expiryDate",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/creditCard', ['middleware' => 'auth', 'uses' => $controller . '@addCreditCard']);
    /**
     * @OA\Get(path="/billing/creditCard",
     *   tags={"billing"},
     *   summary="Get users active credit card",
     *   security={{"bearerAuth":{}}},
     *   description="Возвращеат маскированую активную кредитную карту пользователя",
     *   operationId="getCreditCard",
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="card not found")
     * )
     */
    $router->get('/creditCard', ['middleware' => 'auth', 'uses' => $controller . '@getCreditCard']);
    /**
     * @OA\DELETE(path="/billing/creditCard",
     *   tags={"billing"},
     *   summary="Delete credit card by id",
     *   security={{"bearerAuth":{}}},
     *   description="Удаляет кредитную карту по id",
     *   operationId="deleteCreditCard",
     *    @OA\Parameter(
     *         name="cardId",
     *         in="query",
     *         description="Идентификатор файла",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *    ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="card not found")
     * )
     */
    $router->delete('/creditCard', ['middleware' => 'auth', 'uses' => $controller . '@deleteCreditCard']);
    /**
     * @OA\PATCH(path="/billing/creditCard",
     *   tags={"billing"},
     *   summary="Set credit card by current",
     *   security={{"bearerAuth":{}}},
     *   description="Устанавливает карту по умолчанию",
     *   operationId="deleteCreditCard",
     *   @OA\Parameter(
     *         name="cardId",
     *         in="query",
     *         description="Идентификатор файла",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *    ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="card not found")
     * )
     */
    $router->patch('/creditCard', ['middleware' => 'auth', 'uses' => $controller . '@patchCreditCard']);

    /**
     * @OA\Post(path="/billing/addPay",
     *   tags={"billing"},
     *   summary="Проведение платежа",
     *   description="Проведение платежа",
     *   operationId="addPay",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Make a pay",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"ammount", "orderId"},
     *                  @OA\Property(
     *                      property="ammount",
     *                      description="ammount",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="orderId",
     *                      description="orderId",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/pay', ['middleware' => 'auth', "uses" => $controller . '@addPay']);

    /**
     * @OA\Post(path="/billing/tariff",
     *   tags={"billing"},
     *   summary="Добавление нового тарифа",
     *   description="Добавление нового тарифа",
     *   operationId="tariff",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Добавление нового тарифа",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"name", "cost"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="name",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="cost",
     *                      description="cost",
     *                      @OA\Schema(
     *                          type="float"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="bookingTime",
     *                      description="bookingTime",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="parkingCost",
     *                      description="parkingCost",
     *                      @OA\Schema(
     *                          type="float"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="usingCost",
     *                      description="usingCost",
     *                      @OA\Schema(
     *                          type="float"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="depositAmmount",
     *                      description="depositAmmount",
     *                      @OA\Schema(
     *                          type="float"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="prepaidMinutes",
     *                      description="prepaidMinutes",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="isDeposidReturned",
     *                      description="isDeposidReturned",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="includedMinutes",
     *                      description="includedMinutes",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="tariffInterval",
     *                      description="tariffInterval",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="dtEnd",
     *                      description="dtEnd",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="sessionDelayMinutes",
     *                      description="sessionDelayMinutes",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="countFreeSessions",
     *                      description="countFreeSessions",
     *                      @OA\Schema(
     *                          type="int"
     *                      )
     *                  ),
     *
     *          )
     *       )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/tariff', ['middleware' => 'auth', "uses" => $controller . '@createTariff']);
    $router->get('/tariffs', ['middleware' => 'auth', "uses" => $controller . '@getTariff']);
    /**
     * @OA\Post(path="/tariff/bindUser",
     *   tags={"billing"},
     *   summary="Смена тарифа юзеру",
     *   description="Смена тарифа юзеру",
     *   operationId="bindUserTariff",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"user id", "user_id"},
     *                  @OA\Property(
     *                      property="user_id",
     *                      description="user_id",
     *                      @OA\Schema(
     *                          type="number"
     *                      )
     *                  ),
     *                  required={"tariff id", "tariff_id"},
     *                  @OA\Property(
     *                      property="tariff_id",
     *                      description="tariff_id",
     *                      @OA\Schema(
     *                          type="number"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/tariff/bindUser', ['middleware' => 'auth', "uses" => $controller . '@bindTariffBindUser']);
    $router->get('/tariff/user', ['middleware' => 'auth', "uses" => $controller . '@getCurrentTariff']);

    /**
     * @OA\GET(path="/writeOffs",
     *   tags={"billing"},
     *   summary="Получение всех списаний",
     *   description="Получение всех списаний",
     *   operationId="getAllWriteOffs",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/writeOffs', ['middleware' => 'auth', "uses" => $controller . '@getAllWriteOffs']);
    /**
     * @OA\Post(path="/writeOffs",
     *   tags={"billing"},
     *   summary="Завершение аренды",
     *   description="Завершение аренды",
     *   operationId="payRent",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"user id", "user_id"},
     *                  @OA\Property(
     *                      property="user_id",
     *                      description="user_id",
     *                      @OA\Schema(
     *                          type="number"
     *                      )
     *                  ),
     *                  required={"history_json", "history_json"},
     *                  @OA\Property(
     *                      property="history_json",
     *                      description="history_json",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/writeOffs/user', ['middleware' => 'auth', "uses" => $controller . '@getCurrentWriteOffs']);
    /**
     * @OA\GET(path="/tariff/user",
     *   tags={"billing"},
     *   summary="Получение тарифа авторизованного юзера",
     *   description="Получение тарифа авторизованного юзера",
     *   operationId="getCurrentTariff",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/writeOffs', ['middleware' => 'auth', "uses" => $controller . '@payRent']);
});