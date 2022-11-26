<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    // 新規 worker 登録
    public function store(Request $request)
    {
        $item = Worker::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    // workers の name number role_idの更新
    public function update(Request $request, Worker $worker)
    {
        if($request->name and $request->number == null and $request->role_id == null and $request->shop_id == null and $request->email == null){
            $update = [
                'name' => $request->name,
            ];
        } else if ($request->name == null and $request->number and $request->role_id == null and $request->shop_id == null and $request->email == null){
            $update = [
                'number' => $request->number,
            ];
        } else if ($request->name == null and $request->number == null and $request->role_id == null and $request->shop_id == null and $request->email == null){
            $update = [
                'number' => null,
            ];
        } else if ($request->name == null and $request->number == null and $request->role_id and $request->shop_id == null and $request->email == null){
            $update = [
                'role_id' => $request->role_id,
            ];
        } else if ($request->name == null and $request->number == null and $request->role_id == null and $request->shop_id and $request->email == null){
            $update = [
                'shop_id' => $request->shop_id,
            ];
        } else if ($request->name == null and $request->number == null and $request->role_id == null and $request->shop_id == null and $request->email){
            $update = [
                'email' => $request->email,
            ];
        }
        $item = Worker::where('id', $worker->id)->update($update);
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
        $item = Worker::where('uid',$request->uid)->first();
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
    // workers idからケアワーカーに関する情報を取得。
    public function show(Request $request)
    {
        $item = Worker::where('id',$request->id)
        ->with('role','shop.shop_type')
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
