<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->renameColumn('eat_at_home', 'eat_evening_at_home');
            $table->boolean('eat_midday_at_home')->after('eat_at_home');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->renameColumn('eat_evening_at_home', 'eat_at_home');
            $table->dropColumn('eat_midday_at_home');

        });
    }
};
