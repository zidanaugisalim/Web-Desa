<?php

namespace App\Providers;

use App\Models\Anak;
use App\Models\Stunting;
use App\Policies\AnakPolicy;
use App\Policies\StuntingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Anak::class => AnakPolicy::class,
        Stunting::class => StuntingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
