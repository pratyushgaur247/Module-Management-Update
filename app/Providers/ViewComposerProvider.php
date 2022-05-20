<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Page;
// use App\Http\Composers\PageStatusComposer;
// use App\Http\Composers\RegComposer;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // \View::composer([
        //     'frontend.frontBase','dashboard.authBase'
        // ], PageStatusComposer::class);

        // \View::composer([
        //     'auth.register'
        // ], RegComposer::class);
    }
}
