<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('client_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('content', 1000);
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_comments');
    }
}
