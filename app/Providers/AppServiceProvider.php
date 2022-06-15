<?php

namespace App\Providers;

use Stripe\Stripe;
use Laravel\Cashier\Cashier;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            app(UrlGenerator::class)->forceScheme('https');
        }

        // if (!Collection::hasMacro('paginate')) {

        //     Collection::macro('paginate', 
        //         function ($perPage = 15, $page = null, $options = []) {
        //         $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        //         return (new LengthAwarePaginator(
        //             $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
        //             ->withPath('');
        //     });
        // }
        //Stripe::setApiKey(config('services.stripe.secret'));
    }
}
