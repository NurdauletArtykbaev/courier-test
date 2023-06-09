<?php

use App\Helpers\OrderStatusHelper;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_city_id')->nullable()->constrained('cities')->cascadeOnDelete();
            $table->foreignId('to_city_id')->nullable()->constrained('cities')->cascadeOnDelete();
            $table->timestamp('delivery_date');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('status')->default(OrderStatusHelper::NEW);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
