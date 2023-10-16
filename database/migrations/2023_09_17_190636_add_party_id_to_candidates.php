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
        Schema::table('candidates', function (Blueprint $table) {
            $table->unsignedBigInteger('party_id')->nullable();
            $table->foreign('party_id')->references('party_id')->on('parties')->onDelete('cascade')->onUpdate('cascade');

            // $table->unsignedInteger('party_id');
            // $table->foreignId('party_id')->references('party_id')->on('parties')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
        });
    }
};
