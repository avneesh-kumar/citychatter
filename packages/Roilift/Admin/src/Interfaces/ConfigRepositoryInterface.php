<?php

namespace Roilift\Admin\Interfaces;

interface ConfigRepositoryInterface extends BaseRepositoryInterface
{
    public function getConfigsByGroup(string $group);

    public function getConfigByKey(string $key);

    public function getConfigValueByKey(string $key);
}