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
        Schema::create('ballots', function (Blueprint $table) {
            $table->id('ballot_id');
            $table->string('ballot_name');
            $table->string('details');
            $table->string('ballot_key');
            $table->integer('publish_status')->defalt(0)->change();
            $table->integer('ballot_status')->default(0);
            $table->foreignId('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ballots');
    }
};
