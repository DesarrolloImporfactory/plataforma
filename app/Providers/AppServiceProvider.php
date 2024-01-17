<?php

namespace App\Providers;

use App\Models\Abono;
use App\Models\Comision;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use App\Observers\AbonoObserver;
use App\Observers\ComisionObserver;
use App\Observers\LessonObserver;
use App\Observers\SectionObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        Lesson::observe(LessonObserver::class);
        Section::observe(SectionObserver::class);
        Abono::observe(AbonoObserver::class);
        Comision::observe(ComisionObserver::class);
        User::observe(UserObserver::class);
    }
}
