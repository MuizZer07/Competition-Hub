<?php

/**
* 
* Controller class for verification mail
* Handles requests, responses
* 
*/

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token){
        User::where('token', $token)->firstOrFail()
                ->update(['token' => null]);
       
        return redirect()->route('home')
        ->with('success', 'Account Verified!!');
    }
}
