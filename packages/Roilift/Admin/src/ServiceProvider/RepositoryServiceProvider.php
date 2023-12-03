<?php

namespace Roilift\Admin\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Roilift\Admin\Repository\PostRepository;
use Roilift\Admin\Repository\UserRepository;
use Roilift\Admin\Repository\CategoryRepository;
use Roilift\Admin\Interfaces\PostRepositoryInterface;
use Roilift\Admin\Interfaces\UserRepositoryInterface;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

?>