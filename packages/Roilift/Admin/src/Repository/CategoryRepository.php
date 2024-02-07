<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Models\Category;
use Roilift\Admin\Repository\BaseRepository;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public $model;

    public function __construct()
    {
        $model = new Category();
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }
}

?>