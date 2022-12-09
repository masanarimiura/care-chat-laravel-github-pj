<?php

namespace App\Http\Controllers;

use App\Models\ClientPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ClientPatient\ClientPatientStoreRequest;

class ClientPatientController extends Controller
{
    // チャットIDへの参加or作成の履歴の client-patientsテーブルへ client_id と patient_id を記録
    public function store(ClientPatientStoreRequest $request)
    {
        // client_idとpatient_id の同一の組み合わせがないか確認
        $item = ClientPatient::where('client_id',$request->client_id)
        ->where('patient_id',$request->patient_id)
        ->first();
        if ($item != null) {
            return response()->json([
                'data' => $item,
                'message' => 'Found same column'
            ], 200);
        } else if ($item == null) {
            $item = ClientPatient::create($request->all());
            return response()->json([
                'data' => $item
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    
    // ここでclients の id を使って 患者チャットpatientの履歴 idを取得。
    public function search(Request $request)
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
