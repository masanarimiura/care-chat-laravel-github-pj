<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerComment extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    
    public function worker() {
        return $this->belongsTo(Worker::class);
    }

}
