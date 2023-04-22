<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::disableForeignKeyConstraints();
        Schema::create('positions',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('job_description');
            $table->string('job_requirment');
            $table->unsignedBigInteger('department_id');

            $table->foreign('department_id')->on('id')->references('departments')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('positions');
    }
};
