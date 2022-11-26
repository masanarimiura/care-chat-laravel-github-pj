<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
    );
}
