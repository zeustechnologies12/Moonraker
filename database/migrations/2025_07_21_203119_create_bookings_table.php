<?php

use App\Enums\BookingStatusEnum;
use App\Models\Arena;
use App\Models\Field;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Field::class);
            $table->foreignIdFor(User::class);
            $table->enum('status', array_column(BookingStatusEnum::cases(), 'value'))
                ->default(BookingStatusEnum::Pending->value);
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
