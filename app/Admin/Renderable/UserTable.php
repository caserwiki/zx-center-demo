<?php

namespace App\Admin\Renderable;

use Zx\Admin\Grid;
use Zx\Admin\Grid\LazyRenderable;
use Zx\Admin\Models\Administrator;

class UserTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;

        return Grid::make(new Administrator(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('username');
            $grid->column('name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->quickSearch(['id', 'username', 'name']);

            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('username')->width(4);
                $filter->like('name')->width(4);
            });
        });
    }
}
