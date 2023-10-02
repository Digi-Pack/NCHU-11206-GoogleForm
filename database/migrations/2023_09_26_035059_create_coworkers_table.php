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
        Schema::create('coworkers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('coworker_id')->comment('合作者id');
            $table->bigInteger('question_id')->comment('問卷id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coworkers');
    }
};
