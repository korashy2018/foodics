<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->morphs('stockable');
            $table->index('stockable_id');
            $table->index(['stockable_id', 'stockable_type']);
            $table->decimal('quantity', 10, 2);
            $table->string('unit_measure')->nullable(); //  grams, liters
            $table->boolean('is_countable')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropIndex(['stockable_id']);
            $table->dropIndex(['stockable_id', 'stockable_type']);
        });
    }
};
