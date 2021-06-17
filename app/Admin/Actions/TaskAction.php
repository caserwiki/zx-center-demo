<?php

namespace App\Admin\Actions;

use App\Admin\Forms\TaskForm;
use Zx\Admin\Grid\RowAction;
use Zx\Admin\Widgets\Modal;

class TaskAction extends RowAction
{
    public function __construct()
    {
        parent::__construct();
        $this->title = '<a href="#" style="cursor: pointer;"><i class="fa fa-fw feather icon-edit-1"></i>' . admin_trans_label('apend') . '</a>';
    }

    /**
     * 渲染模态框.
     *
     * @return Modal
     */
    public function render(): Modal
    {
        $form = TaskForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title(admin_trans_label('apend'))
            ->body($form)
            ->button($this->title);
    }
}
