<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\SendRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\Auth\UserActivationEmail;
use App\User;

class authController extends Controller
{
    public function login()
    {
        // Apakah sudah login
        if (Session::get('login')) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function logout()
    {
        // Logout
        Session::flush();
        return redirect('login')->with('alert', 'kamu sudah logout');
    }




    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // Mencari apa ada email tersebut?
        $data = User::where('email', $email)->first();
        if ($data) {
            // Lakukan pengecekan passwor dengan hash check
            $confirmPass = Hash::check($password, $data->password);
            if ($confirmPass) {
                // Memberikan data sesi
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('login', TRUE);
                Session::put('profile', $data->profile_image);
                Session::put('id', $data->id);
                return redirect('dashboard');
            } else {
                return redirect('login')->with('status', 'Password Salah');
            }
        } else {
            return redirect('login')->with('status', 'Email Salah');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(SendRequest $request)
    {
        // mengecek apakah request email sudah  ada di db
        $emailExist = User::where('email', $request->email)->first();
        if (!$emailExist) {
            // Jika belum ada lakukan validasi pada form
            $request->validated();
            if ($request->hasFile('profile-image')) {
                // get filename
                $fileNameWithExt = $request->file('profile-image')->getClientOriginalName();

                // get filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // get extension 
                $extension = $request->file('profile-image')->getClientOriginalExtension();

                // Full name
                $fileNameStore = $fileName . '_' . time() . '.' . $extension;

                //Path 
                $path = $request->file('profile-image')->storeAs('public/profile_image/', $fileNameStore);
            } else {
                $fileNameStore = 'noimage.jpg';
            }
            // Buat object baru pada model user
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(40);
            $user->profile_image = $fileNameStore;
            $user->activation_token = Str::random(255);
            // Simpan data data tadi
            $user->save();
            return redirect('login')->with('success', 'Akun anda telah terdaftar');
        } else {
            return redirect('register')->with('eror', 'Email telah terdaftar');
        }
    }
}
