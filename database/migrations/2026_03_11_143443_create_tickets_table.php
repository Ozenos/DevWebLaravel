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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ID');
            $table->string('title');
            $table->integer('time');
            $table->enum('advancement', ['Ouvert','En cours','Terminé'])->default('Ouvert');
            $table->enum('facturation', ['Inclus', 'Facturable'])->default(value: 'Inclus');
            $table->unsignedBigInteger('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
