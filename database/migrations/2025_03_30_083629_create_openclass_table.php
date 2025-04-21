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
        Schema::create('openclass', function (Blueprint $table) {
            $table->id();
            $table->string('id_dosen');
            $table->string('name');
            $table->string('code');
            $table->datetime('start');
            $table->datetime('end');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('openclass');
    }
};
