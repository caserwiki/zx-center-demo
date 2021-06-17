<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('名称');
            $table->tinyInteger('status')->default('0')->comment('广告组状态');
            $table->tinyInteger('landing_type')->default('0')->comment('广告组推广目的');
            $table->tinyInteger('budget_mode')->default('0')->comment('广告组预算类型');
            $table->integer('budget')->default('0')->comment('广告组预算');
            $table->tinyInteger('delivery_related_num')->default('0')->comment('广告组商品类型');
            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_campaign');
    }
}
