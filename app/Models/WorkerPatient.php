<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPatient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public static $rules = array(
        'worker_id' => 'required',
        'patient_id' => 'required',
    );

    // patient-indexの参加履歴取得で使う。
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
