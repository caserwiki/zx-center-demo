<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\TaskTable;
use App\Admin\Repositories\Task;
use App\Models\Product;
use App\Models\User;
use Zx\Admin\Admin;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class TaskController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $TaskModel = config('models.task_model');
        return Grid::make(Task::with(['belong_product', 'belong_p1', 'belong_p2']), function (Grid $grid) use ($TaskModel) {
            $grid->model()->where('parent_id', '=', 0);
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->column('name')->limit(50);
            $grid->column('belong_product.name', admin_trans_field('product'))->label();
            $grid->column('belong_p1.name', admin_trans_field('p1'))->label();
            $grid->column('belong_p2.name', admin_trans_field('p2'))->label();
            $grid->column('description')->display(function () {
                return <<<EOT
                    $this->description
                EOT;
            })->limit(50);
            $grid->column('status')->using($TaskModel::$status)->label(config('color.label'));
            $grid->column('记录', trans('task.options.log'))->display('记录')->expand(function () {
                return TaskTable::make(['parent_id' => $this->id]);
            });
            $grid->column('finish_at')->sortable();
            $grid->column('created_at')->sortable();
            $grid->column('updated_at')->sortable();

            $grid->selector(function (Grid\Tools\Selector $selector) use ($TaskModel) {
                $selector->select('status', $TaskModel::$status);
            });
            $grid->quickSearch(['name', 'id']);
            // $grid->enableDialogCreate(); // 弹窗创建表单
            // $grid->setDialogFormDimensions('50%', '70%'); // 弹窗尺寸
            // $grid->toolsWithOutline(false); // 工具栏按钮
            // $grid->disableRowSelector(); // 行选择器
            // $grid->setActionClass(Grid\Displayers\Actions::class); // 行操作按钮显示方式
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            // $grid->showQuickEditButton();
            $grid->disableViewButton();
            // $grid->disableActions(); // 行操作按钮

            if (Admin::user()->can('todo.record.export')) {
                $grid->export();
            }

            // $grid->actions(new \App\Admin\Actions\TaskAction());
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->row->status == 0) {
                    $actions->append(new \App\Admin\Actions\TaskAction());
                }
            });
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
        return Show::make($id, Task::with(['belong_product', 'belong_p1', 'belong_p2']), function (Show $show) {
            $TaskModel = config('models.task_model');

            $show->field('id');
            $show->field('name');
            $show->field('belong_product.name', admin_trans_field('product'));
            $show->field('belong_p1.name', admin_trans_field('p1'));
            $show->field('belong_p2.name', admin_trans_field('p2'));
            $show->field('description');
            $show->field('status')->using($TaskModel::$status);
            $show->field('finish_at');
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
        return Form::make(Task::with(['belong_product', 'belong_p1', 'belong_p2']), function (Form $form) {
            $form->display('id');
            // $form->select('parent_id', trans('admin.parent_id'))
            //     ->options(function () {
            //         return TaskModel::all()->where('parent_id', '=', 0)->pluck('name', 'id');
            //     });
            $form->text('name')->required();
            $form->select('product')->options(function () {
                return Product::all()->pluck('name', 'id');
            })->required();
            $form->select('p1')->options(function () {
                return User::all()->pluck('name', 'id');
            })->required();
            $form->select('p2')->options(function () {
                return User::all()->pluck('name', 'id');
            })->required();
            $form->editor('description')->required()->help('不要传超级大图');
            $form->datetime('finish_at')->required();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
