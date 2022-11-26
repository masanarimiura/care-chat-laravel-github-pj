<?php

namespace App\Http\Controllers;

use App\Models\WorkerPatient;
use Illuminate\Http\Request;

class WorkerPatientController extends Controller
{
    // join履歴の worker-patientsテーブルへ worker_id と patient_id を記録
    public function store(Request $request)
    {
        $item = WorkerPatient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
    // worker_patientsテーブルの履歴にworker_idとpatient_idの同じ組み合わせが無いか確認。
    public function check(Request $request)
    {
        $item = WorkerPatient::where('worker_id',$request->worker_id)
        ->where('patient_id',$request->patient_id)
        ->get();
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