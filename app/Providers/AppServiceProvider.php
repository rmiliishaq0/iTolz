<?php

namespace App\Providers;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
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

        // Override the default email verification notification
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new CustomVerifyEmail())->toMail($notifiable);
        });
    }

}
