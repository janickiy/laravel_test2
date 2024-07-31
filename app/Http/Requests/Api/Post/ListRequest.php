<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1',
        ];
    }
}
