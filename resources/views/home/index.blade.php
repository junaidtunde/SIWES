@extends('layouts.app')

@section('title')
    Siwes
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div style="text-align: center">
                        <div class="row">
                            <div class="col-md-6" style="margin-bottom: 3%">
                                <a href="{{url('/login')}}">
                                    <img src="images/stu.jpg" height="250px" width="450px"/> Students
                                </a> 
                            </div>
                            <div class="col-md-6" style="margin-bottom: 3%">
                                <a href="{{url('/company')}}">
                                    <img src="images/company.jpg" height="250px" width="450px"/> Company
                                </a> 
                            </div>
                            <div class="col-md-6" style="margin-bottom: 3%">
                                <a href="{{url('/supervisor')}}">
                                    <img src="images/school.png" height="250px" width="450px"/> Supervisor
                                </a> 
                            </div>
                            <div class="col-md-6" style="margin-bottom: 3%">
                                <a href="{{url('/itf')}}">
                                    <img src="images/ITF.jpg" height="250px" width="450px"/> ITF
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


