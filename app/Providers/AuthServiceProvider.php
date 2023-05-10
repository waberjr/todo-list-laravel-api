<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Todo;
use App\Models\TodoTask;
use App\Policies\TodoPolicy;
use App\Policies\TodoTaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Todo::class => TodoPolicy::class,
        TodoTask::class => TodoTaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
