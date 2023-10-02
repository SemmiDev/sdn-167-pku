<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Base\Guru;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): View
    {
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('GROUP_CONCAT(roles.name) as roles')
            )
            ->where('users.id', '!=', auth()->user()->id)
            ->groupBy('users.id', 'users.name', 'users.email')
            ->get();

        return view('app.users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        $roles = [
            UserRole::OPERATOR_SEKOLAH,
            UserRole::KEPALA_SEKOLAH,
            UserRole::GURU_PEMBIMBING,
            UserRole::GURU_BK,
        ];

        $daftarGuru = Guru::whereNotIn('id', function ($query) {
            $query->select('guru.id')
                ->from('guru')
                ->join('users', 'guru.email', '=', 'users.email');
        })->get();

        return view('app.users.create', compact('roles', 'daftarGuru'));
    }

    public function editRole(User $user)
    {
        $userRoles = ModelHasRole::where('model_id', $user->id)
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name', 'roles.id')
            ->get();

        $roles = Role::all();

        foreach ($roles as $role) {
            $role->checked = $userRoles->contains('id', $role->id);
        }

        return view('app.users.edit-role', compact('user',  'roles'));
    }

    public function editPassword(User $user)
    {
        return view('app.users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return view('app.users.credential', [
            'email' => $user->email,
            'password' => $request->password,
        ])->with('success', 'Password berhasil diubah');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => ['required'],
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('app.users.index')->with('success', 'Role berhasil diubah');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validRoles = [
                UserRole::OPERATOR_SEKOLAH,
                UserRole::KEPALA_SEKOLAH,
                UserRole::GURU_PEMBIMBING,
                UserRole::GURU_BK,
            ];

            $request->validate([
                'guru' => ['nullable', 'exists:guru,id'],
                'password' => ['required', Rules\Password::defaults()],
                'roles' => ['required', 'array', 'in:' . implode(',', $validRoles)],
            ]);

            $guru = Guru::find($request->guru);

            $user = User::create([
                'name' => $guru->nama,
                'email' => $guru->email,
                'password' => Hash::make($request->password),
            ]);

            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }

            DB::commit();
            return view('app.users.credential', [
                'email' => $user->email,
                'password' => $request->password,
            ])->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('app.users.index')->with('success', 'User berhasil dihapus');
    }
}
