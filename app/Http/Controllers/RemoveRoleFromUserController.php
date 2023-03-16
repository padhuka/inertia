<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;

class RemoveRoleFromUserController extends Controller
{
    public function __invoke(User $user, Role $role): RedirectResponse
    {
        $user->removeROle($role);
        return back();
    }
}
