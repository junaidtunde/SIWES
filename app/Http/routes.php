<?php

use App\Http\Controllers\Auth\CompanyAuth\AuthController;
use App\User;
use App\Itf;
use App\Supervisor;
use App\Company;
use App\Week;
use App\Post;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if ($user) {
        $user_state = $user->state;
        $suggest = Company::where('state', '=', $user_state)->get();
        $user_create = $user->created_at;
        $preciseCreateDay = $user_create->dayOfYear;
        $howLong = $user->created_at->diffForHumans();
        $firstWeek = $user_create->weekOfYear;
        // return $firstWeek;
        $today = Carbon::now();
        // return $today->startOfWeek()->format('Y:m:d');
        $preciseDay = $today->dayOfYear;
        $day = $today->dayOfWeek;
        $current_week = $today->weekOfYear + 1;
        $week = $current_week - $firstWeek;
        $weekDays = [
            0 => "Sunday",
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
        ];
        $dayOfWeek = $weekDays[$day];
        if ($day === 1 || $preciseCreateDay === $preciseDay) {
            if ($user->company_id === 1) {
                $tracker = $user->tracker;
                $user->tracker = $user->tracker + 1;
                $user->save();
                if (empty($user->week->all())) {
                    $week_saver = new Week(['name' => 'Week '.$week, 'end_of_week'=>$today->endOfWeek()->format('d/m/Y')]);
                    $user->week()->save($week_saver);
                } elseif ($user->tracker === 2) {
                    $count = 0;
                    for ($day; $day < 7; $day++) { 
                        $post = new Post(['day_of_week'=>$today->addDays($count)->format('d/m/Y')]);
                        $user->week->get(0)->posts()->save($post);
                        $count = 1;
                    }
                } elseif ($user->week->last()->name !== 'Week '.$week) {
                    $user->tracker = 0;
                    $user->save();
                    if ($day === 1) {
                        $id = $user->id;
                        $week_get = Week::whereUserId($id)->get()->last();
                        $week_get->week_ended = 1;
                        $week_get->save();
                    }
                    $week_saver = new Week(['name' => 'Week '.$week, 'end_of_week'=>$today->endOfWeek()->format('d/m/Y')]);
                    $user->week()->save($week_saver);
                } else { 

                }
            }
            if (!empty($user->week->last()->posts)) {
                $user_day = $user->week->last()->posts;
                foreach ($user_day as $users_day) {
                    $date = $users_day->day_of_week;
                    $weekDay = $weekDays[Carbon::createFromFormat('d/m/Y', $date)->dayOfWeek];
                }
            }
        }
        if (!empty($user->week->last()->posts)) {
            $user_day = $user->week->last()->posts;
            foreach ($user_day as $users_day) {
                $date = $users_day->day_of_week;
                $weekDay = $weekDays[Carbon::createFromFormat('d/m/Y', $date)->dayOfWeek];
            }
        }
        return view('students.components.home', compact('user', 'suggest', 'howLong', 'weekDays', 'user_day', 'week'));
    }
    else {
        return redirect('/login');
    }
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/company/register', 'CompanyAuth\AuthController@register');
Route::post('supervisor/register', 'SupervisorAuth\AuthController@register');
Route::post('itf/register', 'ItfAuth\AuthController@register');

// Company
Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/company/login','CompanyAuth\AuthController@showLoginForm');
    Route::post('/company/login','CompanyAuth\AuthController@login');
    Route::get('/company/logout','CompanyAuth\AuthController@logout');

    // Registration Routes...
    Route::get('/company/register', 'CompanyAuth\AuthController@showRegistrationForm');

    Route::get('/company', 'CompanyController@index');

});

// Supervisor
Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/supervisor/login','SupervisorAuth\AuthController@showLoginForm');
    Route::post('/supervisor/login','SupervisorAuth\AuthController@login');
    Route::get('/supervisor/logout','SupervisorAuth\AuthController@logout');

    // Registration Routes...
    Route::get('supervisor/register', 'SupervisorAuth\AuthController@showRegistrationForm');

    Route::get('/supervisor', 'SupervisorController@index');

});

// Itf
Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/itf/login','ItfAuth\AuthController@showLoginForm');
    Route::post('/itf/login','ItfAuth\AuthController@login');
    Route::get('/itf/logout','ItfAuth\AuthController@logout');

    // Registration Routes...
    Route::get('itf/register', 'ItfAuth\AuthController@showRegistrationForm');

    Route::get('/itf', 'ItfController@index');

});

Route::resource('user', 'UserController');
Route::get('itfSubmit', 'UserController@submitToItf');
Route::get('itfVerify/{id}', 'ItfController@verify');
Route::get('itfReject/{id}', 'ItfController@reject');


Route::resource('supervisor', 'SupervisorController');
Route::get('SupervisorSubmit', 'UserController@submitToSupervisor');
Route::get('supervisorVerify/{id}', 'SupervisorController@verify');
Route::get('supervisorReject/{id}', 'SupervisorController@reject');


Route::resource('company', 'CompanyController');
Route::get('company/add/{id}', 'CompanyController@add');
Route::get('company/remove/{id}', 'CompanyController@remove');
Route::get('company/check/{id}', 'CompanyController@check');
Route::get('company/verify/{id}', 'CompanyController@verifyWeek');

Route::resource('post', 'PostController');
Route::resource('week', 'WeekController');
Route::resource('itf', 'ItfController');

// Route::get('company/add/{$id}', function ($id) {
//     $student = User::findOrFail($id);
//     return $student;
//     $student->part_of_company = 1;
//     $student->save();
//     return redirect('/company');
// });
Route::get('/post/{week}/{day}/{month}/{year}', 'PostController@showing');
// Route::get('/post/{request}/{week}/{day}/{month}/{year}', 'PostController@storing');


