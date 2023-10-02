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
        Schema::table('questions', function (Blueprint $table) {
            // $table->string('name', 50)->change();
            $table->dateTime('modified_at')->nullable()->comment('表單修改日期')->change();
            $table->dateTime('other_modified')->nullable()->comment('協作者的表單修改日期')->change();
            $table->dateTime('opened_date')->nullable()->comment('表單上次開啟日期')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
};
