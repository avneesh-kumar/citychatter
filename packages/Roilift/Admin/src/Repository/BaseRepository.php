<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Interfaces\BaseRepositoryInterface;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;
use Roilift\Admin\Models\Category;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function paginate($perPage = 20, $columns = ['*'], $pageName = 'page', $page = null, $filters = [], $sorts = [], $search = [])
    {
        $query = $this->model->where($filters);

        if($search) {
            $query->where(function ($query) use ($search) {
                foreach ($search as $field => $value) {
                    
                    if(is_numeric($value)) {
                        $query->where($field, $value);
                    } else {
                        $query->where($field, 'LIKE', '%' . $value . '%');
                    }
                }
            });
        }

        if ($sorts) {
            foreach ($sorts as $sort) {
                $query->orderBy($sort['field'], $sort['dir']);
            }
        }

        return $query->paginate($perPage, $columns, $pageName, $page);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        $model->update($data);

        return $model;
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }
    
}

?>