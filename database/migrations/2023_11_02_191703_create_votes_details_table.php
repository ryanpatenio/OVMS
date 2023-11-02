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
        Schema::create('votes_details', function (Blueprint $table) {
            $table->id('vote_details_id');
            $table->foreignId('vote_id')->references('vote_id')->on('votes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('candidate_id')->references('candidate_id')->on('candidates')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes_details');
    }
};
