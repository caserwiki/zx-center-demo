<?php

use Zx\Admin\Admin;
use Zx\Admin\Grid;
use Zx\Admin\Form;
use Zx\Admin\Grid\Column\Help;
use Zx\Admin\Grid\Filter;
use Zx\Admin\Show;
use Zx\Admin\Layout\Navbar;
use Zx\Admin\Repositories\Repository;
use App\Admin\Repositories\Task;
use App\Admin\Repositories\Weather;

/**
 * Zx-center - admin builder based on Laravel.
 * @author zx <https://github.com/caserwiki>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Zx\Admin\Form::extend('php', PHPEditor::class);
 * Zx\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Zx\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use itbdw\Ip\IpLocation;

// 覆盖默认配置
config(['admin' => user_admin_config()]);
config(['app.locale' => config('admin.lang') ?: config('app.locale')]);

Admin::style('.main-sidebar .nav-sidebar .nav-item>.nav-link {
    border-radius: .1rem;
}');

// 扩展Column
Grid\Column::extend('code', function ($v) {
    return "<code>$v</code>";
});

Grid::resolving(function (Grid $grid) {
    if (! request('_row_')) {
        $grid->tableCollapse();

//        $grid->tools(new App\Admin\Grid\Tools\SwitchGridMode());
    }
});

Admin::navbar(function (Navbar $navbar) {
    $method = config('admin.layout.horizontal_menu') ? 'left' : 'right';

    // ajax请求不执行
    if (! Zx\Admin\Support\Helper::isAjaxRequest()) {
        $navbar->$method(App\Admin\Actions\AdminSetting::make()->render());
    }

    $task = !empty(Admin::User()->id) ? Task::completionRate(0, 0, Admin::User()->id) : '';

    $weather = Weather::getWeather();

    // 下拉面板
    $navbar->right(view('admin.navbar-1')->with('task', $task)->with('weather', $weather));
});
