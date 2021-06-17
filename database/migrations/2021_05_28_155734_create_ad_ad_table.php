<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_ad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_id')->comment('广告组id');
            $table->string('name')->default('')->comment('计划名称');
            $table->tinyInteger('status')->comment('计划状态');
            $table->tinyInteger('delivery_range')->comment('投放范围');
            $table->tinyInteger('union_video_type')->comment('投放形式');
            $table->json('extra')->comment('投放目标参数')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_ad');
    }
}
