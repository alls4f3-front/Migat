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
        Schema::create('religious_tours', function (Blueprint $table) {
            $table->id();
            $table->string('share_tour');
            $table->text('description');
            $table->string('image');
            $table->string('phone');
            $table->string('email');
            $table->string('whatsapp')->nullable();
            $table->decimal('price', 10, 2);
            $table->text('what_will_you_do');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('religious_tours');
    }
};
