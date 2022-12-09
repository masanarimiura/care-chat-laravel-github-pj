<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClientPatientController;
use App\Http\Controllers\WorkerPatientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\ShopTypeController;


// クライアントアカウント登録、更新
Route::apiResource('/v1/client', ClientController::class)->only([
        'store','update'
]);

// ケアワーカーアカウント登録、更新
Route::apiResource('/v1/worker', WorkerController::class)->only([
        'store','update'
]);

// firebaseのuidを使って、clientかworkerかを確認する
Route::get('/v1/client-check', [ClientController::class, 'check']);
Route::get('/v1/worker-check', [WorkerController::class, 'check']);

// clients or workerのidを使って情報を取得。
Route::get('/v1/client-search', [ClientController::class, 'show']);
Route::get('/v1/worker-search', [WorkerController::class, 'show']);

// 新しい患者チャット patientsテーブルに作成
Route::apiResource('/v1/patient', PatientController::class)->only([
        'store','show'
]);

// patientのnameとpasswordを使って patientsのidを取得。
Route::get('/v1/patient-search', [PatientController::class, 'search']);

// クライアントが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/client-patient', ClientPatientController::class)->only([
        'store'
]);

// ケアワーカーが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/worker-patient', WorkerPatientController::class)->only([
        'store'
]);

// join時に患者チャットの履歴取得
Route::get('/v1/client-patient-search', [ClientPatientController::class, 'search']);
Route::get('/v1/worker-patient-search', [WorkerPatientController::class, 'search']);

// コメントとそれに付随する情報の取得。
Route::get('/v1/comment-search', [CommentController::class, 'search']);

// コメントの投稿、更新、削除
Route::apiResource('/v1/comment', CommentController::class)->only([
        'store','update','destroy'
]);

// my-page.vueからの icon情報 の保存
Route::post('/v1/client-icon_update', [ClientController::class,'icon_update']);
Route::post('/v1/worker-icon_update', [WorkerController::class,'icon_update']);

// relations に client_id と patient_id の同じ組み合わせがないか確認し、状況に応じて保存、更新
Route::post('/v1/relation-update', [RelationController::class, 'update']);

// shop 一覧の取得、追加、更新
Route::apiResource('/v1/shop', ShopController::class)->only([
        'index','store','update'
]);

// shop_type 一覧の取得
Route::apiResource('/v1/shop_type', ShopTypeController::class)->only([
        'index'
]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});
