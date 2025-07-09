<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Halaman Awal';
        return view('auth.onboarding-page', $data);
    }

    public function onboarding_submit(Request $request)
    {
        $role = Role::where('id', 1)->whereHas('users')->count();
        if ($role == 0) {
            $object = $request->all();

            $validator = Validator::make($object, [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Gagal menyimpan data! Pastikan semua data diisi dengan benar!');
            } else {
                try {
                    DB::beginTransaction();
                    $user = User::create([
                        'email' => $request->email,
                        'name' => $request->name,
                        'password' => Hash::make($request->password),
                    ]);

                    $role = [
                        'role_id' => 1,
                    ];

                    $user->roles()->attach($role);

                    DB::commit();
                } catch (Exception $e) {
                    DB::Rollback();
                }

                return redirect()->route('login')->with('success', 'Data berhasil ditambah!');
            }
        } else {
            return redirect()->back()->with('error', 'Sudah ada akun admin!');
        }
    }
}
