<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')->with('success', 'Welcome back, Student!');
        } elseif(Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', "Admin Login!");
        } elseif(Auth::guard('professor')->attempt($credentials)) {

            return redirect()->route('prof.dashboard')->with('success', "Prof Login!");
        }


        return redirect()->back()->with("error","Invalid Credentials")->withInput();

    }

    public function logout(Request $request) {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        } elseif (Auth::check()) {
            Auth::logout();
        } elseif (Auth::guard('professor')->check()) {
            Auth::guard('professor')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function forgotpassword(){
        return view('auth.forgotpassword');
    }



    public function forgotPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        $student = Student::where('email', $request->email)->first();

        if (!$user && !$student) {
            return redirect()->back()->with('error', 'Email not found in our records.');
        }

        $email = $user ? $user->email : $student->email;
        $token = Str::random(64);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::send('email.forgotpass', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject("Reset Password");
        });

        return redirect()->route('forgotpasswordForm')->with('success', "An email has been sent to reset your password.");
    }

    public function resetPasswordForm($token) {
        return view("auth.forgotpassUI", compact('token'));
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $resetRequest = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$resetRequest) {
            return redirect()->route('resetpasswordForm', ['token' => $request->token])
                ->with('error', "Invalid or expired token!")->withInput();
        }
        if (Carbon::parse($resetRequest->created_at)->addMinutes(5)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('forgotpasswordForm')->with('error', "Token expired! Request a new one.");
        }

        $user = User::where("email", $request->email)->first();
        $student = Student::where("email", $request->email)->first();

        if ($user) {
            $user->update(["password" => Hash::make($request->password)]);
        } elseif ($student) {
            $student->update(["password" => Hash::make($request->password)]);
        } else {
            return redirect()->route('resetpasswordForm', ['token' => $request->token])
                ->with('error', "Email not found!")->withInput();
        }
        DB::table('password_reset_tokens')->where("email", $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset success! You can now log in.');
    }





}
