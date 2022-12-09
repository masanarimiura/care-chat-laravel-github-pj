<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WorkerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // 認証機能はフロントで実装してるから不要のため true
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['string', 'max:100'],
            'email' => ['email', 'max:256','unique:workers'],
            'number' => ['between:8,20','nullable'],
            'role_id' => ['integer'],
            'shop_id' => ['integer'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, //jsonの返事の中身のエラー番号
            'errors' => $validator->errors(),
        ],400); //実際に送られるresponse codeが400番これが無いと200番のstatusOKになる。
        //例外を知らせる。throw new 例外クラス名（例外message）
        throw new HttpResponseException($response);
    }
}
