<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShopStoreRequest extends FormRequest
{
    public function authorize()
    {
        // 認証機能はフロントで実装してるから不要のため true
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required','max:100'],
            'shop_type_id' => ['required','integer'],
            'email' => ['email','max:256','nullable'],
            'number' => ['between:8,20','nullable'],
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
