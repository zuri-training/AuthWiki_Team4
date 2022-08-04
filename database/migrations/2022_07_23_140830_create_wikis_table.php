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
            $table->string('stack');
            $table->text('file_dir');
            $table->string('title');
            $table->longText('content');
            $table->integer('views')->default(0);
            $table->dateTime('viewed_at')->nullable();
            $table->integer('downloads')->default(0);
            $table->dateTime('downloaded_at')->nullable();
            $table->softDeletes();
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
