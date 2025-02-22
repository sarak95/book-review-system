<?php

namespace App\Providers;

use App\Models\Book;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\TagRepository;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
 
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);

        $this->app->bind(BookRepository::class, function ($app) {
            return new BookRepository(new Book());
        });

        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);

        $this->app->bind(AuthorService::class, function ($app) {
            return new AuthorService($app->make(AuthorRepositoryInterface::class));
        });

         $this->app->bind(BookService::class, function ($app) {
            return new BookService($app->make(BookRepository::class));
        });
     
        $this->app->bind(TagService::class, function ($app) {
            return new TagService($app->make(TagRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}


