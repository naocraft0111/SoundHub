<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        // ゲストユーザーログイン時はバリデーションにかけない
        if(Auth::id() == config('user.guest_user.id')) {
            return [
                'self_introduction' => ['string', 'min:1', 'max:50', 'nullable'],
            ];
        }

        return [
            'name' => ['required', 'string', 'max:15', Rule::unique('users')->ignore(Auth::id())],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'self_introduction' => ['string', 'min:1', 'max:50', 'nullable'],
            'avatar' => ['image', 'nullable', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
        ];
    }

    public function attributes()
    {
        return [
            'age' => '年齢',
            'self_introduction' => '自己紹介',
            'avatar' => 'アバター'
        ];
    }

    public function messages()
    {
        return [
            'mines' => '指定された拡張子（PNG/JPG/GIF）ではありません。',
            'max' => '1Mを超えています。'
        ];
    }


}
