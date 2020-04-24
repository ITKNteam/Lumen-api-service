<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/media'], function () use ($router) {
    $controller = "MediaController";
    $router->post('/picture', "$controller@uploadBase64");
    //$router->get('/user/fileUri/{filehash}', "$controller@getFileUri");
    $router->get('/fileContent/{filehash}', "$controller@getContentFileContent");
});

$router->group(['prefix' => '/user'], function () use ($router) {
    $controller = "UserController";
    $router->post('/login', "$controller@login");
    $router->post('/create', "$controller@registration");
    $router->get('/profile', "$controller@getUser");
    $router->put('/profile', "$controller@updateUser");
    $router->get('/list', "$controller@getUsers");
    $router->post('/resetPassword', "$controller@resetPassword");
    $router->post('/setPasswordApplyByPhone', "$controller@setPasswordApplyByPhone");
    $router->post('/setPasswordApplyByEmail', "$controller@setPasswordApplyByEmail");
    $router->post('/logout', "$controller@logout");
    $router->post('/changeEmail', "$controller@changeEmail");
    $router->post('/activateEmail', "$controller@activateEmail");
    $router->post('/changePhone', "$controller@changePhone");
    $router->post('/activatePhone', "$controller@activatePhone");
    $router->post('/resetEmail', "$controller@resetEmail");
    $router->post('/resetPhone', "$controller@resetPhone");
    $router->put('/setPushToken', "$controller@setPushToken");
    $router->put('/create/promo', "$controller@registrationPromo");

    $router->post('/m/create', "$controller@mobileCreateUser");
    $router->post('/m/registration', "$controller@mobileRegistartionUser");
    $router->post('/m/confirmTerm', "$controller@mobileConfirmTerm");
    $router->post('/m/smsCode', "$controller@getSmsCode");
    $router->post('/m/login', "$controller@mobileLogin");
});

$router->group(['prefix' => '/billing'], function () use ($router) {
    $controller = "BillingController";
    
    $router->post('/creditCard', "$controller@addCreditCard");
    $router->get('/creditCard', "$controller@getCreditCard");
    $router->delete('/creditCard', "$controller@deleteCreditCard");
    $router->patch('/creditCard', "$controller@patchCreditCard");

    $router->post('/pay', "$controller@addPay");

    $router->post('/tariff', "$controller@createTariff");
    $router->get('/tariffs', "$controller@getTariff");
    $router->post('/tariff/bindUser', "$controller@bindTariffBindUser");
    $router->get('/tariff/user', "$controller@getCurrentTariff");

    $router->get('/writeOffs', "$controller@getAllWriteOffs");
    $router->get('/writeOffs/user', "$controller@getCurrentWriteOffs");
    $router->post('/writeOffs', "$controller@payRent");
});

$router->group(['prefix' => '/claim/m'], function () use ($router) {
    $controller = "ClaimController";
    
    $router->post('/create', "$controller@createClaim");
    $router->get('/list', "$controller@listClaim");
    $router->put('/update', "$controller@updateClaim");

    /***
     * COMMENTS
     */
    
    $router->post('/comment', "$controller@createClaimComment");
    $router->get('/comments', "$controller@listClaimComments");
});

$router->group(['prefix' => '/handbooks'], function () use ($router) {
    $controller = "HandbooksController";
    
    $router->get('/', "$controller@getHandbooks");
    $router->post('/', "$controller@setHandbook");
    $router->put('/', "$controller@updateHandbook");
    $router->get('/value', "$controller@getHandbookData");
    $router->post('/value', "$controller@setHandbookData");
    $router->put('/value', "$controller@updateHandbookData");
    //$router->get('/m/list', 'dumpHandbooks');
});

$router->group(['prefix' => '/media'], function () use ($router) {
    $controller = "MediaController";

    $router->post('/picture', "$controller@uploadBase64File");
    $router->get('/user/fileUri/{filehash}', "$controller@fileUri");
    $router->get('/fileContent/{filehash}', "$controller@fileContent");
});

$router->group(['prefix' => '/media'], function () use ($router) {
    $controller = "MediaController";

    $router->post('/picture', "$controller@uploadBase64File");
    $router->get('/user/fileUri/{filehash}', "$controller@fileUri");
    $router->get('/fileContent/{filehash}', "$controller@fileContent");
});

$router->group(['prefix' => '/notifications'], function () use ($router) {
    $controller = "NotificationsController";

    $router->post('/send', "$controller@sendNotifications");
});

$router->group(['prefix' => '/objects'], function () use ($router) {
    $controller = "ObjectsController";

    $router->get('/types', "$controller@getObjectTypes");
    $router->post('/types', "$controller@setObjectType");
    $router->put('/types', "$controller@updateObjectType");

    $router->get('/subtypes', "$controller@getObjectSubtypes");
    $router->post('/subtypes', "$controller@setObjectSubtype");
    $router->put('/subtypes', "$controller@updateObjectSubtype");

    $router->get('/list', "$controller@getListObjects");
    $router->get('/user', "$controller@getUserObjects");

    $router->get('/', "$controller@getPublicObjects");
    $router->post('/', "$controller@setObject");
    $router->put('/', "$controller@updateObject");
    $router->delete('/', "$controller@deleteObjects");

    $router->get('/comments', "$controller@getComments");
    $router->post('/comments', "$controller@setComment");
    $router->put('/comments', "$controller@updateComment");
    $router->delete('/comments', "$controller@deleteComments");

    $router->get('/audit', "$controller@getAudit");

    $router->get('/file/types', "$controller@getFileTypes");
    $router->post('/file/types', "$controller@setFileType");
    $router->put('/file/types', "$controller@updateFileType");

    $router->get('/file/attached', "$controller@getAttachedFiles");
    $router->post('/file/attached', "$controller@setAttachedFile");
    $router->delete('/file/attached', "$controller@deleteAttachedFiles");
    $router->put('/file/attached', "$controller@updateAttachedFile");

    $router->post('/file/attached/link', "$controller@linkFileToFile");
    $router->put('/file/attached/link', "$controller@unlinkFileFromFile");
});

