<?php

namespace App\Http\Controllers;

use App\Providers\MediaServiceProvider;
use App\Providers\transport\MediaHandler;
use Illuminate\Http\Request;

class MediaController extends Controller {

    private $mediaHandler;

    private $userCntrl;

    function __construct() {
        $this->mediaHandler = new MediaHandler(env('media_uri'));
        $this->userCntrl = new UserController();
    }

    public function uploadBase64File(Request $request): array {
        $this->getRequestFields($request, ['fileData']);
        $base64data = $request->get('fileData');

        return $this->mediaHandler->uploadBase64([
            'userId' => $this->userCntrl->getUserId($request),
            'fileData' => $base64data
        ])->getResult();
    }

    public function fileUri($filehash): array {
        //TODO not work
        return $this->mediaHandler->fileUri(['filehash' => $filehash])->getResult();
    }

    public function fileContent($filehash): array {
        $response = $this->mediaHandler->fileContent(['filehash' => $filehash]);

        header("Content-Type: ". $response->getHeaders()['Content-Type'][0]);
        header("Accept-Ranges: bytes", true);
        header("Content-Length: " . $response->getHeaders()['Content-Length'][0]);
        header("Cache-Control: public, max-age=315360000", true);

        $stream = $response->getBody()->read($response->getHeaders()['Content-Length'][0]);

        //TODO not work
        echo $stream;
        exit;
    }
}
