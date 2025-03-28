<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');          // имя типа формы
            $table->json('addionals')->nullable(); // json с конфигурацией полей формы
            $table->timestamps();            // created_at / updated_at
            $table->string('created_by');    // login пользователя, кто создал
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_types');
    }
};
