<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Models\Config;
use Roilift\Admin\Repository\BaseRepository;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class ConfigRepository extends BaseRepository implements ConfigRepositoryInterface
{
    public $model;

    public function __construct()
    {
        $model = new Config();
        parent::__construct($model);
    }
    
    public function getConfigsByGroup(string $group)
    {
        return $this->model->where('group', $group)->get();
    }

    public function getConfigByKey(string $key)
    {
        return $this->model->where('key', $key)->first();
    }

    public function getConfigValueByKey(string $key)
    {
        $config = $this->model->where('key', $key)->first();
        return $config ? $config->value : null;
    }
}