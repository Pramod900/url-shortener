<?php

namespace App\Providers;

use App\Facades\ShortLinkFacade;
use App\Models\ShortLink;
use App\Policies\ShortLinkPolicy;
use App\Services\ShortLinkService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $name = auth()->user()->name ?? "No name";
            $role = auth()->user()->role ?? "No role";

            $view->with([
                'name' => $name,
                'role' => $role
            ]);
        });
    }
}
