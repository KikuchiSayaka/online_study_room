<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
// これがないとfetchでform requestした時にバリデーションエラーが出ない
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserUpdateRequest extends FormRequest
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
     * @return array
     * 必須だと'required',
     *, 2度入力したパスワードが一致するか？'confirmed'
     */
    public function rules()
    {

        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:24', 'unique:users'],
            'password' => ['required', 'string', 'min:12'],
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $res = response()->json([
    //         'errors' => $validator->errors(),
    //         ],
    //         422);
    //     throw new HttpResponseException($res);
    // }
}
