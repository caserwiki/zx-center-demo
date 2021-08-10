<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    public static $type = ['0' => '文件', '1' => '图片'];
    public static $suffix = [
        'jpg',
        'png',
        'gif',
        'jpeg',
        'zip',
        'gz',
        'doc',
        'docx',
        'pptx',
        'csv',
        'xls',
        'xlsx',
        'txt',
        'psd',
    ];

    public static $type0 = [
        'jpg',
        'png',
        'gif',
        'jpeg',
    ];

    protected $table = 'files';
}
