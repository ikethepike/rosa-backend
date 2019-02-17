<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlacementToChallengeSubmissions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('challenge_submissions', function (Blueprint $table) {
            $table->integer('placement')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('challenge_submissions', function (Blueprint $table) {
            //
        });
    }
}
