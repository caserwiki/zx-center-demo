<?php

namespace App\Admin\Renderable;

use App\Models\AdAd;
use Zx\Admin\Support\LazyRenderable;
use Zx\Admin\Traits\LazyWidget;
use Zx\Admin\Grid;
// use Zx\Admin\Widgets\Table;

class AdTable extends LazyRenderable
{
    use LazyWidget; // 使用异步加载功能

    public function render()
    {
        //$data = AdAd::where('campaign_id', $this->payload['key'])->select('id', 'name', 'status', 'union_video_type', 'extra')->get()->toArray();

        // return Table::make(['name', 'status', 'union_video_type', 'extra'], $data);

        return Grid::make(AdAd::with('campaign'), function (Grid $grid) {
            $AdModel = config('models.ad_model');

            $grid->column('id')->sortable();
            $grid->column('campaign.name', trans('ad-ad.fields.campaign_name'))->label();
            $grid->column('name');
            $grid->column('status')->switch(true);
            $grid->column('delivery_range')->using($AdModel::$delivery_range);
            $grid->column('extra');
            $grid->column('union_video_type')->using($AdModel::$union_video_type)->label();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            // 禁用刷新按钮
            $grid->disableRefreshButton();
            // 禁用创建按钮
            $grid->disableCreateButton();
            // 禁用行选择器
            $grid->disableRowSelector();
            // 禁用行操作按钮
            $grid->disableActions();
        });
    }
}
