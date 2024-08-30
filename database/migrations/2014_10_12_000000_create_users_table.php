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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint unsigned primary key, auto_increment
            $table->string('prefixname')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffixname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->text('photo')->nullable();
            $table->string('type')->default('user')->index();
            $table->rememberToken(); // varchar(100) nullable
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps(); // created_at and updated_at (both nullable)
            $table->softDeletes(); // deleted_at timestamp nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
