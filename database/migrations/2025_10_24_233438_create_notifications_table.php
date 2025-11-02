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
        Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->string('message');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // User yg beli
        $table->foreignId('ticket_id')->nullable()->constrained()->onDelete('set null'); // Tiket yg dibeli
        $table->boolean('is_read')->default(false); // Status notifikasi
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
