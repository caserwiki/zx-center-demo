<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $key, string $value1, string $value2 = null)
 * @method static pluck(string $text, string $id)
 *
 * @property int id
 * @property string name
 * @property string username
 * @property string|null depreciation_rule_id
 * @property string|null parent_id
 */
class User extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'admin_users';

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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function task_p1()
    {
        return $this->hasMany(Task::class, 'p1', 'id');
    }

    public function task_p2()
    {
        return $this->hasMany(Task::class, 'p2', 'id');
    }
}
