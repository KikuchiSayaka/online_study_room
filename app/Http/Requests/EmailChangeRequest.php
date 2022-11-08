<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
// これがないとfetchでform requestした時にバリデーションエラーが出ない
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmailChangeRequest extends FormRequest
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
     *, 2度入力したパスワードが一致するか？'confirmed'
     */
    public function rules()
    {

        return [
            'email' => ['required', 'string', 'email', 'max:256', 'unique:users'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'errors' => $validator->errors(),
            ],
            422);
        throw new HttpResponseException($res);
    }
}
