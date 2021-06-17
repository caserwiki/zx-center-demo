<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Product;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('total_task')->display(function () {
                return Product::completionTotal($this->id);
            });
            $grid->column('finish_task')->display(function () {
                return Product::completionTotal($this->id, 1);
            });
            $grid->column('rate')/*->progressBar()*/->display(function () {
                $rate = Product::completionRate($this->id);
                $color_conf = config('color.label.0');
                return <<<EOT
                <div class="shadow-100 progress primary" style="height:0.8rem;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{$rate}" aria-valuemin="0" aria-valuemax="100" style="width:{$rate}%; background-color:{$color_conf};"></div>
                </div>{$rate}%
                EOT;
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->quickSearch(['id', 'name']);

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
        return Show::make($id, new Product(), function (Show $show) {
            $show->field('id');
            $show->field('name');
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
        return Form::make(new Product(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
