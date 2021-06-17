<?php

namespace App\Models;

use Zx\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class AdCampaign extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'ad_campaign';

    public static $budget_mode = ['不限', '日预算', '总预算'];
    public static $landing_type = [
        '1' => '销售线索收集',
        '2' => '应用推广 单商品推广',
        '3' => '商品目录推广',
        '4' => '商品推广(鲁班)',
        '5' => '门店推广',
        '6' => '抖音号推广',
        '7' => '电商店铺推广',
        '8' => '头条文章推广',
    ];
    public static $delivery_related_num = ['1' => '非DPA', '2' => 'SDPA 单商品推广', '3' => 'DPA 商品推广'];

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

    public function ads()
    {
        return $this->hasMany(AdAd::class, 'campaign_id', 'id');
    }
}
