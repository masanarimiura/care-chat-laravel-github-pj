<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // 新規 client 登録
    public function store(Request $request)
    {
        $item = Client::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    // clients の name numberの更新
    public function update(Request $request, Client $client)
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
