<?php

namespace App\Http\Controllers\CompanyAuth;

use App\User;
use App\Company;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\CreateCompanyRequest;

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
    protected $redirectTo = '/company';
    protected $redirectAfterLogout = '/company/login';
    protected $redirectAfterLogin = '/company';
    protected $guard = 'companies';
    
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

        return view('company.auth.login');
    }
    public function showRegistrationForm()
    {
        return view('company.auth.register');
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
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
            'RC' => 'required',
            'address' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'email' => 'required|email|max:255|unique:companies',
            'supervisor_name' => 'required',
            'supervisor_phone_number' => 'required',
            'service_provided' => 'required|max:255',
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
        // var_dump($data);
        // return "";
        $company = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'RC' => $data['RC'],
            'address' => $data['address'],
            'LGA' => $data['LGA'],
            'state' => $data['state'],
            'supervisor_name' => $data['supervisor_name'],
            'supervisor_phone_number' => $data['supervisor_phone_number'],
            'service_provided' => $data['service_provided'],
        ]);
        // Custom Code
        $company->email = $data['email'];
        $company->state = $data['state'];
        $company->LGA = $data['LGA'];
        $company->service_provided = $data['service_provided'];
        $company->save();
        return $company;
    }
}
