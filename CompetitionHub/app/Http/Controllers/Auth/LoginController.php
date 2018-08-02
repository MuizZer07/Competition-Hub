<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        
        $userData = [
                    'name' => $userSocial->name,
                    'email' => $userSocial->email
                ];
        
        if($user){
            Auth::login($user);
            return redirect()->action('HomeController@index');
        }else{
            return view('auth.register', compact('userData'));
        }

    }







    // /**
    //  * Redirect the user to the google authentication page.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function redirectToProvider($provider='google')
    // {
    //     return Socialite::driver($provider)->redirect();
    // }


    // /**
    //  * Obtain the user information from google.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleProviderCallback($provider="google")
    // {
    //     $user = Socialite::driver($provider)->user();

    //     $userData = [
    //         'name' => $user->name,
    //         'email' => $user->email
    //     ];
        

    //     return view('auth.register', compact('userData'));
    //     //dd($user);
    //     //$authUser = $this->findOrCreateUser($user, $provider);
    //     //Auth::login($authUser, true);

       
    //    // return redirect($this->redirectTo);
    
    //     // $token = $user->token;
    //     // $user->getName();
    //     // echo  $user->getName();

    // }

    
    // public function fetchgoogleDataCallback($user)
    // {
    //     $user = Socialite::driver('google')->user();
        
    //     $userData = [
    //         'name' => $user->name,
    //         'email' => $user->email
    //     ];

    //     dd($userData);

    //     return view('auth.register', compact('userData'));

    // }



    // public function findOrCreateUser($user, $provider)
    // {
    //     $authUser = User::where('provider_id', $user->id)->first();
    //     if ($authUser) {
    //         return $authUser;
    //     }
    //     return User::create([
    //         'name'     => $user->name,
    //         'email'    => $user->email,
    //         'provider' => $provider,
    //         'provider_id' => $user->id
    //     ]);
    // }

    // public function chlogout() {
    //     Auth::logout();
    //     return true;
    // }
}