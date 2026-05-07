<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('title');
            $table->string('email')->nullable()->after('bio');
            $table->string('phone')->nullable()->after('email');
            $table->string('position')->nullable()->after('phone'); // سمت یا موقعیت شغلی
            $table->date('birth_date')->nullable()->after('position');
            $table->string('resume')->nullable()->after('birth_date'); // مسیر فایل رزومه
        });
    }

    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'email',
                'phone',
                'position',
                'birth_date',
                'resume',
            ]);
        });
    }
};