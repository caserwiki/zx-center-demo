<?php

namespace App\Support;

use Zx\Admin\Admin;

class Support
{
    /**
     * 判断是否切换到selectCreate.
     *
     * @return bool
     */
    public static function ifSelectCreate(): bool
    {
        if (admin_setting('switch_to_select_create') && Admin::extension()->enabled('celaraze.zx-extension-plus')) {
            return true;
        } else {
            return false;
        }
    }
}
