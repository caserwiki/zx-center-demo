<?php

namespace App\Admin\Repositories;

use App\Models\AdCampaign as Model;
use Zx\Admin\Repositories\EloquentRepository;

class AdCampaign extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
