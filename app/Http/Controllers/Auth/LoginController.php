<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    // use AuthenticatesUsers;
    use RedirectsUsers, ThrottlesLogins;

    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request) {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request) {
        return $request->only($this->username(), 'password');
    }

    protected function sendLoginResponse(Request $request) {

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? response( 'Correo o contraseña erróneos',404)
                    : response( $this->guard()->user(),200);
    }

    protected function authenticated(Request $request, $user) {
        //
    }

    protected function sendFailedLoginResponse(Request $request) {
        return response( 'Correo o contraseña erróneos',404);
    }

    public function username() {
        return 'email';
    }

    protected function guard() {
        return Auth::guard();
    }

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
}
