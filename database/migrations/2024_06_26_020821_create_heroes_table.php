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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();

            //add column for title
            $table->string('title');

            //add column for subtitle
            $table->string('subtitle');

            //add column for link1
            $table->string('link1')->nullable();

            //add column for link2
            $table->string('link2')->nullable();

            //add isActive column
            $table->boolean('is_active')->default(false);

            //ini diperoleh dari identifikasi data yg ingin ditampilkan saat  landing page hero

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
