<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itf;
use App\User;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ItfController extends Controller
{

    public function __construct()
    {
        $this->middleware('itf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itf = Auth::guard('itfs')->user();
        $verified = $itf->users->where('verified_by_itf', 1);
        return view('itf.component.home', compact('itf', 'verified'));
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
        return view('itf.component.show', compact('student'));
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
        $user->verified_by_itf = 1;
        $user->submitted_to_itf = 0;
        $user->save();
        $itf = Auth::guard('itfs')->user();
        return redirect('/itf', $itf);
        // return view('itf.component.home', compact('itf'));
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->verified_by_itf = 2;
        $user->submitted_to_itf = 0;
        $user->save();
        $itf = Auth::guard('itfs')->user();
        return redirect('/itf', $itf);
        // return view('itf.component.home', compact('itf'));
    }
}
