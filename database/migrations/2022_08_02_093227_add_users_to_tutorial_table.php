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
        Schema::table('tutorial', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('users_id')->after('id')->nullable();
            /** foreignkey */
            $table->foreign('users_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            /** end foreignkey */

            $table->unsignedBigInteger('kategori_id')->after('users_id')->nullable();
            /** foreignkey */
            $table->foreign('kategori_id')
            ->references('id')
            ->on('kategori')
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
        Schema::table('tutorial', function (Blueprint $table) {
            //
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
