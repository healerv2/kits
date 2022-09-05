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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('level');
            $table->string('foto')->nullable();
            $table->string('status_akun')->nullable();
            $table->string('status')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->text('detail_alamat')->nullable();
            $table->string('aktivitas')->nullable();
            $table->text('detail_aktivitas')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
