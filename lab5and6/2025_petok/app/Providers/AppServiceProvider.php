<?php

namespace App\Providers;

use App\Models\Coordinator;
use App\Models\Event;
use App\Observers\CoordinatorObserver;
use App\Observers\EventObserver;
use App\Repositories\CoordinatorRepository;
use App\Repositories\CoordinatorRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CoordinatorRepositoryInterface::class, CoordinatorRepository::class );
        $this->app->singleton(EventRepositoryInterface::class, EventRepository::class );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Coordinator::observe(CoordinatorObserver::class);
//        Event::observe(EventObserver::class);
    }
}
