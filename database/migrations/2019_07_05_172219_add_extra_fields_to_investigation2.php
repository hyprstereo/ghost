<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToInvestigation2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investigations', function (Blueprint $table) {
            $table->string('offence')->after('profile_id')->nullable();
            $table->string('commodity')->after('profile_id')->nullable();
            $table->string('offence_details')->after('profile_id')->nullable();
            $table->text('attachments')->before('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investigations', function (Blueprint $table) {
            $table->dropColumn('offence');
            $table->dropColumn('commodity');
            $table->dropColumn('offence_details');
            $table->dropColumn('attachments');
        });
    }
}
