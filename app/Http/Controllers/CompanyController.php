<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\User;
use App\Week;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::guard('companies')->user();
        $student = $company->students;
        // return $student;
        return view('company.component.home', compact('company', 'student'));
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
    public function store(CreateCommentRequest $request)
    {
        $super_week = Week::findOrFail($request->week);
        $super_week->comment_by_supervisor = $request->comment_by_supervisor;
        $super_week->verify_by_supervisor = 1;
        $super_week->save();
        return redirect('/company');
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

    public function add($id)
    {
        $student = User::findOrFail($id);
        // return $student;
        $student->part_of_company = 1;
        $student->save();
        return redirect('/company');
        // view('company.components.home');
    }

    public function remove($id)
    {
        $student = User::findOrFail($id);
        $student->part_of_company = 2;
        $student->company_id = 0;
        $student->save();
        return redirect('/company');
    }

    public function check($id)
    {
        $student = User::findOrFail($id);
        return view('company.component.verify', compact('student'));
    }
    
    public function verifyWeek($id)
    {
        $week = Week::findOrFail($id);
        $week->verify_by_supervisor = 1;
        $student = $week->user();
        return view('company.component.verify', compact('student'));
    }
}
