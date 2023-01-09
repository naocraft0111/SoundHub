<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50|not_regex:/<\/*script>/u',
            'body' => 'required|max:500',
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'タイトル',
            'body'=> '本文',
        ];
    }
}
