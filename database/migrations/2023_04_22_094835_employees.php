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
        Schema::create('employees',function(Blueprint $table){
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email');
            $table->string('phone_number');
            $table->date('hire_date');
            $table->date('termination_date');
            $table->enum('gender',['Male','Female']);
            $table->enum('mariral_status',['Single','Married']);
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('department_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions');
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
        Schema::dropIfExists('employees');
    }
};
