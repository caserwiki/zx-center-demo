<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'product';

    public function task_product()
    {
        return $this->hasMany(Task::class, 'product', 'id');
    }
}
