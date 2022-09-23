<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitsberbagi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('nohp');
            $table->string('nominal');
            $table->string('status')->nullable();
            $table->string('invoice')->nullable();
            $table->string('code');
            $table->string('payment_url')->nullable();
            $table->string('method')->nullable();
            $table->bigInteger('paid')->nullable();
            $table->string('duitku_ref')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitsberbagi');
    }
};
