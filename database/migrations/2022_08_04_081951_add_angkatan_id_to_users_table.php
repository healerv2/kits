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
        Schema::table('users', function (Blueprint $table) {
            //
             $table->unsignedBigInteger('angkatan_id')->after('level')->nullable();
            /** foreignkey */
            $table->foreign('angkatan_id')
            ->references('id')
            ->on('angkatan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            /** end foreignkey */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['angkatan_id']);
            $table->dropColumn('angkatan_id');
        });
    }
};
