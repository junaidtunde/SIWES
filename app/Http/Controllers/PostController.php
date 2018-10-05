<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.components.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $week = $user->week->where("name", "Week ".$request->week);
        foreach ($week as $weeks) {
            $date = Carbon::createFromDate($request->year, $request->month, $request->day)->format('d/m/Y');
            $post = $weeks->posts->where("day_of_week", $date);
            foreach ($post as $posts) {
                $posts->content = $request->content;
                $posts->save();
            }
        }
        return redirect('/post/'.$request->week.'/'.$request->day.'/'.$request->month.'/'.$request->year);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($day)
    {
        return view('students.components.posts.show', compact('day'));
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

    public function showing($week, $day, $month, $year)
    {
        $user = Auth::user();
        $weeking = $user->week->where("name", "Week ".$week);
        foreach ($weeking as $weeks) {
            $date = Carbon::createFromDate($year, $month, $day)->format('d/m/Y');
            $post = $weeks->posts->where("day_of_week", $date);
            foreach ($post as $posts) {
                $content = $posts->content;
            }
        }
        return view('students.components.posts.show', compact('week', 'day', 'month', 'year', 'content'));
    }

    public function storing(Request $request, $week, $day, $month, $year)
    {
        return $request->content;
    }
}
