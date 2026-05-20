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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('toy_code');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('years');
            $table->unsignedBigInteger('designer_id');
            $table->foreign('designer_id')->references('id')->on('designers');
            $table->unsignedBigInteger('series_id');
            $table->foreign('series_id')->references('id')->on('series');
            $table->string('notes');
            /*$table->dropColumn('extras');*/ /*át lett alakítva*/
            $table->boolean('isPacked')->defaul(true);
            $table->string('img_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
