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
        // ゲストユーザーログイン時は、ユーザー名とメールアドレスをバリデーションにかけない
        if(Auth::id() == config('user.guest_user.id')) {
            return [

            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:15', Rule::unique('users')->ignore(Auth::id())],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            ];
        }
    }
}
