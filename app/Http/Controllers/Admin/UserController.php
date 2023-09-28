<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
//    public function index(): View
//    {
//        $users = DB::table('users')
//            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//            ->select(
//                'users.id',
//                'users.name',
//                'users.email',
//                'roles.name as role',
//            )
//            ->where('users.id', '!=', auth()->user()->id)
//            ->get();
//
//        $users = $users->groupBy('email');
//
//        return view('admin.users.index', [
//            'users' => $users,
//        ]);
//    }

//    public function create(): View
//    {
//        $roles = [
//            UserRole::SCHOOL_ADMINISTRATOR,
//            UserRole::COUNSELOR_TEACHER,
//            UserRole::RELIGION_TEACHER,
//        ];

//        return view('admin.users.create', compact('roles'));
//}

//    public function store(Request $request)
//    {
//        $validRoles = [
//            UserRole::SCHOOL_ADMINISTRATOR,
//            UserRole::COUNSELOR_TEACHER,
//            UserRole::RELIGION_TEACHER,
//        ];
//
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
//            'password' => ['required', Rules\Password::defaults()],
//            'roles' => ['required', 'array', 'in:' . implode(',', $validRoles)],
//        ]);
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'school' => auth()->user()->school,
//        ]);
//
//        foreach ($request->roles as $role) {
//            $user->assignRole($role);
//        }
//
//        return redirect()->route('admin.users.index');
//    }
}
