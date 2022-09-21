<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\Admin\AdResource;
use App\Models\Ad;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('ad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdResource(Ad::all());
    }

    public function store(StoreAdRequest $request)
    {
        $ad = Ad::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $ad->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        return (new AdResource($ad))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ad $ad)
    {
        //abort_if(Gate::denies('ad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdResource($ad);
    }

    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad->update($request->all());

        if (count($ad->images) > 0) {
            foreach ($ad->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $ad->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $ad->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return (new AdResource($ad))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ad $ad)
    {
        //abort_if(Gate::denies('ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ad->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
