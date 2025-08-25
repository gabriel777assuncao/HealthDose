<?php

namespace App\Providers;

use App\Listeners\Authentication\NotifyUserAboutRegister;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Event::listen(
            NotifyUserAboutRegister::class,
        );
    }

    public function boot(): void
    {
        //
    }
}
