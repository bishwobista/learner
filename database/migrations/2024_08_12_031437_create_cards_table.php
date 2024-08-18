<?php

use App\CardType;
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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer');
            $table->foreignId('deck_id')->constrained()->onDelete('cascade');
            $table->float('ef')->default(2.5);
            $table->integer('interval')->default(1);
            $table->integer('repetitions')->default(0);
            $table->timestamp('next_review_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
