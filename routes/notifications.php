<?php
$router->group(['prefix' => '/notifications'], function () use ($router) {
    $controller = "NotificationsController";

    /**
     * @OA\Post(
     *     path="/notifications/send",
     *     tags={"Уведомления"},
     *     summary="Sending notifications to user",
     *     operationId="sendNotifications",
     *     security={{"bearerAuth":{}}},
     *     deprecated=false,
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"channels", "template"},
     *                 @OA\Property(
     *                     property="channels",
     *                     description="List of channels to send in JSON format: {email:1,push:0,sms:0,telegram:0}",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="template",
     *                     description="Message template in JSON or string format: {email:'Hi, test for email',push:null,sms:null,telegram:null} or 'Hi, test for all channels'",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="message_data",
     *                     description="Message data in JSON format: {username:'Demo D.D.'}",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="User email",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     description="User phone",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="android_token",
     *                     description="User android token for push-sending",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="ios_token",
     *                     description="User iOS token for push-sending",
     *                     @OA\Schema(
     *                          type="string"
     *                      )
     *                 ),
     *                 @OA\Property(
     *                     property="send_dt",
     *                     description="Send date time",
     *                     @OA\Schema(
     *                          type="integer"
     *                      )
     *                 )
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
    $router->post('/send', ['middleware' => 'auth', "uses" => $controller . 'sendNotifications']);
});