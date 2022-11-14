<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('worker_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('content', 1000);
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
            $table->foreign('worker_id')
                    ->references('id')
                    ->on('workers')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker_comments');
    }
}
