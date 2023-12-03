<?php

namespace Roilift\Admin\Interfaces;

interface BaseRepositoryInterface
{
    public function paginate();

    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function find($id);
}

?>