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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('noinv')->nullable();
            $table->string('nosj')->nullable();
            $table->string('nospk')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->default('Pending');
            $table->text('address')->nullable();
            $table->text('image')->nullable();
            $table->string('namapenerima')->nullable();
            $table->string('nohp')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
