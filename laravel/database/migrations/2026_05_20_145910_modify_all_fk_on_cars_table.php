<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {

            // COLOR_ID
            $table->dropForeign(['color_id']);
            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->onDelete('restrict');

            // YEAR_ID
            $table->dropForeign(['year_id']);
            $table->foreign('year_id')
                  ->references('id')->on('years')
                  ->onDelete('restrict');

            // DESIGNER_ID
            $table->dropForeign(['designer_id']);
            $table->foreign('designer_id')
                  ->references('id')->on('designers')
                  ->onDelete('restrict');

            // SERIES_ID
            $table->dropForeign(['series_id']);
            $table->foreign('series_id')
                  ->references('id')->on('series')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
