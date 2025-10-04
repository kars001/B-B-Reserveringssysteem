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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained('rooms_and_halls')->onDelete('set null');
            $table->string('guest_name');
            $table->string('reservation_type');
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->decimal('rooms_amount')->nullable();
            $table->enum('layout', ['u-vorm', 'blok', 'school', 'carre', 'cabaret', 'theater', 'other'])->default('other');
            $table->text('extra_info')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
