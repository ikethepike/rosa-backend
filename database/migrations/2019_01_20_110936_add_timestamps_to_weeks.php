<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToWeeks extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('weeks', function (Blueprint $table) {
            $table->datetime('starts_at');
            $table->datetime('ends_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('weeks', function (Blueprint $table) {
            //
        });
    }
}