$router->group(['prefix' => '/routes'], function () use ($router) {
    $controller = "RoutesController";

    $router->get('/welcome', "$controller@index");
    $router->get('/headings', "$controller@getHeadings");
    $router->post('/headings', "$controller@setHeading");
    $router->put('/headings', "$controller@updateHeading");

    $router->get('/', "$controller@getRoutes");
    $router->post('/', "$controller@setRoute");
    $router->put('/', "$controller@updateRoute");
    $router->delete('/', "$controller@deleteRoutes");

    $router->get('/user', "$controller@getUserRoutes");

    $router->post('/poster', "$controller@updatePosterRoute");

    $router->post('/paid', "$controller@paidRoute");

    $router->get('/points', "$controller@getPoints");
    $router->post('/points', "$controller@setPoint");
    $router->put('/points', "$controller@updatePoint");
    $router->delete('/points', "$controller@deletePoints");

    $router->post('/points/arr', "$controller@setPointArr");

    $router->get('/comments', "$controller@getComments");
    $router->post('/comments', "$controller@setComment");
    $router->put('/comments', "$controller@updateComment");
    $router->delete('/comments', "$controller@deleteComments");

    $router->get('/audit', "$controller@getAudit");
});


$router->group(['prefix' => '/translations'], function () use ($router) {
    $controller = "RoutesController";

    /**
     * @OA\Get(
     *     path="/translations/hash",
     *     tags={"Модуль переводов"},
     *     summary="Хеш текущего состояния",
     *     description="Маршрут для получения хеша текущего состояния переводов",
     *     operationId="translationsGetCurrentKey",
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="hash",
     *                 description="Хеш текущего состояния",
     *                 type="string"
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
    $router->get('/hash', 'getCurrentKey');

    /**
     * @OA\Get(
     *     path="/translations/list",
     *     tags={"Модуль переводов"},
     *     summary="Список переводов",
     *     description="Маршрут для получения списка переводов",
     *     operationId="translationsGetTranslations",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="language",
     *         in="query",
     *         description="Язык для выборки, доступные значения: english, russian, ukrainian",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Словарь",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Невалидное значения параметра"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Значений не найдено"
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
    $router->get('/list', 'getTranslations');

    /**
     * @OA\Get(
     *     path="/translations",
     *     tags={"Модуль переводов"},
     *     summary="Список переводов для админки",
     *     description="Маршрут для получения списка переводов",
     *     operationId="translationsGetItems",
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
     *         name="sort",
     *         in="query",
     *         description="Условие сортировки",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="object",
     *                  @OA\Property(
     *                      property="property",
     *                      description="Параметр сортировки",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="direction",
     *                      description="Направление сортировки",
     *                      type="string"
     *                  )
     *             )
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
     *                         property="keyword",
     *                         description="Ключевое слово",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="english",
     *                         description="Английский перевод",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="russian",
     *                         description="Российский перевод",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="ukrainian",
     *                         description="Украинский перевод",
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
     *         response=404,
     *         description="Значений не найдено"
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
    $router->get('/', 'getItems');

    /**
     * @OA\Post(
     *     path="/translations",
     *     tags={"Модуль переводов"},
     *     summary="Создание перевода",
     *     description="Маршрут для создания перевода",
     *     operationId="translationsSetItem",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма создания перевода",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={"keyword"},
     *                  @OA\Property(
     *                      property="keyword",
     *                      description="Ключевое слово",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="english",
     *                      description="Английский перевод",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="russian",
     *                      description="Российский перевод",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="ukrainian",
     *                      description="Украинский перевод",
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
    $router->post('/', 'setItem');

    /**
     * @OA\Put(
     *     path="/translations",
     *     tags={"Модуль переводов"},
     *     summary="Редактирование перевода",
     *     description="Маршрут для редактирования перевода",
     *     operationId="translationsUpdateItem",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Форма редактирования перевода",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"id", "keyword"},
     *                  @OA\Property(
     *                      property="id",
     *                      description="Идентификатор записи",
     *                      type="integer",
     *                      format="int64"
     *                  ),
     *                  @OA\Property(
     *                      property="keyword",
     *                      description="Ключевое слово",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="english",
     *                      description="Английский перевод",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="russian",
     *                      description="Российский перевод",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="ukrainian",
     *                      description="Украинский перевод",
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
    $router->put('/', 'updateItem');

    /**
     * @OA\Delete(
     *     path="/translations",
     *     tags={"Модуль переводов"},
     *     summary="Удаление переводов",
     *     description="Маршрут для удаления переводов",
     *     operationId="translationsDeleteItems",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Идентификатор записи",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="listId",
     *         in="query",
     *         description="Список идентификаторов переводов через запятую",
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
    $router->delete('/', 'deleteItems');

});

