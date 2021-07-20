<?php

namespace App\Admin\Forms;

use App\Models\User;
use App\Models\Task;
use App\Models\Product;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use League\Flysystem\FileNotFoundException;
use Zx\Admin\Http\JsonResponse;
use Zx\Admin\Widgets\Form;
use Exception;
use Zx\EasyExcel\Excel;

class TaskImportForm extends Form
{
    /**
     * 处理表单提交逻辑.
     *
     * @param array $input
     *
     * @return JsonResponse
     */
    public function handle(array $input): JsonResponse
    {
        $file = $input['file'];
        $file_path = public_path('uploads/' . $file);

        $success = 0;
        $fail = 0;

        try {
            $rows = Excel::import($file_path)->first()->toArray();
            foreach ($rows as $row) {
                try {
                    if (empty($row['名称']) || empty($row['项目']) || empty($row['发布人']) || empty($row['执行人']) || empty($row['描述']) || empty($row['计划完成'])) {
                        $fail++;
                        continue;
                    }
                    $product = Product::query()->where('name', $row['项目'])->first();
                    if (empty($product)) {
                        $fail++;
                        continue;
                    }
                    $users = User::pluck('id', 'name');
                    if (empty($users[$row['发布人']])) {
                        $fail++;
                        continue;
                    }
                    $p2 = explode(',', $row['执行人']);
                    foreach ($p2 as &$v) {
                        if (empty($users[$v])) {
                            $fail++;
                            continue 2;
                        }
                        $v = $users[$v];
                    }

                    $task = new Task();
                    $task->name = $row['名称'];
                    $task->p1 = $users[$row['发布人']];
                    $task->p2 = implode(',', $p2);
                    $task->product = $product->id;
                    $task->description = $row['描述'];
                    $task->finish_at = $row['计划完成'];
                    if (!empty($row['创建时间'])) $task->created_at = $row['创建时间'];
                    if (!empty($row['更新时间'])) $task->updated_at = $row['更新时间'];
                    $task->save();

                    $success++;
                } catch (Exception $e) {
                    $fail++;
                }
            }
            $return = $this->response()
                ->success(trans('main.success') . ': ' . $success . ' ; ' . trans('main.fail') . ': ' . $fail)
                ->refresh();
        } catch (FileNotFoundException $e) {
            $return = $this->response()
                ->error(trans('file.options.file_none') . $e->getMessage());
        } catch (IOException $e) {
            $return = $this
                ->response()
                ->error(trans('file.options.file_io_error') . $e->getMessage());
        } catch (UnsupportedTypeException $e) {
            $return = $this->response()
                ->error(trans('file.options.file_format') . $e->getMessage());
        }

        return $return;
    }

    /**
     * 构造表单.
     */
    public function form()
    {
        $this->file('file')
            ->accept('xlsx,csv')
            ->autoUpload()
            ->uniqueName()
            ->required()
            ->help(admin_trans_label('File Help'));
    }
}
