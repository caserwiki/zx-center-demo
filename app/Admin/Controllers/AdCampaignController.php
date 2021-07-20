<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\AdTable;
use App\Models\AdCampaign;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class AdCampaignController extends AdminController
{
    protected function title()
    {
        return trans('ad-campaign.labels.AdCampaign');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(AdCampaign::with('ads'), function (Grid $grid) {
            $AdCampaignModel = config('models.campaign_model');

            $grid->column('id')->sortable();
            $grid->column('name')->filter(
                Grid\Column\Filter\Like::make()
            )->editable(true);
            $grid->column('status')->switch(true);
            $grid->column('budget_mode')->select($AdCampaignModel::$budget_mode, true);
            $grid->column('budget')->editable(true)->sortable();
            $grid->column('landing_type')->select($AdCampaignModel::$landing_type, true);
            $grid->column('delivery_related_num')->select($AdCampaignModel::$delivery_related_num, true);
            $grid->column('ext')->display('广告计划')->expand(AdTable::make());

            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->quickSearch(['name']);

            $grid->selector(function (Grid\Tools\Selector $selector) use ($AdCampaignModel) {
                $selector->select('budget_mode', $AdCampaignModel::$budget_mode);
                $selector->select('landing_type', $AdCampaignModel::$landing_type);
                $selector->select('budget', ['0-100', '101-200', '201-300'], function ($query, $value) {
                    $between = [
                        [0, 100],
                        [101, 200],
                        [201, 300],
                    ];

                    $value = current($value);

                    $query->whereBetween('budget', $between[$value]);
                });
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
        $AdCampaignModel = config('models.campaign_model');
        return Show::make($id, new AdCampaign, function (Show $show) use ($AdCampaignModel) {
            $show->field('id');
            $show->field('name');
            $show->field('status')->using(['关闭', '启用']);
            $show->field('budget_mode')->using($AdCampaignModel::$budget_mode);
            $show->field('budget');
            $show->field('landing_type')->using($AdCampaignModel::$landing_type);
            $show->field('delivery_related_num')->using($AdCampaignModel::$delivery_related_num);
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
        $AdCampaignModel = config('models.campaign_model');
        return Form::make($AdCampaignModel, function (Form $form) use ($AdCampaignModel) {
            $form->display('id');
            $form->text('name')->required()->placeholder(trans('ad-campaign.name'));
            $form->switch('status');
            $form->radio('budget_mode')->options($AdCampaignModel::$budget_mode)->required();
            $form->text('budget')->required();
            $form->select('landing_type')->options($AdCampaignModel::$landing_type)->required();;
            $form->radio('delivery_related_num')->options($AdCampaignModel::$delivery_related_num)->required();

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }
}
