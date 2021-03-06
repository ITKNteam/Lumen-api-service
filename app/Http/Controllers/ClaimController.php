<?php

namespace App\Http\Controllers;

use App\Providers\transport\ClaimHandler;
use App\Providers\transport\MediaHandler;
use Illuminate\Http\Request;
use Exception;

class ClaimController extends Controller {

    private $claimHandler;

    private $mediaHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->claimHandler = new ClaimHandler(env('BIZ_URI'));
        $this->mediaHandler = new MediaHandler(env('MEDIA_URI'));
    }

    public function createClaim(Request $request) {
        $this->getRequestFields($request, [
            'typeId',
            'description',
        ]);

        $typeId = $request->get('typeId') ?? 0;
        $description = $request->get('description') ?? 0;

        $vehicleId = $request->get('vehicleId') ?? -1;
        $photos = json_decode($request->get('photos') ?? '[]', true);
        $photosHashs = [];

        foreach ($photos as $photo) {
            $resMedia = $this->mediaHandler->uploadBase64([
                'userId' => $this->userId,
                'fileData' => $photo
            ]);

            if ($resMedia->isSuccess()) {
                $photosHashs[] = $resMedia->getData('fileHash');
            }
        }

        $fields = [
            'typeId' => $typeId,
            'description' => $description,
            'vehicleId' => $vehicleId,
            'photos' => json_encode($photosHashs),
            'userId' => $request->user()->getId()
        ];

        $claimHandler = $this->claimHandler->createClaim($fields);

        if ($claimHandler->isSuccess()) {
            return $this->responseJSON($claimHandler);
        } else {
            return $this->failResponse($claimHandler);
        }
    }

    public function updateClaim(Request $request) {
        $this->getRequestFields($request, [
            'claimId',
            'statusId'
        ]);

        $claimId = $request->get('claimId' ?? 0);
        $statusId = $request->get('statusId' ?? 0);

        $photos = $request->get('photos' ?? '[]');

        $fields = [
            'claimId' => $claimId,
            'statusId' => $statusId,
            'photos' => $photos,
            'userId' => $request->user()->getId()
        ];

        $claimHandler = $this->claimHandler->changeClaimStatus($fields);

        if ($claimHandler->isSuccess()) {
            return $this->responseJSON($claimHandler);
        } else {
            return $this->failResponse($claimHandler);
        }
    }

    public function listClaim(Request $request) {
        $claimHandler = $this->claimHandler->listClaims([
            'userId' => $request->user()->getId()
        ]);

        if ($claimHandler->isSuccess()) {
            return $this->responseJSON($claimHandler);
        } else {
            return $this->failResponse($claimHandler);
        }
    }

    public function createClaimComment(Request $request) {
        $fields = $this->getRequestFields($request, [
            'claimId',
            'txt',
            'photos'
        ]);

        $fields['userId'] = $request->user()->getId();

        $claimHandler = $this->claimHandler->createClaimComment($fields);
        if ($claimHandler->isSuccess()) {
            return $this->responseJSON($claimHandler);
        } else {
            return $this->failResponse($claimHandler);
        }
    }

    public function listClaimComments(Request $request) {
        $claimHandler = $this->claimHandler->listClaimComments([
            'userId' => $request->user()->getId()
        ]);

        if ($claimHandler->isSuccess()) {
            return $this->responseJSON($claimHandler);
        } else {
            $this->sentryAbort(new Exception($claimHandler->getMessage(), $claimHandler->getRes()));
        }
    }
}
