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
        Schema::create('questions', function (Blueprint $table) {
            $table->id()->comment('表單id');
            $table->timestamps();
            $table->date('modified_at')->nullable()->comment('表單修改日期');
            $table->date('other_modified')->nullable()->comment('協作者的表單修改日期');
            $table->date('opened_date')->nullable()->comment('表單上次開啟日期');
            $table->bigInteger('lead_author_id')->comment('主編者ID');
            $table->string('qu_naires_title')->nullable()->default('')->comment('表單標題');
            $table->string('qu_naires_desc')->nullable()->default('')->comment('表單說明');
            $table->longText('questionnaires')->nullable()->default('')->comment('問題');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
