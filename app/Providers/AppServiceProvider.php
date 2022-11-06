<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Messenger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //deploy 00webhostapp
        // $this -> app -> bind('path.public', function()
        // {
        //     return base_path('public_html');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $id = auth()->user()->id;
                $linkTo = Messenger::where('user_to', $id)->get()->groupBy('user_to')->count();
                $linkFrom = Messenger::where('user_from', $id)->count();
                $messAll = $linkTo + $linkFrom;
                $view->with('messAll', $messAll);
            }
        });
    }
}
