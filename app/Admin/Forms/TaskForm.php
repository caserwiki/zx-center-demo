<?php

namespace App\Admin\Forms;

use App\Models\Task;
use Zx\Admin\Contracts\LazyRenderable;
use Zx\Admin\Http\JsonResponse;
use Zx\Admin\Traits\LazyWidget;
use Zx\Admin\Widgets\Form;
use Exception;

class TaskForm extends Form implements LazyRenderable
{
    use LazyWidget;

    /**
     * 处理表单提交逻辑.
     *
     * @param array $input
     *
     * @return JsonResponse
     */
    public function handle(array $input): JsonResponse
    {
        $id = $this->payload['id'] ?? null;
        $description = $input['description'] ?? null;
        $status = $input['status'] ?? null;

        if (empty($id) || empty($description)) {
            return $this->response()
                ->error(trans('global.options.parameter_missing'));
        }

        try {
            $parent = Task::where('id', $id)->first();
            if (empty($parent)) {
                return $this->response()
                    ->error(trans('global.options.record_none'));
            }
            if ($status > 0) {
                $parent->status = $status;
                $parent->save();
            }

            $new = new Task();
            $new->description = $description;
            $new->p1 = $parent->p1;
            $new->p2 = $parent->p2;
            $new->parent_id = $id;
            $new->product = $parent->product;
            $new->save();
            $return = $this
                ->response()
                ->success(trans('main.success'))
                ->refresh();
        } catch (Exception $e) {
            $return = $this
                ->response()
                ->error(trans('main.fail') . $e->getMessage());
        }

        return $return;
    }

    /**
     * 构造表单.
     */
    public function form()
    {
        $this->select('status')->options(Task::$status)->default(0)->help('已完成或关闭视为本工作任务结束, 后续不可跟进');
        $this->editor('description')->required()->help('不要传超级大图');
    }
}
