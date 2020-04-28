<?php
$router->group(['prefix' => '/translations'], function () use ($router) {
    $controller = "TranslateController";

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
    $router->get('/hash', ['middleware' => 'auth', "uses" => $controller . 'getCurrentKey']);

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
    $router->get('/list', ['middleware' => 'auth', "uses" => $controller . 'getTranslations']);

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
    $router->get('/', ['middleware' => 'auth', "uses" => $controller . 'getItems']);

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
    $router->post('/', ['middleware' => 'auth', "uses" => $controller . 'setItem']);

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
    $router->put('/', ['middleware' => 'auth', "uses" => $controller . 'updateItem']);

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
    $router->delete('/', ['middleware' => 'auth', "uses" => $controller . 'deleteItems']);
});
