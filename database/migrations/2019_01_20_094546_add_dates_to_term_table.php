<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToTermTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->dateTime('starts_at')->default($this->startOfWeek());
            $table->dateTime('ends_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('terms', function (Blueprint $table) {
            //
        });
    }

    private function startOfWeek()
    {
        $date = Carbon::now();

        return $date->startOfWeek();
    }
}
