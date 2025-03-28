<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('full_name')->nullable();
            $table->string('name')->nullable();    // например, короткое имя
            $table->string('login')->unique();     // уникальный логин
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('avatar')->nullable();  // ссылка на аватар
            $table->timestamps();                  // created_at / updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
