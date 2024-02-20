<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\LaboratoryResult;
use App\Models\OrganizationCompanies;
use App\Models\TestPrograms;
use App\Policies\ApplicationPolicy;
use App\Policies\LaboratoryPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\TestProgramsPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Application::class => ApplicationPolicy::class,
        OrganizationCompanies::class => OrganizationPolicy::class,
        TestPrograms::class => TestProgramsPolicy::class,
        LaboratoryResult::class => LaboratoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
