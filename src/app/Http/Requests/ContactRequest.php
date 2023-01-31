<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'title' => 'nullable|string|max:255',
            'body' => 'required|string|max:1000',
            'agree' => 'required',
            'agree.*' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'title' => '件名',
            'body' => 'お問い合わせ内容',
        ];
    }

    public function messages()
    {
        return [
            'agree.required' => 'プライバシーポリシーを確認後、チェックしてください。'
        ];
    }
}
