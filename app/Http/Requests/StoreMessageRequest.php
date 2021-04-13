<?php

namespace App\Http\Requests;

use App\Models\Message;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('message_create');
    }

    public function rules()
    {
        return [
            'chanel_id' => [
                'integer',
                'exists:chanels,id',
                'nullable',
            ],
            'title'     => [
                'string',
                'nullable',
            ],
            'text'      => [
                'string',
                'required',
            ],
            'contactt'  => [
                'string',
                'nullable',
            ],
            'contacts'  => [
                'string',
                'nullable',
            ],
            'tag'       => [
                'array',
            ],
            'tag.*.id'  => [
                'integer',
                'exists:tags,id',
            ],
        ];
    }
}
