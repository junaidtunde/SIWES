@extends('layouts.supervisor_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Students to be verified</div>

                <div class="panel-body">
                    @foreach($student->week as $weeks)
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#logs" style="width: 100%;">
                            <h5>{{$weeks->name}}</h5>
                        </button>
                        <br /><br />
                        <div id="logs" class="collapse">
                            <div class="table-responsive">          
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($weeks->posts as $posts)
                                            <tr>
                                                <td>{{$posts->day_of_week}}</td>
                                                <td>{{$posts->content}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($weeks->verify_by_supervisor === 0)
                                <div class="alert alert-danger">
                                    <strong>This week log have not yet been verified by the company supervisor</strong>
                                </div>
                            @endif
                            @if($weeks->verify_by_supervisor === 1)
                                <div class="alert alert-success">
                                    <strong>Verified By Company Supervisor!</strong>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div style="text-align: center;">
                        @if($student->verified_by_itf === 0)
                            <button type="button" class="btn btn-success" disabled>
                                <i class="fa fa-btn fa-user"></i> Verify Log Book
                            </button>
                        @endif
                        @if($student->verified_by_itf === 1)
                            <a href="{{action('SupervisorController@verify', ['id'=>$student->id])}}">
                                <button type="button" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i> Verify Log Book
                                </button>
                            </a>
                        @endif
                        <a href="{{action('SupervisorController@reject', ['id'=>$student->id])}}">
                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-btn fa-user"></i> Reject Log Book
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection