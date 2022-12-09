<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Shop\ShopStoreRequest;
use App\Http\Requests\Shop\ShopUpdateRequest;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(ShopStoreRequest $request)
    {
        $item = Shop::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        $update = [
            'name' => $request->name,
            'shop_type_id' => $request->shop_type_id,
            'number' => $request->number,
            'email' => $request->email,
        ];
        $item = Shop::where('id', $shop->id)->update($update);
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
}
