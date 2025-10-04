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
        Schema::create('rooms_and_halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('room');
            $table->string('capacity')->default(1);
            $table->string('price')->default('20');
            $table->integer('floor')->required();
            $table->string('room_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_and_halls');
    }
};
