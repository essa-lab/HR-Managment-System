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
        Schema::create('employess_statuses', function (Blueprint $table) {
            $table->id();
            $table->double('salary');
            $table->foreignId('emp_id')->constrained('employees');
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('manager_id')->nullable()->constrained('employees');
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
        Schema::dropIfExists('employess_statuses');
    }
};
