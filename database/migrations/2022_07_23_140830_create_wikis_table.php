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
        Schema::create('wikis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('type', ['wiki', 'blog', 'forum']);
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('title');
            $table->text('overview');
            $table->longText('contents');
            $table->integer('views')->default(0);
            $table->timestamp('viewed_at')->nullable();
            $table->integer('downloads')->default(0);
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wikis');
    }
};
