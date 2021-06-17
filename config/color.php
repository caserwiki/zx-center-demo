<?php
$layout = config('admin.layout.color');
$color = [
    'default' => [
        'label' => [
            0 => '#586cb1', // 深蓝
            1 => '#4E9876', // 墨绿
            2 => '#ea5455', // 红
        ],
        'other' => [
            'duck-blue' => '#008080', // 水鸭色
            'rust' => '#DD614A', // 浅铁锈色
            'rose' => '#E1005A', // 亮玫红
            'light-red' => '#DF4553', // 浅红色
            'sea-foam' => '#00B3BE', // 海沫绿
            'purple-shade' => '#8987D0', // 紫影色
            'light-mint' => '#00B294', // 浅薄荷
            'steel-blue' => '#647185', // 钢蓝色(灰)
        ],
    ],
    'blue' => [
        'label' => [
            0 => '#586cb1', // 深蓝
            1 => '#4E9876', // 墨绿
            2 => '#ea5455', // 红
        ],
        'other' => [
            'duck-blue' => '#008080', // 水鸭色
            'rust' => '#DD614A', // 浅铁锈色
            'rose' => '#E1005A', // 亮玫红
            'light-red' => '#DF4553', // 浅红色
            'sea-foam' => '#00B3BE', // 海沫绿
            'purple-shade' => '#8987D0', // 紫影色
            'light-mint' => '#00B294', // 浅薄荷
            'steel-blue' => '#647185', // 钢蓝色(灰)
        ],
    ],
    'blue-light' => [
        'label' => [
            0 => '#62a8ea', // 浅蓝
            1 => '#4E9876', // 墨绿
            2 => '#ea5455', // 红
        ],
        'other' => [
            'duck-blue' => '#008080', // 水鸭色
            'rust' => '#DD614A', // 浅铁锈色
            'rose' => '#E1005A', // 亮玫红
            'light-red' => '#DF4553', // 浅红色
            'sea-foam' => '#00B3BE', // 海沫绿
            'purple-shade' => '#8987D0', // 紫影色
            'light-mint' => '#00B294', // 浅薄荷
            'steel-blue' => '#647185', // 钢蓝色(灰)
        ],
    ],
    'green' => [
        'label' => [
            0 => '#586cb1', // 深蓝
            1 => '#4e9876', // 墨绿
            2 => '#ea5455', // 红
        ],
        'other' => [
            'duck-blue' => '#008080', // 水鸭色
            'rust' => '#DD614A', // 浅铁锈色
            'rose' => '#E1005A', // 亮玫红
            'light-red' => '#DF4553', // 浅红色
            'sea-foam' => '#00B3BE', // 海沫绿
            'purple-shade' => '#8987D0', // 紫影色
            'light-mint' => '#00B294', // 浅薄荷
            'steel-blue' => '#647185', // 钢蓝色(灰)
        ],
        // 适合暗系主题的图表配色
        'chart' => [
            '#9475CC', // 紫色
            '#63B5F7', // 天蓝
            '#4CB5AB', // 水鸭
            '#FF994C', // 橘黄
        ],
    ],
];
return !empty($color[$layout]) ? $color[$layout] : $color['default'];
