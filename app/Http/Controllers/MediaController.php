<?php

namespace App\Http\Controllers;

use App\Providers\MediaServiceProvider;
use Illuminate\Http\Request;

class MediaController extends Controller {
    /**
     * @var MediaServiceProvider
     */
    private $mediaService;

    /**
     * MediaController constructor.
     * @param MediaServiceProvider $serviceProvider
     */
    function __construct(MediaServiceProvider $serviceProvider) {
        $this->mediaService = $serviceProvider;
    }

    public function picture(Request $request) {
        $this->requestHas($request, ['fileData']);
        $base64data = $request->get('fileData');
        $userController = new UserController();
        $userId = $userController->getUserId();
        $this->mediaHandler->uploadBase64(['userId' => $userId, 'fileData' => $base64data]);
    }

    public function getFileUri() {

    }

    public function getContentFileContent() {

    }
}
