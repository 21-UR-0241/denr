<?php

namespace App\Http\Controllers;
use App\Models\Accounts;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    //

    public function manageAccount() {
        
        $accountData = Accounts::all();

        foreach($accountData as $account){
            
        }

        return view('superadmin.account', compact('accountData'));
    }

    public function createAccount(Request $request){
        
          // Retrieve user input
    $username = $request->input('username');
    $password = $request->input('password');
    $role = $request->input('role');

    // Hash the password before saving it
    $hashedPassword = Hash::make($password);

    // Prepare the data for insertion
    $data = [
        'username' => $username,
        'password' => $hashedPassword,
        'role' => $role,
    ];

    // Insert the data into the 'users' table
    DB::table('users')->insert($data);

    // Redirect back to the previous page (or to a success page)
    return back()->with('success', 'Account created successfully!');
    }
}
