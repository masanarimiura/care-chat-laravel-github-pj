<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->string('password', 256)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
