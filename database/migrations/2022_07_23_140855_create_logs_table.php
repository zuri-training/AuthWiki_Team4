<?php

use Illuminate\{
    Database\Migrations\Migration,
    Database\Schema\Blueprint,
    Support\Facades\Schema
};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('wiki_id')->nullable()->references('id')->on('wikis')->nullOnDelete();
            $table->foreignId('comment_id')->nullable()->references('id')->on('comments')->nullOnDelete();
            $table->foreignId('file_id')->nullable()->references('id')->on('files')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
