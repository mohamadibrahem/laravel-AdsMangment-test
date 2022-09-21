@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ad.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.id') }}
                        </th>
                        <td>
                            {{ $ad->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.name') }}
                        </th>
                        <td>
                            {{ $ad->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.from') }}
                        </th>
                        <td>
                            {{ $ad->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.to') }}
                        </th>
                        <td>
                            {{ $ad->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.total') }}
                        </th>
                        <td>
                            {{ $ad->total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.daily_budget') }}
                        </th>
                        <td>
                            {{ $ad->daily_budget }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ad.fields.images') }}
                        </th>
                        <td>
                            @foreach($ad->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection