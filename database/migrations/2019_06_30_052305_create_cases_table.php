<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date');
            $table->integer('status')->default(0)->nullable();
            $table->string('case_no')->nullable();
            $table->string('location')->nullable();
            $table->string('station')->nullable();
            $table->integer('raid_leader_id')->nullable();
            $table->integer('profile_id')->nullable();

            $table->timestamp('complainer_date_time')->nullable();
            $table->string('complainer_place_of_offence')->nullable();
            $table->string('complainer_name')->nullable();
            $table->string('complainer_report_no')->nullable();


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
        Schema::dropIfExists('cases');
    }
}
