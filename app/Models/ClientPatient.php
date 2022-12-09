<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPatient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    // patient-indexの参加履歴取得と、my-pageのクライアント情報取得で使う。
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
