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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // کد تخفیف
            $table->enum('type', ['percent', 'fixed'])->nullable();
            $table->decimal('value', 10, 2); // مقدار تخفیف
            $table->decimal('min_order_amount', 10, 2)->nullable(); // حداقل خرید
            $table->integer('usage_limit')->nullable(); // سقف تعداد استفاده
            $table->dateTime('start_date')->nullable(); // تاریخ شروع
            $table->dateTime('end_date')->nullable(); // تاریخ پایان
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
