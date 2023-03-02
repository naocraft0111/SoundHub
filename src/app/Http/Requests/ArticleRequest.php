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
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif|max:10240',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body'=> '本文',
            'tags' => 'タグ',
            'images' => '画像'
        ];
    }

    public function messages()
    {
        return [
            'mimes' => '指定された拡張子（PNG/JPG/GIF）ではありません。',
            'tags.regex' => ':attributeに「/」と半角スペースは使用できません。',
            'images' => ':attributeは4枚以下で投稿してください。',
            'images.*.max' => '画像は10MB以下で投稿してください。'
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0,5)
            ->map(function ($requestTag){
                return $requestTag->text;
            });
    }

    public function images(): array
    {
        return $this->file('images', []);
    }
}
