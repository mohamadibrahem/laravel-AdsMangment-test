<?php

namespace App\Http\Requests;

use App\Models\Ad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAdRequest extends FormRequest
{
    public function authorize()
    {
        return true;//Gate::allows('ad_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:ads',
            ],
            'from' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'to' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'total' => [
                'numeric',
                'required',
            ],
            'daily_budget' => [
                'numeric',
                'required',
            ],
            'images' => [
                'array',
                'required',
            ],
            'images.*' => [
                'required',
            ],
        ];
    }
}
