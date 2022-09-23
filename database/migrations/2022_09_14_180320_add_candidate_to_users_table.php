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
            $table->unsignedBigInteger('kandidat_id')->after('detail_aktivitas')->nullable();
            /** foreignkey */
            $table->foreign('kandidat_id')
            ->references('id')
            ->on('kandidat')
            ->cascadeOnUpdate()->nullOnDelete();
            /** end foreignkey */

             $table->enum('status_voting',['BELUM','SUDAH'])->after('kandidat_id');
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
            $table->dropForeign(['kandidat_id']);
            $table->dropColumn('kandidat_id');
            $table->dropColumn('status_voting');
        });
    }
};
