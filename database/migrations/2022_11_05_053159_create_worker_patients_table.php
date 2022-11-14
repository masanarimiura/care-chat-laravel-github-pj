<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerPatientsTable extends Migration
{
    public function up()
    {
        Schema::create('worker_patients', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('worker_id')
                    ->references('id')
                    ->on('workers')
                    ->onDelete('cascade');
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker_patients');
    }
}
