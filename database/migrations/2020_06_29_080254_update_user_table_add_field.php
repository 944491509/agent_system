<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->tinyInteger('gender')->comment('性别 1男 2女');
            $table->integer('mobile')->comment('手机号1');
            $table->integer('phone')->nullable()->comment('手机号2');
            $table->integer('group_cornet')->nullable()->comment('集团短号');
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
            $table->string('email')->change();

            $table->dropColumn('gender');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
            $table->dropColumn('group_cornet');
        });
    }
}
