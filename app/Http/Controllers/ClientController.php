<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;

class ClientController extends Controller
{
    // 新規 client 登録
    public function store(ClientStoreRequest $request)
    {
        $item = Client::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    // clients の name number emailの更新
    public function update(ClientUpdateRequest $request, Client $client)
    {
        if($request->name and $request->number == null and $request->email == null){
            $update = [
                'name' => $request->name,
            ];
        } else if ($request->name == null and $request->number and $request->email == null){
            $update = [
                'number' => $request->number,
            ];
        } else if ($request->name == null and $request->number == null and $request->email == null){
            $update = [
                'number' => null,
            ];
        } else if ($request->name == null and $request->number == null and $request->email){
            $update = [
                'email' => $request->email,
            ];
        } 
        $item = Client::where('id', $client->id)->update($update);
        if ($item) {
            return response()->json([
            'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
            'message' => 'Not found',
            ], 404);
        }
    }

    public function icon_update(Request $request,)
    {
        if($request->file('file')){
            // formDataからfileを取り出し、storeで、public下のiconに保存、返り値でパスをもらう。
            $image = $request->file('file');
            $imagePath = $image->store('public/icon');
            // パスのpublic部分が不要となるので切り捨てる
            $imagePath= 'storage'.str_replace('public','',$imagePath);
            $update = [
                'icon_path' => $imagePath,
            ];
            $client_id = json_decode($request->client_id);
            if($client_id){
                $item = Client::where('id', $client_id)->update($update);
                if ($item) {
                    return response()->json([
                        'message' => $imagePath,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Not found',
                    ], 404);
                }
            } else {
                return response()->json([
                        'message' => 'Client_id not found',
                    ], 404);
            }
        } else {
            return response()->json([
                'message' => 'File not found',
            ], 404);
        }
    }

    // firebaseのuidを使って、clientかworkerかを確認する
    public function check(Request $request)
    {
        $item = Client::where('uid',$request->uid)->first();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else if ($item == null) {
            return response()->json([
                'data' => null
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    
    // clientsの idからクライアントに関する情報を取得。
    public function show(Request $request)
    {
        $item = Client::where('id',$request->id)
        ->with('client_patients.patient.relations.relation_type')
        ->first();
        if ($item) {
            return response()->json([
            'data' => $item
            ], 200);
        } else {
            return response()->json([
            'message' => 'Not found',
            ], 404);
        }
    }
}
