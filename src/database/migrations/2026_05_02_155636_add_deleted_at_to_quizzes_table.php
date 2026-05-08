<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // ▼ これを追加！論理削除用の deleted_at カラムを自動で作ってくれます
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // ▼ 戻す時用の処理
            $table->dropSoftDeletes();
        });
    }
};