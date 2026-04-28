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
        Schema::create('choices', function (Blueprint $table) {
    $table->id();
    // 外れ値制約：questionsテーブルと紐付け
    $table->foreignId('question_id')->constrained()->cascadeOnDelete();
    $table->string('text')->comment('選択肢のテキスト');
    $table->boolean('is_correct')->default(false)->comment('正解フラグ');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
