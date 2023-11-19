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
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('profile')->nullable();
            $table->unsignedBigInteger('opportunity_id');
            $table->foreign('opportunity_id')
                  ->references('id')
                  ->on('opportunities')
                  ->onDelete('cascade');
            $table->tinyInteger('level');
            $table->integer('experience')->nullable();
            $table->string('contact_info');
            $table->integer('age')->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
