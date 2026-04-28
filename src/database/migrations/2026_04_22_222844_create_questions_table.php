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
        Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->string('image')->nullable()->comment('設問画像');
    $table->string('text')->comment('設問内容');
    $table->string('supplement')->nullable()->comment('設問補足');
    // 外れ値制約：quizzesテーブルと紐付け
    $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
