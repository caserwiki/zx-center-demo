<?php

namespace App\Admin\Repositories;

use App\Models\Task as Model;
use Zx\Admin\Repositories\EloquentRepository;

class Task extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public static function completionRate($id = 0, $status = '', $p2 = 0)
    {
        $query = Model::selectRaw("COUNT(*) as exp")
            ->where('parent_id', 0);
        if ($id > 0) $query->where('product', $id);
        if ($status != '') $query->where('status', $status);
        if ($p2 > 0) $query->where('p2', $p2);
        $data = $query->first()->toArray();
        return $data['exp'];
    }

    /**
     * Get options for Select field in form.
     *
     * @param \Closure|null $closure
     *
     * @return array
     */
    public static function selectOptions(\Closure $closure = null)
    {
        $options = (new static())->withQuery($closure)->buildSelectOptions();

        return collect($options)->all();
    }

    /**
     * Build options of select field in form.
     *
     * @param array  $nodes
     * @param int    $parentId
     * @param string $prefix
     * @param string $space
     *
     * @return array
     */
    protected function buildSelectOptions(array $nodes = [], $parentId = 0, $prefix = '', $space = '&nbsp;')
    {
        $d = '├─';
        $prefix = $prefix ?: $d.$space;

        $options = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes()->toArray();
        }

        foreach ($nodes as $index => $node) {
            if ($node[$this->getParentColumn()] == $parentId) {
                $currentPrefix = $this->hasNextSibling($nodes, $node[$this->getParentColumn()], $index) ? $prefix : str_replace($d, '└─', $prefix);

                $node[$this->getTitleColumn()] = $currentPrefix.$space.$node[$this->getTitleColumn()];

                $childrenPrefix = str_replace($d, str_repeat($space, 6), $prefix).$d.str_replace([$d, $space], '', $prefix);

                $children = $this->buildSelectOptions($nodes, $node[$this->getKeyName()], $childrenPrefix);

                $options[$node[$this->getKeyName()]] = $node[$this->getTitleColumn()];

                if ($children) {
                    $options += $children;
                }
            }
        }

        return $options;
    }

    /**
     * Get all elements.
     *
     * @return static[]|\Illuminate\Support\Collection
     */
    public function allNodes()
    {
        return $this->callQueryCallbacks(new static())
            ->orderBy($this->getOrderColumn(), 'asc')
            ->get();
    }
}
