<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Models\PostReport;
use Roilift\Admin\Interfaces\PostReportRepositoryInterface;

class PostReportRepository extends BaseRepository implements PostReportRepositoryInterface
{
    public function __construct(PostReport $model)
    {
        parent::__construct($model);
    }
}

?>