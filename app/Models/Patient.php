<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;
    
    // my-pageのクライアント情報取得で使う。
    public function relations() {
        return $this->hasMany(Relation::class);
    }
}
