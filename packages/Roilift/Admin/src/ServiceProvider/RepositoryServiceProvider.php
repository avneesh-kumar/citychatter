<?php

namespace Roilift\Admin\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Roilift\Admin\Repository\PostRepository;
use Roilift\Admin\Repository\UserRepository;
use Roilift\Admin\Repository\AdminRepository;
use Roilift\Admin\Repository\ConfigRepository;
use Roilift\Admin\Repository\CategoryRepository;
use Roilift\Admin\Interfaces\PostRepositoryInterface;
use Roilift\Admin\Interfaces\UserRepositoryInterface;
use Roilift\Admin\Repository\AdvertisementRepository;
use Roilift\Admin\Interfaces\AdminRepositoryInterface;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;
use Roilift\Admin\Interfaces\AdvertisementRepositoryInterface;

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
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(ConfigRepositoryInterface::class, ConfigRepository::class);
        $this->app->bind(AdvertisementRepositoryInterface::class, AdvertisementRepository::class);
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