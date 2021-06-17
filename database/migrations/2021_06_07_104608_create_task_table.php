<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product')->default('0')->comment('产品');
            $table->string('name')->default('')->comment('名称');
            $table->text('description')->comment('任务描述');
            $table->integer('p1')->default('0')->comment('发布人');
            $table->integer('p2')->default('0')->comment('执行人');
            $table->unsignedInteger('parent_id')->default('0');
            $table->unsignedTinyInteger('status')->default('0')->comment('状态');
            $table->timestamp('finish_at')->nullable()->comment('完成时间');
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
        Schema::dropIfExists('task');
    }
}
