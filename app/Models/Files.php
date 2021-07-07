<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'files';
}
