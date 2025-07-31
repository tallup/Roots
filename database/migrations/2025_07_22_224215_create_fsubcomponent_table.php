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
        Schema::create('fsubcomponent', function (Blueprint $table) {
            $table->bigIncrements('subid');
            $table->string('subcomponent', 100);
            $table->string('sub_desc', 200);
            $table->decimal('allocation', 18, 2);
            $table->decimal('allocation_balance', 18, 2);
            $table->unsignedBigInteger('addedby');
            // No timestamps, as per model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsubcomponent');
    }
};
