<?php

namespace App\Admin\Controllers;

use App\Models\AdAd;
use App\Models\AdCampaign;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class AdAdController extends AdminController
{
    protected function title()
    {
        return trans('ad-ad.labels.AdAd');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $AdModel = config('models.ad_model');
        return Grid::make(AdAd::with('campaign'), function (Grid $grid) use ($AdModel) {
            $grid->column('id')->sortable();
            // $grid->column('account_id');
            // $grid->column('ad_id');
            $grid->column('campaign.name', trans('ad-ad.fields.campaign_name'))->label();
            $grid->column('name');
            $grid->column('status')->switch(true);
            $grid->column('delivery_range')->using($AdModel::$delivery_range);
            $grid->column('extra');
            $grid->column('union_video_type')->using($AdModel::$union_video_type)->label();
            // $grid->column('unique_fk')->copyable();

            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->quickSearch(['name']);

            $grid->filter(function (Grid\Filter $filter) use ($AdModel) {
                // 展开过滤器
                $filter->expand();
                // 更改为 panel 布局
                $filter->panel();

                $filter->like('name')->width(3);
                $filter->in('union_video_type')->multipleSelect($AdModel::$union_video_type);
            });

            $grid->enableDialogCreate();
            $grid->setDialogFormDimensions('50%', '70%');
            $grid->disableEditButton();
            $grid->showQuickEditButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, AdAd::with('campaign'), function (Show $show) {
            $AdModel = config('models.ad_model');
            $show->field('id');
            // $show->field('account_id');
            // $show->field('ad_id');
            $show->field('campaign.name', trans('ad-ad.fields.campaign_name'));
            $show->field('name');
            $show->field('status')->using(['关闭', '启用']);
            $show->field('delivery_range')->using($AdModel::$delivery_range);
            $show->field('extra');
            $show->field('union_video_type')->using($AdModel::$union_video_type);
            // $show->field('unique_fk');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(AdAd::with('campaign'), function (Form $form) {
            $AdModel = config('models.ad_model');

            $form->display('id');
            // $form->text('account_id');
            // $form->text('ad_id');
            $form->select('campaign_id')->options(function () {
                return AdCampaign::all()->pluck('name', 'id');
            })->required();
            $form->text('name')->required();
            $form->switch('status');
            $form->select('delivery_range')->options($AdModel::$delivery_range)->required();
            $form->textarea('extra')->disable();
            $form->select('union_video_type')->options($AdModel::$union_video_type)->required();
            // $form->text('unique_fk');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
