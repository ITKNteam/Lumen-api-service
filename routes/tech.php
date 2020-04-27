<?php
$router->group(['prefix' => '/tech'], function () use ($router) {
    $controller = "TechController";

    /**
     * @OA\Put(path="/tech/putPhoneCoordinates",
     *   tags={"tech"},
     *   summary="Put current phone coordinates",
     *   description="This can only be done by the logged in user.",
     *   operationId="putPhoneCoordinates",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Put current phone coordinates",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *                  required={"lat", "lon", "battery"},
     *                  @OA\Property(
     *                      property="lat",
     *                      description="latitude",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="lon",
     *                      description="longitude",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="battery",
     *                      description="battery status",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->put('/putPhoneCoordinates', "$controller@putCoordinates");

    /**
     * @OA\Post(path="/tech/unlock",
     *   tags={"tech"},
     *   summary="Use qrCode param if START SESSION, if session already started use id param. Если сессия была уже начата ",
     *   description="This can only be done by the logged in user.",
     *   operationId="unlock",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="unlock",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          ),
     *           @OA\Schema(
     *                  required={"qrCode"},
     *                  @OA\Property(
     *                      property="qrCode",
     *                      description="qrCode",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          ),
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/unlock',"$controller@unlock");

    /**
     * @OA\Post(path="/tech/booking",
     *   tags={"tech"},
     *   summary="Booked tech for current user",
     *   description="This can only be done by the logged in user.",
     *   operationId="booking",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="End of rent session",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/booking',"$controller@booking");

    /**
     * @OA\Post(path="/tech/parking",
     *   tags={"tech"},
     *   summary="parking tech for current user",
     *   description="This can only be done by the logged in user.",
     *   operationId="parking",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="parking",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/parking',"$controller@parking");

    /**
     * @OA\Post(path="/tech/rentEnd",
     *   tags={"tech"},
     *   summary="End of rent session (Ensure that lock alredy is locked)",
     *   description="This can only be done by the logged in user.",
     *   operationId="rentEnd",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="End of rent session",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/rentEnd',"$controller@rentEnd");

    /**
     * @OA\Post(path="/tech/ring",
     *   tags={"tech"},
     *   summary="ring lock bell",
     *   description="This can only be done by the logged in user.",
     *   operationId="ring",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Ring lock bell",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/ring',"$controller@ring");

    /**
     * @OA\Get(path="/tech/vehicleInfo",
     *   tags={"tech"},
     *   summary="vehicle description",
     *   description="This can only be done by the logged in user.",
     *   operationId="vehicleInfo",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/vehicleInfo',"$controller@vehicleInfo");

    /**
     * @OA\Get(path="/tech/userTechInfo",
     *   tags={"tech"},
     *   summary="users vehicles description",
     *   description="This can only be done by the logged in user.",
     *   operationId="userTechInfo",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/userTechInfo',"$controller@userTechInfo");

    /**
     * @OA\Get(path="/tech/vehicleStatus",
     *   tags={"tech"},
     *   summary="List of coordinates by current user",
     *   description="Возвращает список статусов по всем велосипедам",
     *   operationId="vehicleStatus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="types",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="status",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="phone not found")
     * )
     */
    $router->get('/vehicleStatus', "$controller@vehicleStatus");

    /**
     * @OA\Get(path="/tech/m/availableTransport",
     *   tags={"mobile"},
     *   summary="List of coordinates by current user",
     *   description="Возвращает список велосипедов в радиусе относительно текущей координаты",
     *   operationId="availableTransport",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="lat",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="lng",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="radius",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="phone not found")
     * )
     */
    $router->get('/m/availableTransport', "$controller@availableTransport");

    /**
     * @OA\Post(path="/tech/m/unlock",
     *   tags={"mobile"},
     *   summary="Use id session already started use id param. Если сессия была уже начата ",
     *   description="This can only be done by the logged in user.",
     *   operationId="unlock",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="unlock",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="qrCode",
     *                      description="qrCode",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          ),
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/unlock',"$controller@unlockMobile");

    /**
     * @OA\Post(path="/tech/m/rentStart",
     *   tags={"mobile"},
     *   summary="Use qrCode param  START SESSION w.o. booking",
     *   description="This can only be done by the logged in user.",
     *   operationId="rentStart",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="unlock",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"qrCode"},
     *                  @OA\Property(
     *                      property="qrCode",
     *                      description="qrCode",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          ),
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/rentStart',"$controller@rentStartMobile");

    /**
     * @OA\Post(path="/tech/m/checkByQrCode",
     *   tags={"mobile"},
     *   summary="Use qrCode to check vechicle exist",
     *   description="This can only be done by the logged in user.",
     *   operationId="checkByQrCode",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="checkByQrCode",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"qrCode"},
     *                  @OA\Property(
     *                      property="qrCode",
     *                      description="qrCode",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          ),
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/checkByQrCode',"$controller@checkByQrCode");

    /**
     * @OA\Post(path="/tech/m/booking",
     *   tags={"mobile"},
     *   summary="Booked tech for current user Mobile Application",
     *   description="This can only be done by the logged in user.",
     *   operationId="mobile-booking",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="begin of rent session",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/booking',"$controller@booking");

    /**
     * @OA\Post(path="/tech/m/parking",
     *   tags={"mobile"},
     *   summary="parking tech for current user Mobile Application",
     *   description="This can only be done by the logged in user.",
     *   operationId="mobile-parking",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="parking",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/parking',"$controller@parking");

    /**
     * @OA\Post(path="/tech/m/rentEnd",
     *   tags={"mobile"},
     *   summary="End of rent session (Ensure that lock alredy is locked)",
     *   description="This can only be done by the logged in user  Mobile Application.",
     *   operationId="mobile-rentEnd",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="End of rent session",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *              )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/rentEnd',"$controller@rentEnd");

    /**
     * @OA\Post(path="/tech/m/ring",
     *   tags={"mobile"},
     *   summary="ring lock bell",
     *   description="This can only be done by the logged in user.",
     *   operationId="mobile-ring",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Ring lock bell",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/m/ring',"$controller@ring");

    /**
     * @OA\GET(path="/m/ridesShort",
     *   tags={"mobile"},
     *   summary="List rides short view",
     *   description="This can only be done by the logged in user.",
     *   operationId="getRidesShort",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="get ride list",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *                  @OA\Property(
     *                      description="sort",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/m/ridesShort', "$controller@getRidesShort");

    /***************************************************************/
    //ГЕОЗОНЫ GEOZONES
    /***************************************************************/

    /**
     * @OA\Delete(path="/tech/geozone",
     *   tags={"tech"},
     *   summary="Delete geozone by id",
     *   description="This can only be done by the logged in user.",
     *   operationId="deleteGeozone",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Delete geozone",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *                  required={"id"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *          )
     *       )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->delete('/geozone', "$controller@deleteGeozone");

    /**
     * @OA\GET(path="/tech/geozones",
     *   tags={"tech"},
     *   summary="List geozons",
     *   description="This can only be done by the logged in user.",
     *   operationId="getGeozone",
     *   security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cityIds",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="statusIds",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="typeIds",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/geozones', "$controller@getGeozone");

    /**
     * @OA\Post(path="/tech/geozone",
     *   tags={"tech"},
     *   summary="Add geozone",
     *   description="This can only be done by the logged in user.",
     *   operationId="addGeozone",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Add geozone",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"name", "cityId", "partnerId", "geoJson", "statusId", "typeId"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="id",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="cityId",
     *                      description="cityId",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="partnerId",
     *                      description="partnerId",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="geoJson",
     *                      description="geoJson",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="statusId",
     *                      description="statusId",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="typeId",
     *                      description="typeId",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *          )
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/geozone',"$controller@addGeozone");

    /**
     * @OA\Get(path="/tech/m/geozones",
     *   tags={"mobile"},
     *   summary="List of geozones",
     *   description="Возвращает список геозон",
     *   operationId="geozones",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="lat",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="lng",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="phone not found")
     * )
     */
    $router->get('/m/geozones', "$controller@geozonesMobile");

    /**
     * @OA\Get(path="/tech/m/checkGeozoneType",
     *   tags={"mobile"},
     *   summary="List of geozones by  types",
     *   description="Возвращает список геозон их типы, в которые попал данный пользователь",
     *   operationId="checkGeozoneType",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="lat",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="lng",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="phone not found")
     * )
     */
    $router->get('/m/checkGeozoneType', "$controller@checkGeozoneType");

    /***************************************************************/
    //КОНЕЦ ГЕОЗОНЫ  END GEOZONES
    /***************************************************************/


    /**
     * @OA\Get(path="/tech/m/onlineSessionCost",
     *   tags={"mobile"},
     *   summary="return current session cost",
     *   description="Возвращает стоимость текущей сеесии",
     *   operationId="onlineSessionCost",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="sessionId",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid code"),
     *   @OA\Response(response=404, description="phone not found")
     * )
     */
    $router->get('/m/onlineSessionCost', "$controller@onlineSessionCost");

    $router->get('/insurance-company', "$controller@insuranceCompany");
});
