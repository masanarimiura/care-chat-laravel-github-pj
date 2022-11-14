<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function comments(){
        return $this->belongsToMany(Patient::class,'comments','worker_id','patient_id');
    }

    public function worker_patients(){
        return $this->belongsToMany(Patient::class,'worker_patients','worker_id','patient_id');
    }
}
