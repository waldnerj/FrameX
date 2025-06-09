<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('watchlists', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);
            // Wir behalten die Spalte, nur ohne FK
        });
    }

    public function down()
    {
        Schema::table('watchlists', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }
};
