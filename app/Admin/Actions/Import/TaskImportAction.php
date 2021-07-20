<?php

namespace App\Admin\Actions\Import;

use App\Admin\Forms\TaskImportForm;
use Zx\Admin\Grid\Tools\AbstractTool;
use Zx\Admin\Widgets\Modal;

class TaskImportAction extends AbstractTool
{
    public function __construct()
    {
        parent::__construct();
        $this->title = admin_trans_field('imported');
    }

    /**
     * 渲染模态框.
     *
     * @return Modal
     */
    public function render(): Modal
    {
        return Modal::make()
            ->lg()
            ->body(new TaskImportForm())
            ->button("<button class=\"btn btn-primary btn-outline\">
        <i class=\"feather icon-share\"></i><span class=\"d-none d-sm-inline\">&nbsp;&nbsp;$this->title</span>
        <span class=\"filter-count\"></span>
    </button>");
    }
}
