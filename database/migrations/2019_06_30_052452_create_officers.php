<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('grade')->nullable();
            $table->string('full_name')->nullable();
            $table->string('rank')->nullable();
            $table->string('division')->nullable();
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
        Schema::dropIfExists('officers');
    }
}
