<?php

namespace App\Models;

use DateTime;
use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $key, string $value, string $value = null)
 * @method static whereBetween(string $string, array $array)
 *
 * @property int id
 * @property int parent_id
 * @property string name 名称
 * @property int|null p1 发布人
 * @property int|null p2 执行人
 * @property string|null product 产品
 * @property string description 任务说明
 * @property int|null status 状态
 * @property DateTime|null finish_at
 * @property DateTime|null created_at
 * @property DateTime|null updated_at
 * @property DateTime|null deleted_at
 */
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

    public function getP2Attribute($value)
    {
        $data = [];
        $user = User::pluck('name', 'id');
        foreach (explode(',', $value) as $v) {
            if (!empty($user[$v])) $data[] = $user[$v];
        }
        return implode(',', $data);
    }
}
