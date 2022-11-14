<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->bigInteger('shop_type_id')->unsigned();
            $table->string('email', 256)->nullable();
            $table->string('number',20)->nullable();
            $table->foreign('shop_type_id')
                    ->references('id')
                    ->on('shop_types')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
