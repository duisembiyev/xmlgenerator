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
            $table->string('type');
            $table->json('addionals')->nullable();
            $table->timestamps();
            $table->string('created_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_types');
    }
};
