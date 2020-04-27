<?php
$router->group(['prefix' => '/pilot'], function () use ($router) {
    $controller = "PilotSubscriberController";

    /**
     * @OA\Post(path="/pilot/subscriber",
     *   tags={"pilot"},
     *   summary="collect data about devices",
     *   description="This can only be done by the logged in user.",
     *   operationId="subscriber",
     *   @OA\RequestBody(
     *       required=true,
     *       description="subscriber",
     *       @OA\MediaType(
     *           mediaType="raw",
     *      )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->get('/subscriber', "$controller@pilotSubscriber");
});