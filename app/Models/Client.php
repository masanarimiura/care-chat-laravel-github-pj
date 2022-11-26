<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    // my-pageのクライアント情報取得、patient-chatの関係性表示で使う。
    public function relations(){
        return $this->hasMany(Relation::class);
    }

    // my-pageのクライアント情報取得で使う。
    public function client_patients(){
        return $this->hasMany(ClientPatient::class);
    }

}
