<?php

namespace App\Http\Controllers\ItfAuth;

use App\User;
use App\Itf;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/itf';
    protected $redirectAfterLogout = '/itf/login';
    protected $redirectAfterLogin = '/itf';
    protected $guard = 'itfs';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('itf.auth.login');
    }
    public function showRegistrationForm()
    {
        return view('itf.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:itfs',
            'state' => 'required|max:255',
            'LGA' => 'required|max:255',
            'location' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $itf = Itf::create([
            'email' => $data['email'],
            'state' => $data['state'],
            'password' => bcrypt($data['password']),
            'LGA' => $data['LGA'],
            'location' => $data['location'],
        ]);
        // Custom Code
        $itf->email = $data['email'];
        $itf->password = bcrypt($data['password']);
        $itf->save();
        return $itf;
    }
}
