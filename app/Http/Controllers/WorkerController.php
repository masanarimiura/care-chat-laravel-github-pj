<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Worker\WorkerStoreRequest;
use App\Http\Requests\Worker\WorkerUpdateRequest;

class WorkerController extends Controller
{
    // 新規 worker 登録
    public function store(WorkerStoreRequest $request)
    {
        $item = Worker::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    // workers の name number role_idの更新
    public function update(WorkerUpdateRequest $request, Worker $worker)
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
            $worker_id = json_decode($request->worker_id);
            if($worker_id){
                $item = Client::where('id', $worker_id)->update($update);
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
                // worker_idが無い場合のエラー
                return response()->json([
                        'message' => 'Client_id not found',
                    ], 404);
            }
        } else {
            // fileがない場合のエラー
            return response()->json([
                'message' => 'File not found',
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
