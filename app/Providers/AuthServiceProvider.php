<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
        public function boot()
        {
            $this->registerPolicies();
    
            // Gate untuk Admin
            Gate::define('is-admin', function (User $user) {
                return $user->role === 'admin';
            });
    
            // Gate untuk Manager
            Gate::define('is-manager', function (User $user) {
                return $user->role === 'manager';
            });
    
            // Gate untuk Karyawan
            Gate::define('is-karyawan', function (User $user) {
                return $user->role === 'karyawan';
            });
        }
    }
