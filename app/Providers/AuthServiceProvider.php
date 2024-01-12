<?php

namespace App\Providers;

use App\Policies\NewsPolicy;
use App\Policies\RolePolicy;
use App\Policies\PermissionsPolicy;
use App\Policies\SchoolsPolicy;
use App\Policies\UserPolicy;
use App\Policies\HighlightsPolicy;
use App\Policies\AgendasPolicy;
use App\Policies\ProjectsPolicy;
use App\Policies\TestimonialsPolicy;
use App\Policies\CoursesPolicy;
use App\Policies\CoursesCategoryPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\News;
use App\Models\Schools;
use App\Models\User;
use App\Models\Highlight;
use App\Models\Agenda;
use App\Models\Projects;
use App\Models\Testimonials;
use App\Models\CoursesCategory;
use App\Models\Courses;



// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Permission::class => PermissionsPolicy::class,
        News::class => NewsPolicy::class,
        Schools::class => SchoolsPolicy::class,
        User::class => UserPolicy::class,
        Highlight::class => HighlightsPolicy::class,
        Agenda::class => AgendasPolicy::class,
        Projects::class => ProjectsPolicy::class,
        Testimonials::class => TestimonialsPolicy::class,
        Courses::class => CoursesPolicy::class,
        CoursesCategory::class => CoursesCategoryPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
