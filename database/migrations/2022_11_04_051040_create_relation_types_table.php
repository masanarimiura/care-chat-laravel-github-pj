<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationTypesTable extends Migration
{
    public function up()
    {
        Schema::create('relation_types', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('relation_types');
    }
}
