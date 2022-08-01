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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stack');
            $table->text('description');
        });

        Schema::create('wikis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('file_dir');
            $table->string('title');
            $table->longText('usage');
            $table->integer('views')->default(0);
            $table->dateTime('viewed_at')->nullable();
            $table->integer('downloads')->default(0);
            $table->dateTime('downloaded_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('wiki_id')->references('id')->on('wikis')->cascadeOnDelete();
            $table->tinyInteger('rating')->default(0);
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('wiki_id')->references('id')->on('wikis')->cascadeOnDelete();
            $table->longText('comment');
            $table->integer('vote')->default(0);
            $table->timestamps();
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('wiki_id')->references('id')->on('wikis')->cascadeOnDelete();
            $table->foreignId('comment_id')->references('id')->on('comments')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('wikis');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('votes');
    }
};
