<?php

namespace App\Http\Controllers;

use App\Providers\transport\MediaHandler;
use Illuminate\Http\Request;

class MediaController extends Controller {

    private $mediaHandler;

    function __construct() {
        $this->mediaHandler = new MediaHandler(env('MEDIA_URI'));
    }

    public function uploadBase64File(Request $request) {
        $this->getRequestFields($request, ['fileData']);
        $base64data = $request->get('fileData');

        return $this->responseJSON($this->mediaHandler->uploadBase64([
            'userId' => $request->user()->getId(),
            'fileData' => $base64data
        ]));
    }

    public function fileUri($filehash) {
        //TODO not work
        return $this->mediaHandler->fileUri(['filehash' => $filehash])->getResult();
    }

    public function fileContent($filehash) {
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
