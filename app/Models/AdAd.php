<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class AdAd extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'ad_ad';

    public static $delivery_range = ['1' => '默认', '2' => '穿山甲'];
    public static $union_video_type = ['1' => '原生视频', '2' => '激励视频', '3' => '穿山甲开屏'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.center') ?: config('database.default');

        $this->setConnection($connection);

        // $this->setTable(config('admin.database.roles_table'));

        parent::__construct($attributes);
    }

    public function campaign()
    {
        return $this->belongsTo(AdCampaign::class, 'campaign_id', 'id');
    }
}
