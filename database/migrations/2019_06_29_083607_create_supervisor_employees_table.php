<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supervisor')->unsigned();
            $table->foreign('supervisor')->references('id')->on('users')->onDelete('cascade');
            $table->integer('employee')->unsigned();
            $table->foreign('employee')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_employees');
    }
}
