<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Interfaces\AdminRepositoryInterface;
use Roilift\Admin\Models\Admin;
use Roilift\Admin\Repository\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public $model;

    public function __construct()
    {
        $model = new Admin();
        parent::__construct($model);
    }
}

?>