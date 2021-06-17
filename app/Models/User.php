<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

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



    public function task_p1()
    {
        return $this->hasMany(Task::class, 'p1', 'id');
    }

    public function task_p2()
    {
        return $this->hasMany(Task::class, 'p2', 'id');
    }
}
