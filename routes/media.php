<?php
$router->group(['prefix' => '/media'], function () use ($router) {
    $controller = "MediaController";

    /**
     * @OA\Post(path="/media/picture",
     *   tags={"media"},
     *   summary="Загрузка файла изображения в base64  формате",
     *   description="Загружает файл изображения",
     *   operationId="picture",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="fileData",
     *     in="query",
     *     description="файл изображения, закодированный в base64",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=200, description="User logged out"),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     * )
     */
    $router->post('/picture', "$controller@uploadBase64File");
    /**
     * @OA\Get(path="/user/fileUri/{filehash}",
     *   tags={"media"},
     *   summary="Get file uri by file hash",
     *   description="Возвращает ссылку на файл из хранилища ASW S3",
     *   operationId="fileUri",
     *   @OA\Parameter(
     *     name="filehash",
     *     in="path",
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
    $router->get('/user/fileUri/{filehash}', "$controller@fileUri");
    /**
     * @OA\Get(path="/media/fileContent/{filehash}",
     *   tags={"media"},
     *   summary="Get file content by file hash",
     *   description="Возвращает файл из хранилища ASW S3",
     *   operationId="fileContent",
     *   @OA\Parameter(
     *     name="filehash",
     *     in="path",
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
    $router->get('/fileContent/{filehash}', "$controller@fileContent");
});