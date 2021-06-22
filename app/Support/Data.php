<?php

namespace App\Support;

class Data
{
    /**
     * 返回控制器图标.
     *
     * @param $string
     *
     * @return string
     */
    public static function icon($string): string
    {
        $array = [
            'record' => '<i class="fa feather icon-list"></i> ',
            'category' => '<i class="fa feather icon-pie-chart"></i> ',
            'track' => '<i class="fa feather icon-archive"></i> ',
            'issue' => '<i class="fa feather icon-alert-triangle"></i> ',
            'user' => '<i class="fa feather icon-users"></i> ',
            'department' => '<i class="fa feather icon-copy"></i> ',
            'role' => '<i class="fa feather icon-users"></i> ',
            'permission' => '<i class="fa feather icon-lock"></i> ',
            'statistics' => '<i class="fa feather icon-bar-chart-2"></i> ',
            'column' => '<i class="fa feather icon-edit-2"></i> ',
            'history' => '<i class="fa feather icon-clock"></i> ',
        ];

        return $array[$string];
    }

    /**
     * 返回emoji.
     *
     * @return string[]
     */
    #[ArrayShape(['happy' => "string", 'normal' => "string", 'sad' => "string"])]
    public static function emoji(): array
    {
        return [
            'happy' => '😀 愉快',
            'normal' => '😐 一般',
            'sad' => '😟 悲伤',
        ];
    }
}
