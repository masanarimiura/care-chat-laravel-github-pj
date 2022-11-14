<?php

namespace App\Http\Controllers;

use App\Models\ClientPatient;
use Illuminate\Http\Request;

class ClientPatientController extends Controller
{
    // join履歴の client-patientsテーブルへ worker_id と patient_id を記録
    public function store(Request $request)
    {
        $item = ClientPatient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
    // client_patientsテーブルの履歴にclient_idとpatient_idの同じ組み合わせが無いか確認。
    public function check(Request $request)
    {
        $item = ClientPatient::where('client_id',$request->client_id)
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
    // ここでclients の id を使って 患者チャットpatientの履歴 idを取得。
    public function show(Request $request)
    {
        $item = ClientPatient::where('client_id',$request->client_id)
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
