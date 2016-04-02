<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('resume_id');
            $table->integer('sort')->default(0);
            $table->string('type');

            $table->string('section_header')->nullable();

            $table->text('item_content')->nullable();

            $table->string('job_company')->nullable();
            $table->string('job_role')->nullable();
            $table->string('job_start_month')->nullable();
            $table->string('job_start_year')->nullable();
            $table->text('job_content');

            $table->string('education_school')->nullable();
            $table->string('education_degree')->nullable();
            $table->string('education_major')->nullable();
            $table->text('education_content')->nullabele();

            $table->timestamps();
            $table->softDeletes();

            $table->index('resume_id');
            $table->index('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
