<?php

namespace App\Admin\Repositories;

use App\Models\Files as Model;
use Zx\Admin\Repositories\EloquentRepository;

class Files extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
