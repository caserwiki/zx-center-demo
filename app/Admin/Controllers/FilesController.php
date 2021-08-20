<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SwitchGridView;
use App\Admin\Repositories\Files;
use Illuminate\Http\Request;
use Zx\Admin\Form;
use Zx\Admin\Grid;
use Zx\Admin\Show;
use Zx\Admin\Http\Controllers\AdminController;

class FilesController extends AdminController
{

    /**
     * 类型
     * @var mixed 关联项目
     */
    private $product_id;
    /**
     * @var mixed 关联工作
     */
    private $task_id;
    /**
     * @var mixed 类型
     */
    private $type;

    public function __construct(Request $request)
    {
        $this->product_id = $request->product_id ?? '0';
        $this->task_id = $request->task_id ?? '0';
        $this->type = $request->type ?? 0;
        // return $this;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $FilesModel = config('models.files_model');
        return Grid::make(new Files(), function (Grid $grid) use ($FilesModel) {
            if (request()->get('_view_') !== 'list') {
                // 设置自定义视图
                $grid->view('admin.files.index');

                $grid->setActionClass(Grid\Displayers\Actions::class);
            }
            $grid->tools([
                new SwitchGridView(),
            ]);

            $grid->column('id', __('ID'));

            $grid->column('name');
            $grid->column('path')->image('http://hoolai.local/uploads');
            $grid->column('product_id');
            $grid->column('task_id');
            $grid->column('suffix')->display(function () {
                return substr($this->path, strripos($this->path, '.') +1);
            });
            $grid->column('type')->using($FilesModel::$type)->label();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) use ($FilesModel) {
                // 展开过滤器
                $filter->expand();
                // 更改为 panel 布局
                $filter->panel();

                $filter->equal('type')->select($FilesModel::$type);
                $filter->where('suffix', function ($query) use ($FilesModel) {
                    if (!empty($this->input)) {
                        $suffix = $FilesModel::$suffix;
                        foreach ($this->input as $k => $v) {
                            $val = $suffix[$v];
                            if ($k == 0) {
                                $query->where('path', 'like', "%{$val}");
                            } else {
                                $query->orWhere('path', 'like', "%{$val}");
                            }
                        }
                    }
                })->multipleSelect($FilesModel::$suffix);
                $filter->between('created_at')->datetime();
            });
            $grid->quickSearch(['name', 'id']);
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
        return Show::make($id, new Files(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('path')->image('http://hoolai.local/uploads');
            $show->field('product_id');
            $show->field('task_id');
            $show->field('type');
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
        $FilesModel = config('models.files_model');
        return Form::make(new Files(), function (Form $form) use ($FilesModel) {
            $form->display('id');
            $form->text('name')->required();
            if ($this->type > 0) {
                $form->hidden('type')->value($this->type);
                $form->image('path', '图片')
                    ->accept(implode(',', $FilesModel::$type0))
                    ->move(!empty($this->task_id) ? date('Y-m-d') . '/' . $this->task_id : date('Ymd'))
                    ->autoUpload()->downloadable();
            } else {
                $form->hidden('type')->value('0');
                $form->file('path', '附件')
                    ->accept(implode(',', $FilesModel::$suffix))
                    ->move(!empty($this->task_id) ? date('Y-m-d') . '/' . $this->task_id : date('Ymd'))
                    ->autoUpload()->downloadable();
            }
            $form->hidden('product_id')->value($this->product_id);
            $form->hidden('task_id')->value($this->task_id);
            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form, $result) {
                if ($form->isCreating() && $form->task_id > 0) {
                    if (! $result) {
                        return $form->response()->error('数据保存失败');
                    }

                    return $form->response()->success('操作成功')->redirect('/task/' . $form->task_id);
                }

                return false;
            });
        });
    }
}
