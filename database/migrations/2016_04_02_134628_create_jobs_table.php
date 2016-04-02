<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resume_id')->default(0);
            $table->string('company');
            $table->string('role')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('resume_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
