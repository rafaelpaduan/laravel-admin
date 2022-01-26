<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function handleProviderCallback()
    {
        $providerUser = Socialite::driver('keycloak')->user();

        // dd($providerUser);

        $user = User::firstOrCreate(['email' => $providerUser->getEmail()],
        [
            'name' => $providerUser->getName(),
            'provider_id' => $providerUser->getId(),
            'provider' => 'keycloak'
        ]);

        Auth::login($user);

        return redirect($this->redirectTo);
    }

    public function logout() {
        Auth::logout(); // Logout of your app
        $redirectUri = env('APP_URL', 'http://localhost:8000/'); // The URL the user is redirected to
        return redirect(Socialite::driver('keycloak')->getLogoutUrl($redirectUri)); // Redirect to Keycloak
    }
}
