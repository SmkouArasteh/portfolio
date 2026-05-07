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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_url')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('is_indexed')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
