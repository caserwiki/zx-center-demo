<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'task';

    public static $status = ['0' => '未完成', '1' => '已完成', '2' => '关闭'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.center') ?: config('database.default');

        $this->setConnection($connection);

        // $this->setTable(config('admin.database.roles_table'));

        parent::__construct($attributes);
    }

    public function belong_product()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }
    public function belong_p1()
    {
        return $this->belongsTo(User::class, 'p1', 'id');
    }
    public function belong_p2()
    {
        return $this->belongsTo(User::class, 'p2', 'id');
    }
}
