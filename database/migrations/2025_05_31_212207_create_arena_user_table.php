<?php

use App\Models\Arena;
use App\Models\User;
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
        Schema::create('arena_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Arena::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.r
     */
    public function down(): void
    {
        Schema::dropIfExists('arena_user');
    }
};
