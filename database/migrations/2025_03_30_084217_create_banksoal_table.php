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
        Schema::create('banksoal', function (Blueprint $table) {
            $table->id();
            $table->string('id_users');
            $table->text('soal');
            $table->string('jawabanA');
            $table->string('jawabanB');
            $table->string('jawabanC');
            $table->string('jawabanD');
            $table->enum('jawabanBenar', ["A", "B", "C", "D"]);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banksoal');
    }
};
