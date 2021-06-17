<?php

namespace App\Admin\Repositories;

use App\Models\AdAd as Model;
use Zx\Admin\Repositories\EloquentRepository;

class AdAd extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
