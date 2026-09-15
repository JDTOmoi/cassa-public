<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // public $timestamps = false;

    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('sku');
            // $table->string('brand');
            $table->unsignedBigInteger('brand');
            $table->foreign('brand')
            ->references('id')
            ->on('brands')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->string('tags');
            $table->string('description');
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
