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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('month');
            $table->string('author_name');
            $table->boolean('is_pioneer')->default(false);
            
            // Horas se pioneiro, ou null se não
            $table->integer('hours')->nullable();

            // Tique se não pioneiro, ou null se pioneiro
            $table->boolean('hours_tick')->nullable();

            $table->integer('studies')->default(0);

            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
