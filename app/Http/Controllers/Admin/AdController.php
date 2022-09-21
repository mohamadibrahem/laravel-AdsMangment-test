<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAdRequest;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AdController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ads = Ad::with(['media'])->get();

        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        abort_if(Gate::denies('ad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ads.create');
    }

    public function store(StoreAdRequest $request)
    {
        $ad = Ad::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $ad->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ad->id]);
        }

        return redirect()->route('admin.ads.index');
    }

    public function edit(Ad $ad)
    {
        abort_if(Gate::denies('ad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ads.edit', compact('ad'));
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

        return redirect()->route('admin.ads.index');
    }

    public function show(Ad $ad)
    {
        abort_if(Gate::denies('ad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ads.show', compact('ad'));
    }

    public function destroy(Ad $ad)
    {
        abort_if(Gate::denies('ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ad->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdRequest $request)
    {
        Ad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ad_create') && Gate::denies('ad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ad();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
