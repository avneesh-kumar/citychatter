<?php

namespace Roilift\Admin\Repository;

use Roilift\Admin\Models\Post;
use Roilift\Admin\Repository\BaseRepository;
use Roilift\Admin\Interfaces\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Post());
    }
}

?>