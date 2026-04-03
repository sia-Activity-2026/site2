<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users2', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20)->unique();
            $table->string('password', 60); // hashed password storage
            $table->string('gender', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users2');
    }
};
