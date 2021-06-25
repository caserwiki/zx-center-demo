<?php

namespace App\Admin\Controllers;

use Zx\Admin\Http\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    protected $view = 'admin.login';
}
