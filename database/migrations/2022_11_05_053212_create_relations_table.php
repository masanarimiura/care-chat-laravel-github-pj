<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('relation-type_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('relation-type_id')
                    ->references('id')
                    ->on('relations')
                    ->onDelete('cascade');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
