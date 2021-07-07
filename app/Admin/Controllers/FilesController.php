<?php

namespace App\Admin\Controllers;

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
        return Grid::make(new Files(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('product_id');
            $grid->column('task_id');
            $grid->column('type');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new Files(), function (Show $show) {
            $show->field('id');
            $show->field('name');
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
        return Form::make(new Files(), function (Form $form) {
            $form->display('id');
            if ($this->type > 0) {
                $form->hidden('type')->value($this->type);
                $form->image('name', '图片')
                    ->accept('jpg,png,gif,jpeg')
                    ->move(!empty($this->task_id) ? date('Y-m-d') . '/' . $this->task_id : date('Ymd'))
                    ->autoUpload()->downloadable();
            } else {
                $form->hidden('type')->value('0');
                $form->file('name', '附件')
                    ->accept('jpg,png,gif,jpeg,zip,gz,doc,docx,pptx,xls,xlsx,txt,psd')
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
