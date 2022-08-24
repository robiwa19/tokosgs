<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function loginAction(Request $r) {
        $r->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        $email = $r->email;
        $password = $r->password;
        $grecaptcharesponse = $r->post('g-recaptcha-response');

        // verify recaptcha
        $client = new Client;
        $verify = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY', ''),
                'response' => $grecaptcharesponse
            ]
        ]);
        if ($verify->getStatusCode() !== 200) {
            return back()->with('danger', 'Tidak dapat terhubung ke server google recaptcha.');
        } else {
            $data = json_decode($verify->getBody(), true);
            if ($data['success'] === false) {
                return back()->with('danger', 'Invalid recaptcha.');
            }
        }
        
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('danger', 'Email tidak terdafter.');
        } else {
            if ($user->email_verified_at === null)
                return back()->with('danger', 'Verifikasi email terlebih dahulu sebelum masuk.');

            if (Hash::check($password, $user->password) === false) {
                return back()->with('danger', 'Kata Sandi yang Anda masukkan salah.');
            } else {
                Session::put('sgs_user', $user);

                $user = User::find($user->id);
                $user->remember_token = Str::random(50);
                $user->save();

                setcookie('sgs_user_remember_token', $user->remember_token, (864000*30), '/');

                return redirect('/')->with('success', 'Anda berhasil masuk.');
            }
        }

        return back();
    }

    public function forgot_password() {
        return view('auth.forgot_password');
    }

    public function forgot_passwordAction(Request $r) {
        $r->validate([
            'email' => 'required|email'
        ]);

        $email = $r->email;
        $new_password = Str::random(10);

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('danger', 'Email tidak terdaftar.');
        } else {
            $user = User::find($user->id);
            $user->password = Hash::make($new_password);
            $user->save();

            // send new password to email with 
            Mail::send('email.forgot_password', [
                'user' => $user,
                'new_password' => $new_password
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Lupa Kata Sandi');
            });

            return redirect('/auth/login')->with('success', 'Kata Sandi baru berhasil dikirim ke Email Anda.');
        }

        return back();
    }

    public function register() {
        return view('auth.register');
    }

    public function registerAction(Request $r) {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'no_hp' => 'required|numeric',
            'nik' => 'required|numeric'
        ]);

        if (User::where('email', $r->email)->count() >= 1)
            return back()->with('danger', 'Email sudah terdaftar.');
        if (User::where('no_hp', $r->no_hp)->count() >= 1)
            return back()->with('danger', 'No. HP sudah terdaftar.');
        if (User::where('nik', $r->email)->count() >= 1)
            return back()->with('danger', 'NIK sudah terdaftar.');

        $user = new User;
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->no_hp = $r->no_hp;
        $user->nik = $r->nik;
        $user->save();

        $user = User::where('email', $user->email)->first();

        return redirect('/auth/register_verif_otp/' . $user->id . '/send_otp')->with('success', 'Pendaftaran berhasil, silahkan masukkan Kode OTP yang telah dikirim ke Email Anda.');
    }

    public function registerVerifOtp($id) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect('/auth/register')->with('Akun tidak terdaftar.');
        } else {
            return view('auth.register_verif_otp', compact('user'));
        }
    }

    public function registerVerifOtpAction(Request $r, $id) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect('/auth/register')->with('Akun tidak terdaftar.');
        } else {
            $r->validate(['otp' => 'required']);

            if ($r->otp != $user->remember_token) {
                return back()->with('danger', 'Kode OTP salah.');
            } else {
                $user = User::find($id);
                $user->email_verified_at = date("Y-m-d H:i:s");
                $user->remember_token = Str::random(50);
                $user->save();

                return redirect('/auth/login')->with('success', 'Silahkan masuk dengan akun Anda.');
            }
        }
    }

    public function registerVerifOtpSend($id) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect('/auth/register')->with('Akun tidak terdaftar.');
        } else {
            $otp = Str::random(6);
            $user = User::find($id);
            $user->remember_token = $otp;
            $user->save();

            // send otp here
            Mail::send('email.otp', [
                'user' => $user,
                'otp' => $otp
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Kode OTP');
            });

            return redirect('/auth/register_verif_otp/' . $id)->with('success', Session::get('success') ?? 'Silahkan masukkan Kode OTP yang telah dikirim ke email Anda');
        }
    }

    public function logout() {
        $user = User::find(User::auth()->id);
        $user->remember_token = Str::random(50);

        Session::forget('sgs_user');
        setcookie('sgs_user_remember_token', null, -1, '/');

        return redirect('/fo')->with('success', 'Anda berhasil keluar.');
    }
}
