<?php

namespace App\Admin\Renderable;

use App\Models\Task;
use Zx\Admin\Support\LazyRenderable;
use Zx\Admin\Widgets\Table;

class TaskTable extends LazyRenderable
{
    public function render()
    {
        // 获取ID
        $parent_id = $this->parent_id;

        $data = Task::where('parent_id', $parent_id)
            ->get(['description', 'created_at'])
            ->toArray();

        /*$titles = [
            'description' => trans('task.fields.description'),
            'created_at' => trans('global.fields.created_at'),
        ];*/

        return Table::make([], $data);
    }
}
