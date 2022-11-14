<?php

namespace App\Http\Controllers;

use App\Models\WorkerComment;
use Illuminate\Http\Request;

class WorkerCommentController extends Controller
{
    public function show(Request $request)
    {
        $item = WorkerComment::where('patient_id',$request->patient_id)
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
        $item = WorkerComment::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(Request $request, WorkerComment $worker)
    {
        $update = [
            'content' => $request->content,
        ];
        $item = WorkerComment::where('id', $worker->id)->update($update);
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

    public function destroy(WorkerComment $worker)
    {
        $item = WorkerComment::where('id', $worker->id)->delete();
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
