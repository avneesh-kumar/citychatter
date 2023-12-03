<?php

namespace Roilift\Admin\Repository;

use App\Models\User;
use Roilift\Admin\Repository\BaseRepository;
use Roilift\Admin\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $model = new User();
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }
}

?>