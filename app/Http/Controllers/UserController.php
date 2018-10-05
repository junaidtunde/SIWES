<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateStudentCompany;
use App\Company;
use App\Itf;
use App\Supervisor;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view('home', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentCompany $request)
    {
        $company = Company::where('name', '=', $request->company_name)->where('supervisor_name', '=', $request->supervisor_name)->get();
        // return Auth::user()->company_id;
        if (count($company) > 0) {
            $input = $request->all();
            if ($file = $request->file) {
                $name = $file->getClientOriginalName();
                $file->move('images', $name);
                $input['path'] = $name;
            }
            Auth::user()->company_id = $company[0]->id;
            Auth::user()->path = $name;
            Auth::user()->save();
            return redirect('/');
        } else {
            return redirect()->back()->withErrors('The details you provided are not correct');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submitToItf()
    {
        $user = Auth::user();
        $lga = $user->company->LGA;
        $itf = Itf::where('LGA', $lga)->get();
        $itfID = $itf[0]->id;
        $user->itf_id = $itfID;
        $user->submitted_to_itf = 1;
        $user->save();
        return view('students.components.submitted', compact('user'));
    }

    public function submitToSupervisor()
    {
        $user = Auth::user();
        $school = $user->school;
        $supUser = Supervisor::where('school_name', $school)->get();
        $supID = $supUser[0]->id;
        $user->supervisor_id = $supID;
        $user->submitted_to_supervisor = 1;
        $user->save();
        return view('students.components.submitted', compact('user'));
    }
}
