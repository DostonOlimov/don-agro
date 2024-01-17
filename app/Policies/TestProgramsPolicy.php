<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\TestPrograms;
use App\Models\User;
use App\tbl_activities;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TestProgramsPolicy
{
    use HandlesAuthorization;

    public function before (User $user, string $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  TestPrograms  $test
     * @return Response|bool
     */
    public function send(User $user,TestPrograms $test)
    {
            return ($test->director_id == $user->id)
                ? Response::allow()
                : Response::deny('Sizga ushbu sahifadan foydalanishga ruxsat berilmagan.');

    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  TestPrograms  $test
     * @return Response|bool
     */
    public function accept(User $user,TestPrograms $test)
    {
        return ($user->role == User::ROLE_LABORATORY_ADMIN or $user->role == User::ROLE_LABORATORY_DIRECTOR)
            ? Response::allow()
            : Response::deny('Sizga ushbu sahifadan foydalanishga ruxsat berilmagan.');

    }


}
