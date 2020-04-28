<?php
$router->group(['prefix' => '/user'], function () use ($router) {
    $controller = "UserController";

    /**
     * @OA\Post(path="/user/login",
     *   tags={"user"},
     *   summary="Login user",
     *   description="This can only logged in user.",
     *   operationId="loginUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="user login object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/UserLogin')
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/login', $controller . '@login');
    /**
     * @OA\Post(path="/user/create",
     *   tags={"user"},
     *   summary="Create user",
     *   description="",
     *   operationId="createUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Created user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"login"},
     *                  @OA\Property(
     *                      property="login",
     *                      description="login пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phoneCountryCode",
     *                      description="Код страны по умолчанию 7",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/create', $controller . '@registration');
    /**
     * @OA\Get(path="/user/profile",
     *   tags={"user"},
     *   summary="Get user by user id",
     *   description="",
     *   operationId="getUserById",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="successful operation", @OA\Schema(ref="#/components/schemas/User')),
     *   @OA\Response(response=400, description="Invalid usern id supplied'),
     *   @OA\Response(response=404, description="User not found')
     * )
     */
    $router->get('/profile', ['middleware' => 'auth', "uses" => $controller . '@getUser']);
    //$router->get('/profile', $controller . '@getUser');
    /**
     * @OA\Put(path="/user/profile",
     *   tags={"user"},
     *   summary="Updated user",
     *   description="This can only be done by the logged in user.",
     *   operationId="updateUser",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated user object",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Имя пользователя",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="lastName",
     *                      description="Фамилия пользователя",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="patronymic",
     *                      description="Отчество пользователя",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="gender",
     *                      description="Пол true = М false = Ж",
     *                      @OA\Schema(
     *                          type="boolean",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="birthDate",
     *                      description="Дата рождения пользователя в формате 2019-08-29 14:39:33",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="countryId",
     *                      description="Страна пользователя",
     *                      @OA\Schema(
     *                          type="countryId",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="regionId",
     *                      description="Регион пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="cityId",
     *                      description="Город пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="timezone",
     *                      description="Часовой пояс пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="currencyId",
     *                      description="Валюта пользователя",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="languageId",
     *                      description="Язык приложения",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     * )
     */
    $router->put('/profile', ['middleware' => 'auth', "uses" => $controller . '@updateUser']);
    /**
     * @OA\Get(path="/user/list",
     *   tags={"user"},
     *   summary="Get users list",
     *   description="",
     *   operationId="getUsers",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="successful operation", @OA\Schema(ref="#/components/schemas/User')),
     *   @OA\Response(response=400, description="Invalid usern id supplied'),
     *   @OA\Response(response=404, description="User not found')
     * )
     */
    $router->get('/list', ['middleware' => 'auth', "uses" => $controller . '@getUsers']);
    /**
     * @OA\Post(path="/user/resetPassword/{phone}",
     *   tags={"user"},
     *   summary="reset user password by ",
     *   description="",
     *   operationId="resetPassword",
     *   @OA\Parameter(
     *     name="phone",
     *     in="path",
     *     description="Phone ",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/User')
     *       )
     *   ),
     * )
     */
    $router->post('/resetPassword', ['middleware' => 'auth', "uses" => $controller . '@resetPassword']);
    /**
     * @OA\Post(path="/user/setPasswordApplyByPhone",
     *   tags={"user"},
     *   summary="установка первого пароля",
     *   description="установка первого пароля",
     *   operationId="setPasswordApplyByPhone",
     *   @OA\Response(response=200, description="User logged in'),
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone", "password", "rePassword", "code"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="phone number without country code",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="rePassword",
     *                      description="повтор пароля",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="code",
     *                      description="secret code from sms",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     * )
     */
    $router->post('/setPasswordApplyByPhone', ['middleware' => 'auth', "uses" => $controller . '@setPasswordApplyByPhone']);
    /**
     * @OA\Post(path="/user/setPasswordApplyByEmail",
     *   tags={"user"},
     *   summary="установка первого пароля",
     *   description="установка первого пароля",
     *   operationId="setPasswordApplyByEmail",
     *   @OA\Response(response=200, description="User logged in'),
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"password", "rePassword", "hash"},
     *                  @OA\Property(
     *                      property="password",
     *                      description="Идентификатор пользователя",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="rePassword",
     *                      description="повтор пароля",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="hash",
     *                      description="hash",
     *                      @OA\Schema(
     *                          type="string",
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     * )
     */
    $router->post('/setPasswordApplyByEmail', ['middleware' => 'auth', "uses" => $controller . '@setPasswordApplyByEmail']);
    /**
     * @OA\Post(path="/user/logout",
     *   tags={"user"},
     *   summary="Logout user",
     *   description="",
     *   operationId="logout",
     *   @OA\Parameter(
     *     name="authorization",
     *     in="header",
     *     description="Api key header",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="User logged out'),
     *   @OA\Response(response=400, description="Invalid user supplied'),
     *   @OA\Response(response=404, description="User not found'),
     * )
     */
    $router->post('/logout', ['middleware' => 'auth', "uses" => $controller . '@logout']);
    /**
     * @OA\Post(path="/user/changeEmail",
     *   tags={"user"},
     *   summary="Change email user",
     *   description="",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Change email user",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"email"},
     *                  @OA\Property(
     *                      property="email",
     *                      description="User email",
     *                      @OA\Schema(
     *                          type="string",
     *                          format="char"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/changeEmail', ['middleware' => 'auth', "uses" => $controller . '@changeEmail']);
    /**
     * @OA\Post(path="/user/activateEmail",
     *   tags={"user"},
     *   summary="Activate email",
     *   description="",
     *   operationId="activateEmail",
     *   @OA\RequestBody(
     *       required=true,
     *       description="activate bind email and delete olds emails",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"hash"},
     *                  @OA\Property(
     *                      property="hash",
     *                      description="secret word",
     *                      @OA\Schema(
     *                          type="string",
     *                          format="char"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/activateEmail', ['middleware' => 'auth', "uses" => $controller . '@activateEmail']);
    /**
     * @OA\Post(path="/user/changePhone",
     *   tags={"user"},
     *   summary="Change phone user",
     *   description="",
     *   operationId="changePhone",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Change phone user",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone", "country_code"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="Phone number without country code",
     *                      @OA\Schema(
     *                          type="string",
     *                          format="char"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="country_code",
     *                      description="Country code of phone",
     *                      @OA\Schema(
     *                          type="integer"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/changePhone', ['middleware' => 'auth', "uses" => $controller . '@changePhone']);
    /**
     * @OA\Post(path="/user/activatePhone",
     *   tags={"user"},
     *   summary="Activate phone",
     *   description="",
     *   operationId="activatePhone",
     *   @OA\RequestBody(
     *       required=true,
     *       description="activate bind phone and delete olds phones",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  required={"phone", "code"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="Phone number without country code",
     *                      @OA\Schema(
     *                          type="string",
     *                          format="char"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="country_code",
     *                      description="Secret code from sms",
     *                      @OA\Schema(
     *                          type="integer"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/activatePhone', ['middleware' => 'auth', "uses" => $controller . '@activatePhone']);
    /**
     * @OA\Post(path="/user/resetEmail",
     *   tags={"user"},
     *   summary="Generate new hash for email",
     *   description="",
     *   operationId="userResetEmail",
     *   @OA\RequestBody(
     *       required=true,
     *       description="generate new hash for email",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  required={"email"},
     *                  @OA\Property(
     *                      property="country_code",
     *                      description="Email",
     *                      @OA\Schema(
     *                          type="integer"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/resetEmail', ['middleware' => 'auth', "uses" => $controller . '@resetEmail']);
    /**
     * @OA\Post(path="/user/resetPhone",
     *   tags={"user"},
     *   summary="Generate new hash for phone",
     *   description="",
     *   operationId="userResetPhone",
     *   @OA\RequestBody(
     *       required=true,
     *       description="generate new hash for phone",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  required={"phone", "code"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="Phone number without country code",
     *                      @OA\Schema(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="country_code",
     *                      description="Country code",
     *                      @OA\Schema(
     *                          type="integer"
     *                      )
     *                  ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/resetPhone', ['middleware' => 'auth', "uses" => $controller . '@resetPhone']);
    /**
     * @OA\Put(path="/user/setPushToken",
     *   tags={"user"},
     *   summary="save push token",
     *   description="",
     *   operationId="setPushToken",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="just save push token",
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                  required={"push_token", "is_android", "device_id", "device_brand"},
     *                  @OA\Property(
     *                      property="push_token",
     *                      description="push token generated on phone",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="is_android",
     *                      description="if android = true, ios = false",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="device_id",
     *                      description="Gets the device ID. e.g. iOS: iPhone7,2  | Android: goldfish",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="device_brand",
     *                      description="Gets the device brand. e.g.  iOS: Apple,  Android: xiaomi",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="save push token'),
     *   @OA\Response(response=400, description="erro to saving, see logs')
     * )
     */
    $router->put('/setPushToken', ['middleware' => 'auth', "uses" => $controller . '@setPushToken']);
    /**
     * @OA\Post(path="/user/create/promo",
     *   tags={"user"},
     *   summary="Create user from promo app",
     *   description="",
     *   operationId="createUserFromPromo",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Created user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"userName", "email", "phone", "os"},
     *                  @OA\Property(
     *                      property="userName",
     *                      description="ФИО пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      description="Email пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      description="Телефон пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="os",
     *                      description="Операционная система устройства пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="regId",
     *                      description="Уникальный регистрационный идентификатор приложения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="senderId",
     *                      description="Уникальный идентификатор проекта",
     *                      @OA\Schema(
     *                          type="integer",
     *                          format="int64"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="isNotifier",
     *                      description="Признак для получения уведомления",
     *                      @OA\Schema(
     *                          type="boolean",
     *                          default=true
     *                      )
     *                  )
     *           )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->put('/create/promo', $controller . '@registrationPromo');
    /**
     * @OA\Post(path="/user/m/create",
     *   tags={"mobile"},
     *   summary="Создает пользователя через мобильное приложение",
     *   description="",
     *   operationId="mobileCreateUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Created user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="номер телефона пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phoneCountryCode",
     *                      description="Код страны по умолчанию 7",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/m/create', $controller . '@mobileCreateUser');
    /**
     * @OA\Post(path="/user/m/registration",
     *   tags={"mobile"},
     *   summary="Регистрирует пользователя через мобильное приложение",
     *   description="",
     *   operationId="mobileRegistartionUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Registration user",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="номер телефона пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phoneCountryCode",
     *                      description="Код страны по умолчанию 7",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="code",
     *                      description="Код подтверждения",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Имя пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/m/registration', $controller . '@mobileRegistartionUser');
    /**
     * @OA\Post(path="/user/m/confirmTerm",
     *   tags={"mobile"},
     *   summary="Change email user",
     *   description="confirm Term",
     *   operationId="confirmTerm",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="Bind to user not active email'),
     *   @OA\Response(response=400, description="This email has been exists in system')
     * )
     */
    $router->post('/m/confirmTerm', $controller . '@mobileConfirmTerm');
    /**
     * @OA\Post(path="/user/m/smsCode",
     *   tags={"mobile"},
     *   summary="Отправляет код для вход в мобильное приложение, код являеется паролем",
     *   description="",
     *   operationId="mobileSmsCode",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Created user object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="номер телефона пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phoneCountryCode",
     *                      description="Код страны по умолчанию 7",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  )
     *          )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/m/smsCode', $controller . '@getSmsCode');
    /**
     * @OA\Post(path="/user/m/login",
     *   tags={"mobile"},
     *   summary="Вход через мобильное приложение",
     *   description="",
     *   operationId="mobileLogin",
     *   @OA\RequestBody(
     *       required=true,
     *       description="Login user ftom mobile app",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *                  required={"phone"},
     *                  @OA\Property(
     *                      property="phone",
     *                      description="номер телефона пользователя",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="phoneCountryCode",
     *                      description="Код страны по умолчанию 7",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="code",
     *                      description="Код подтверждения, он же пароль",
     *                      @OA\Schema(
     *                          type="string"
     *                      )
     *                  ),
     *          )
     *       )
     *   ),
     *   @OA\Response(response="default", description="successful operation')
     * )
     */
    $router->post('/m/login', $controller . '@mobileLogin');
});