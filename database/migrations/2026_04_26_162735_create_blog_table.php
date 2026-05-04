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
        Schema::create('blog', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive' ,'waiting'])->default('waiting');
            $table->string('body');
            $table->string('short_desc');
            $table->timestamps();

            $table->foreign('category_id')->references('id')
                ->on('category')->onDelete('cascade');

            $table->foreign('author_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
