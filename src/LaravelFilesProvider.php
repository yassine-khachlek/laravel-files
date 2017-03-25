<?php

namespace Yk\LaravelFiles;

use Illuminate\Support\ServiceProvider;

class LaravelFilesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return  void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk\LaravelFiles');

        $this->app->router->group(['namespace' => 'Yk\LaravelFiles\App\Http\Controllers', 'middleware' => ['web']],
            function(){
                require __DIR__.'/routes/web.php';
            }
        );

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/yk/laravel-files'),
        ], 'public');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {

    }
}