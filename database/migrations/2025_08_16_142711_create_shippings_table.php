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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // مثل پست پیشتاز، تیپاکس، حضوری
            $table->decimal('cost', 10, 2); // هزینه ارسال
            $table->integer('delivery_time')->nullable(); // زمان تحویل (مثلا 3 روز)
            $table->string('description')->nullable(); // توضیحات
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
