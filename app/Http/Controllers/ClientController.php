<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $item = Client::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
    // firebaseのuidを使って、clientかworkerかを確認する
    public function show(Request $request)
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
}
