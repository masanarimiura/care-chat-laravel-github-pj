<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->string('email', 256)->unique();
            $table->string('password', 256);
            $table->string('number',20)->nullable();
            $table->string('uid',256)->unique();
            $table->string('icon_path',256)->unique()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
