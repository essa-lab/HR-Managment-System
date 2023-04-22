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
        Schema::create('salaries',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->decimal('base_salary', 8, 2);
            $table->decimal('commission', 8, 2)->nullable();
            $table->date('effective_date');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('salaries');
    }
};
