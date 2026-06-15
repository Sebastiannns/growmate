<?php

// Service Provider: AuthServiceProvider — register policy
namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
