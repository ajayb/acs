<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use App\Organization;

class AuthController extends Controller {

    public $organization;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth         = $auth;
        $this->registrar    = $registrar;
        $this->organization = Organization::lists('name', 'id');

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register', ['organization' => $this->organization]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Foundation\Http\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        $this->auth->login($this->registrar->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect('/user/login')
                        ->withInput($request->only('email'))
                        ->withErrors([
                            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : 'dashboard';
    }

}
