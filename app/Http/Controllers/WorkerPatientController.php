<?php

namespace App\Http\Controllers;

use App\Models\WorkerPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\WorkerPatient\WorkerPatientStoreRequest;

class WorkerPatientController extends Controller
{
    // チャットIDへの参加or作成の履歴の worker-patientsテーブルへ worker_id と patient_id を記録
    public function store(WorkerPatientStoreRequest $request){
        // worker_idとpatient_id の同一の組み合わせがないか確認
        $item = WorkerPatient::where('worker_id',$request->worker_id)
        ->where('patient_id',$request->patient_id)
        ->first();
        if ($item != null) {
            return response()->json([
                'data' => $item,
                'message' => 'Found same column'
            ], 200);
        } else if ($item == null) {
            $item = WorkerPatient::create($request->all());
            return response()->json([
                'data' => $item
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    // ここでworkers の id を使って 患者チャットpatientの履歴 idを取得。
    public function search(Request $request)
    {
        $item = WorkerPatient::where('worker_id',$request->worker_id)
        ->with('patient')
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
}