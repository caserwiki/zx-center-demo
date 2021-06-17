<?php

namespace App\Admin\Repositories;

use Facade\FlareClient\Context\RequestContext;
use Zx\Admin\Repositories\EloquentRepository;

class Weather extends EloquentRepository
{
    protected static $icon = [
        '晴' => 'icon-sun',
        '多云' => 'icon-cloud',
        '阴' => 'icon-cloud',
        '阵雨' => 'icon-cloud-drizzle',
        '雷阵雨' => 'icon-cloud-lightning',
        '雷阵雨伴有冰雹' => 'icon-cloud-lightning',
        '雨夹雪' => 'icon-cloud-snow',
        '小雨' => 'icon-cloud-drizzle',
        '中雨' => 'icon-cloud-drizzle',
        '大雨' => 'icon-cloud-rain',
        '暴雨' => 'icon-cloud-rain',
        '大暴雨' => 'icon-cloud-rain',
        '特大暴雨' => 'icon-cloud-rain',
        '阵雪' => 'icon-cloud-snow',
        '小雪' => 'icon-cloud-snow',
        '中雪' => 'icon-cloud-snow',
        '大雪' => 'icon-cloud-snow',
        '暴雪' => 'icon-cloud-snow',
        '雾' => 'icon-wind',
        '冻雨' => 'icon-cloud-drizzle',
        '沙尘暴' => 'icon-alert-triangle',
        '小到中雨' => 'icon-cloud-drizzle',
        '中到大雨' => 'icon-cloud-rain',
        '大到暴雨' => 'icon-cloud-rain',
        '暴雨到大暴雨' => 'icon-cloud-rain',
        '大暴雨到特大暴雨' => 'icon-cloud-rain',
        '小到中雪' => 'icon-cloud-snow',
        '中到大雪' => 'icon-cloud-snow',
        '大到暴雪' => 'icon-cloud-snow',
        '浮尘' => 'icon-alert-triangle',
        '扬沙' => 'icon-alert-triangle',
        '强沙尘暴' => 'icon-alert-triangle',
        '浓雾' => 'icon-wind',
        '龙卷风' => 'icon-alert-triangle',
        '弱高吹雪' => 'icon-cloud-snow',
        '轻雾' => 'icon-wind',
        '强浓雾' => 'icon-wind',
        '霾' => 'icon-alert-triangle',
        '中度霾' => 'icon-alert-triangle',
        '重度霾' => 'icon-alert-triangle',
        '严重霾' => 'icon-alert-triangle',
        '大雾' => 'icon-wind',
        '特强浓雾' => 'icon-alert-triangle',
        '雨' => 'icon-cloud-drizzle',
        '雪' => 'icon-cloud-snow',
    ];
    /**
     * Model.
     *
     * @var string
     */
    // protected $eloquentClass = Model::class;

    public static function getWeather()
    {
        $response = app('weather')->getWeather('183.63.111.186');
        if ($response['status'] !== 0) return [];
        $result = $response['result'];
        return [
            'now' => [
                'icon' => self::$icon[$result['now']['text']] ?? 'icon-cloud-off',
                'text' => $result['location']['name'] . ' - ' . $result['now']['text'],
                'temp' => '温度（℃）' . $result['now']['temp'],
                'rh' => '湿度(%)' . $result['now']['rh'],
                'wind' => $result['now']['wind_dir'] . ' ' . $result['now']['wind_class'],
                'time' => $result['forecasts']['0']['date'] . ' ' . $result['forecasts']['0']['week'],
            ],
            '0' => [
                'text' => $result['forecasts']['0']['text_day'] == $result['forecasts']['0']['text_night'] ? $result['forecasts']['0']['text_day'] : $result['forecasts']['0']['text_day'] . '转' . $result['forecasts']['0']['text_night'],
                'temp' => $result['forecasts']['0']['low'] . '~' . $result['forecasts']['0']['high'] . '℃',
            ],
            '1' => [
                'icon' => self::$icon[$result['forecasts']['1']['text_day']] ?? 'icon-cloud-off',
                'text' => $result['forecasts']['1']['text_day'] == $result['forecasts']['1']['text_night'] ? $result['forecasts']['1']['text_day'] : $result['forecasts']['1']['text_day'] . '转' . $result['forecasts']['1']['text_night'],
                'temp' => '温度（℃）' . $result['forecasts']['1']['low'] . '~' . $result['forecasts']['1']['high'],
                'wind' => $result['forecasts']['1']['wd_day'] . ' ' . $result['forecasts']['1']['wc_day'],
                'time' => $result['forecasts']['1']['date'] . ' ' . $result['forecasts']['1']['week'],
            ],
        ];
    }
}
