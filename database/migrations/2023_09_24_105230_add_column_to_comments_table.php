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
            $table->text('mention_id_body_1')->nullable();
            $table->text('mention_id_body_2')->nullable();
            $table->text('mention_id_body_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
        $table->dropColumn('mention_id_body_1');
        $table->dropColumn('mention_id_body_2');
        $table->dropColumn('mention_id_body_3');
        });
    }
};
