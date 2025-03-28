<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            // login - как FK (foreign key) на users(login)
            // Можно хранить user_id, но по условию нужно хранить login
            $table->string('login');
            $table->string('type');      // тип документа
            $table->string('file_name'); // имя файла (пусть будет путь к XML)
            $table->timestamps();        // created_at / updated_at

            // Опционально: если хотим связать login с users(login) на уровне БД
            // $table->foreign('login')->references('login')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
