<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Accounts;

use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.dashboard');
    }

    public function userlogin()
    {
        return view('admin.index');
    }

    public function sadashboard()
    {
        return view('superadmin.dashboard');
    }
    //login
    public function loginUser(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            // Log the credentials being passed in
            \Log::info('Attempting login with username: ' . $credentials['username']);

            // Get the user from the database by username
            $user = Accounts::where('username', $credentials['username'])->first();

            // Check if the user was found
            if ($user) {
                // Log if the user is found
                \Log::info('User found: ' . $user->username);
                \Log::info($user->password);
                \Log::info($credentials['password']);
                // Check if the password is correct
                if (Hash::check($credentials['password'], $user->password)) {

                    \Log::info('Password matches! Logging in.');


                    // Log the user in
                    Auth::login($user);

                    if ($user->role == 'Admin') {
                        return redirect('/admin/dashboard')->with('success', 'Successfully logged in!');
                    } elseif ($user->role == 'Superadmin') {
                        return redirect('/superadmin/dashboard')->with('success', 'Successfully logged in!');
                    }
                    // // Redirect to the dashboard
                    // return redirect('/login')->with('success', 'Successfully logged in!');
                } else {
                    // dd(Hash::make('123'));

                    // Log password mismatch
                    \Log::warning('Password mismatch for username: ' . $credentials['username']);
                    return back()->with('message', 'Incorrect password.');
                }
            } else {
                // Log user not found
                \Log::warning('User not found with username: ' . $credentials['username']);
                return back()->with('message', 'Username not found.');
            }
        } catch (Exception $e) {
            // Log the exception if any
            \Log::error('Error during login: ' . $e->getMessage());
            return back()->with('message', $e->getMessage());
        }
    }




    public function logoutUser()
    {
        // Log the user out
        Auth::logout();

        // Optionally, invalidate the session to clear any remaining session data
        session()->invalidate();

        // Regenerate the session ID to prevent session fixation attacks
        session()->regenerateToken();

        // Redirect the user to the login page or a home page
        return redirect('/user-login')->with('success', 'You have been logged out.');
    }



    public function activityLog()
    {
        return view('superadmin.activityLog');
    }
}
