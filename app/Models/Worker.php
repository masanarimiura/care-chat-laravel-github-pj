<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    // my-pageのクライアント情報取得で使う。
    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    // my-pageのクライアント情報取得、patient-chatの職種表示で使う。
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
