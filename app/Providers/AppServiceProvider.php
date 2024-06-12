<?php

namespace App\Providers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsLikeInterface;
use App\Contracts\Interfaces\NewsSubCategoryInterface;
use App\Contracts\Interfaces\NewsTagInterface;
use App\Contracts\Interfaces\NewsViewInterface;
use App\Contracts\Interfaces\PopularInterface;
use App\Contracts\Interfaces\RegisterInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Contracts\Interfaces\VoucherInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\AuthorRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\FaqRepository;
use App\Contracts\Repositories\NewsCategoryRepository;
use App\Contracts\Repositories\NewsLikeRepository;
use App\Contracts\Repositories\NewsRepository;
use App\Contracts\Repositories\NewsSubCategoryRepository;
use App\Contracts\Repositories\NewsTagRepository;
use App\Contracts\Repositories\NewsViewRepository;
use App\Contracts\Repositories\PopularRepository;
use App\Contracts\Repositories\RegisterRepository;
use App\Contracts\Repositories\SubCategoryRepository;
use App\Contracts\Repositories\TagRepository;
use App\Contracts\Repositories\VoucherRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    private array $register = [
        CategoryInterface::class => CategoryRepository::class,
        SubCategoryInterface::class => SubCategoryRepository::class,
        FaqInterface::class => FaqRepository::class,
        RegisterInterface::class => RegisterRepository::class,
        TagInterface::class => TagRepository::class,
        AuthorInterface::class => AuthorRepository::class,
        VoucherInterface::class => VoucherRepository::class,
        UserInterface::class => UserRepository::class,
        NewsInterface::class => NewsRepository::class,
        NewsCategoryInterface::class => NewsCategoryRepository::class,
        NewsSubCategoryInterface::class => NewsSubCategoryRepository::class,
        NewsTagInterface::class => NewsTagRepository::class,
        PopularInterface::class => PopularRepository::class,
        NewsLikeInterface::class => NewsLikeRepository::class,
        NewsViewInterface::class => NewsViewRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->register as $index => $value) {
            $this->app->bind($index, $value);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
