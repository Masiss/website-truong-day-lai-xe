<?php

namespace App\Providers;

use App\Models\Driver;
use App\Models\Lesson;
use App\Policies\LessonPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
        Lesson::class => LessonPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Gate::define('view-lesson', function (Driver $driver, Lesson $lesson) {
            return true;
        });
    }
}
