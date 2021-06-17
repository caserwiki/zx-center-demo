<?php

namespace App\Admin\Repositories;

use App\Models\Product as Model;
use App\Models\Task;
use Zx\Admin\Repositories\EloquentRepository;

class Product extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public static function completionRate($id = 0, $status = '')
    {
        $query = Task::selectRaw("(COUNT(DISTINCT IF(status=1,id,NULL)) / COUNT(*)) as exp")
            ->where('parent_id', 0);
        if ($id > 0) $query->where('product', $id);
        if ($status != '') $query->where('status', $status);
        $data = $query->first()->toArray();
        return ($data['exp'] * 100);
    }

    public static function completionTotal($id = 0, $status = '')
    {
        $query = Task::selectRaw("COUNT(*) as exp")
            ->where('parent_id', 0);
        if ($id > 0) $query->where('product', $id);
        if ($status != '') $query->where('status', $status);
        $data = $query->first()->toArray();
        return ($data['exp']);
    }
}
