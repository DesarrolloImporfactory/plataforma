<?php

namespace App\Providers;

use App\Models\Lesson;
use App\Models\Section;
use App\Observers\LessonObserver;
use App\Observers\SectionObserver;
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
    }
}
