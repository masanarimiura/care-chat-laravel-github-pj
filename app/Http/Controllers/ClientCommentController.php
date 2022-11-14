<?php

namespace App\Http\Controllers;

use App\Models\ClientComment;
use Illuminate\Http\Request;

class ClientCommentController extends Controller
{
    public function show(Request $request)
    {
        $item = ClientComment::where('patient_id',$request->patient_id)
        ->with('worker','client')
        ->get();
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
    
    public function store(Request $request)
    {
        $item = ClientComment::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(Request $request, ClientComment $client)
    {
        $update = [
            'content' => $request->content,
        ];
        $item = ClientComment::where('id', $client->id)->update($update);
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

    public function destroy(ClientComment $client)
    {
        $item = ClientComment::where('id', $client->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
