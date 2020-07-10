<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInstrumentsAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instruments', function (Blueprint $table) {
            $table->string('serial_number')->nullable()->comment('资产序列号');
            $table->tinyInteger('attributes')->nullable()->comment('资产属性');
            $table->date('purchase_time')->nullable()->comment('购买时间');
            $table->float('money')->nullable()->comment('购买金额');
            $table->string('tag')->nullable()->comment('资产标签');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instruments', function (Blueprint $table) {
            $table->dropColumn('serial_number');
            $table->dropColumn('attributes');
            $table->dropColumn('purchase_time');
            $table->dropColumn('money');
            $table->dropColumn('tag');
        });
    }
}
