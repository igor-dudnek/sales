<?php

namespace App\Http\Requests;

use App\Models\Chanel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class StoreChanelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chanel_create');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'chanelurl'   => [
                'string',
                'required',
                'unique:chanels',
            ],
            'status'      => [
                'boolean',
            ],
            'user_id'     => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'type'        => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Chanel::TYPE_SELECT, 'value')),
            ],
        ];
    }
}
