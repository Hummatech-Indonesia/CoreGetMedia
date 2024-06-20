<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Author;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Observers\AdvertisementObserver;
use App\Observers\AuthorObserver;
use App\Observers\NewsObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Author::observe(AuthorObserver::class);
        News::observe(NewsObserver::class);
        Advertisement::observe(AdvertisementObserver::class);

        parent::boot();

        $categories = Category::all();
        $subCategories = SubCategory::all();

        view()->share('categories', $categories);
        view()->share('subCategories', $subCategories);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
