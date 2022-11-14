<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
    );

    public function shops() {
        return $this->hasMany(Shop::class);
    }
}
