<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Supervisor;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{

    public function __construct()
    {
        $this->middleware('supervisor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $super = Auth::guard('supervisors')->user();
        $verified = $super->users->where('verified_by_supervisor', 1);
        return view('supervisor.component.home', compact('super', 'verified'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('supervisor.component.show', compact('student'));
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

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->verified_by_supervisor = 1;
        $user->submitted_to_supervisor = 0;
        $user->save();
        $super = Auth::guard('supervisors')->user();
        return redirect('/supervisor');
        // return view('itf.component.home', compact('itf'));
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->verified_by_supervisor = 2;
        $user->submitted_to_supervisor = 0;
        $user->save();
        $super = Auth::guard('supervisors')->user();
        return redirect('/supervisor');
        // return view('itf.component.home', compact('itf'));
    }
}
