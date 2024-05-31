<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Interfaces\AdvertisementRepositoryInterface;
use Roilift\Admin\Models\Advertisement;

class AdvertisementRepository extends BaseRepository implements AdvertisementRepositoryInterface
{
    public function __construct(Advertisement $model)
    {
        parent::__construct($model);
    }
}

?>