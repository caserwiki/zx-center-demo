<?php

namespace Zx\Admin\OperationLog;

use Zx\Admin\Extend\ServiceProvider;
use Zx\Admin\OperationLog\Http\Middleware\LogOperation;

class OperationLogServiceProvider extends ServiceProvider
{
    protected $middleware = [
        'middle' => [
            LogOperation::class,
        ],
    ];

    protected $menu = [
        [
            'title' => 'Operation Log',
            'uri'   => 'auth/operation-logs',
        ],
    ];

    public function settingForm()
    {
        return new Setting($this);
    }
}
