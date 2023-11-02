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
        Schema::create('votes', function (Blueprint $table) {
            $table->id('vote_id');
            $table->foreignId('voters_id')->references('voters_id')->on('voters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ballot_id')->references('ballot_id')->on('ballots')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('vote_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
