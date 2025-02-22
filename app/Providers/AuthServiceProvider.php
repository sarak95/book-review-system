<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use App\Policies\AuthorPolicy;
use App\Policies\BookPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Author::class => AuthorPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
