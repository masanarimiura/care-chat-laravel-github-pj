<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    
    // patient-chatでコメント取得の際に使う。
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    
    // patient-chatでコメント取得の際に使う。
    public function worker() {
        return $this->belongsTo(Worker::class);
    }
}
