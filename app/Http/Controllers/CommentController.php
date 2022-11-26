<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // コメントとそれに付随する情報の取得。
    public function search(Request $request)
    {
        $item = Comment::where('patient_id',$request->patient_id)
        ->with('client.relations.relation_type','worker.role')
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
    
    // 以下コメントの保存、更新、削除。
    public function store(Request $request)
    {
        $item = Comment::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $update = [
            'content' => $request->content,
        ];
        $item = Comment::where('id', $comment->id)->update($update);
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

    public function destroy(Comment $comment)
    {
        $item = Comment::where('id', $comment->id)->delete();
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
