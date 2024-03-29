<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Import\TaskImportAction;
use App\Admin\Actions\TaskAction;
use App\Admin\Renderable\TaskTable;
use App\Admin\Renderable\UserTable;
use App\Admin\Repositories\Task;
use App\Models\Product;
use App\Models\Task as TaskModel;
use App\Models\User;
use App\Models\Files;
use Zx\Admin\Layout\Content;
use Zx\Admin\Grid\Tools;
use Zx\Admin\Admin;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class TaskController extends AdminController
{
    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        Admin::css(['/static/css/task_show.css',]);
        $task = TaskModel::query()->find($id);
        $task = $task->toArray();
        $task['description'] = trim($task['description'], '"');
        $data = [
            'data' => $task,
            'events' => TaskModel::query()->where('parent_id', '=', $id)->get(),
            'users' => User::all()->keyBy('id')->toArray(),
            'files' => Files::query()->where('task_id', '=', $id)->get(),
        ];
        return $content
            ->title(admin_trans_label('task'))
            ->description('ID:' . $id)
            ->body(view('admin/task/show', $data));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $TaskModel = config('models.task_model');
        return Grid::make(Task::with(['belong_product', 'belong_p1'/*, 'belong_p2'*/]), function (Grid $grid) use ($TaskModel) {
            $grid->model()->where('parent_id', '=', 0);
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->column('name')->limit(50);
            $grid->column('belong_product.name', admin_trans_field('product'))->label();
            $grid->column('belong_p1.name', admin_trans_field('p1'))->link(function ($value) {
                return admin_url('auth/roles/' . $this->p1);
            });
            $grid->column('p2')->label('primary', 3);
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

            // $grid->selector(function (Grid\Tools\Selector $selector) use ($TaskModel) {
            //     $selector->select('p2', json_decode(User::pluck('name', 'id'), true));
            //     $selector->select('status', $TaskModel::$status);
            // });
            $grid->filter(function (Grid\Filter $filter) use ($TaskModel) {
                // 展开过滤器
                $filter->expand();
                // 更改为 panel 布局
                $filter->panel();

                $filter->equal('status')->select($TaskModel::$status);
                $filter->in('p2')->multipleSelect(json_decode(User::pluck('name', 'id'), true));
                $filter->between('created_at')->datetime();
            });
            $grid->quickSearch(['name', 'id']);
            // $grid->enableDialogCreate(); // 弹窗创建表单
            // $grid->setDialogFormDimensions('50%', '70%'); // 弹窗尺寸
            // $grid->toolsWithOutline(false); // 工具栏按钮
            // $grid->disableRowSelector(); // 行选择器
            // $grid->setActionClass(Grid\Displayers\Actions::class); // 行操作按钮显示方式
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            // $grid->disableViewButton();
            // $grid->showQuickEditButton();
            // $grid->disableActions(); // 行操作按钮

            /**
             * 导出
             */
            $titles = [
                'name' => admin_trans_field('name'),
                'belong_product.name' => admin_trans_field('product'),
                'belong_p1.name' => admin_trans_field('p1'),
                'p2' => admin_trans_field('p2'),
                'description' => admin_trans_field('description'),
                'status' => admin_trans_field('status'),
                'finish_at' => admin_trans_field('finish_at'),
                'created_at' => admin_trans_field('created_at'),
                'updated_at' => admin_trans_field('updated_at'),
            ];
            $grid->export($titles)->rows(function (array $rows) use ($TaskModel) {
                $status = $TaskModel::$status;
                foreach ($rows as $index => &$row) {
                    $row['status'] = $status[$row['status']];
                }

                return $rows;
            })->xlsx();

            if (Admin::user()->can('task.task.export')) {
                $grid->export();
            }

            /**
             * 新建
             */
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->row->status == 0) {
                    $actions->append(new TaskAction());
                }
            });

            /**
             * 导入按钮.
             */
            $grid->tools(function (Tools $tools) {
                // @permissions
                if (Admin::user()->can('task.task.export')) {
                    $tools->append(new TaskImportAction());
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
            $form->display('parent_id');
            // $form->select('parent_id', trans('admin.parent_id'))
            //     ->options(function () {
            //         return TaskModel::all()->where('parent_id', '=', 0)->pluck('name', 'id');
            //     });
            $form->text('name')->required();
            $form->select('product')->options(function () {
                return Product::all()->pluck('name', 'id');
            })->required();
            $form->select('p1')->options(User::pluck('name', 'id'))->required();
            $form->multipleSelectTable('p2')
                ->title('p2')
                ->max(4)
                ->from(UserTable::make(['id' => $form->getKey()]))
                ->model(User::class, 'id', 'name')
                ->saving(function ($value) {
                    // 转化为json格式存储
                    // return json_encode($value);
                    return implode(',', $value);
                })->required();
            $form->editor('description')->required()->help('不要传超级大图');
            $form->datetime('finish_at')->required();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
