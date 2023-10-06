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
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('mention_id_1')->nullable(); // 新しいカラムを nullable に設定
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('mention_id_2')->nullable(); // 新しいカラムを nullable に設定
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('mention_id_3')->nullable(); // 新しいカラムを nullable に設定
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('mention_id_1');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('mention_id_2');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('mention_id_3');
        });
    }
};
