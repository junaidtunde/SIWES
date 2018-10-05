@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if ($user->company_id === 0 || $user->company_id === 0)
                        <h4 style="text-align: center; color: grey;">You have not began your internship program</h4>
                        <hr />
                        <h4 style="text-align: center; color: grey;">Please, register with your company, if you have one</h4>
                        <div style="text-align: center" class="row">
                            {!! Form::open(["method" => "POST", "action" => "UserController@store", 'files'=>true]) !!}
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                    <label for="company_name" class="col-md-4 control-label">Company Name</label>

                                    <div class="col-md-6">
                                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br /><br />                                

                                <div class="form-group{{ $errors->has('supervisor_name') ? ' has-error' : '' }}" style="padding-bottom: 2%">
                                    <label for="supervisor_name" class="col-md-4 control-label">Supervisor Name</label>

                                    <div class="col-md-6">
                                        <input id="supervisor_name" type="text" class="form-control" name="supervisor_name" value="{{ old('supervisor_name') }}">

                                        @if ($errors->has('supervisor_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('supervisor_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>     
                                <br />                    

                                <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                    <label for="company_address" class="col-md-4 control-label">Company Address</label>

                                    <div class="col-md-6">
                                        <input id="company_address" type="text" class="form-control" name="company_address" value="{{ old('company_address') }}">

                                        @if ($errors->has('company_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br /><br />

                                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                    <label for="file" class="col-md-4 control-label">Please upload your passport</label>

                                    <div class="col-md-6">
                                        {{--  <input id="company_address" type="text" class="form-control" name="company_address" value="{{ old('company_address') }}">  --}}
                                        
                                        {!! Form::file('file', ['class'=>'form-control']) !!}
                                        
                                        @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br /><br />

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Register
                                        </button>
                                    </div>
                                </div>                                 
                            {!! Form::close() !!}
                        </div>
                    @elseif ($user->company_id === 1)
                        <div class="row">
                            <div class="col-md-4">
                            <img src="/images/{{$user->path}}" alt="" height="40%" width="40%">
                            <br />
                            </div>
                            <div class="col-md-6">
                                <br />
                                <h4 style="text-align: center; color: grey;">You can start filling the log book</h4>
                                <br />
                                <h4 style="text-align: center; color: grey;">Started Internship: {{$howLong}}</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if ($user->company_id === 0 || $user->company_id === 2)
                <div class="panel panel-default">
                    <div class="panel-heading">Suggestions</div>

                    <div class="panel-body">
                        @if (count($suggest) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Service Provided</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suggest as $suggestions)
                                            <tr>
                                                <td>{{$suggestions->name}}</td>
                                                <td>{{$suggestions->email}}</td>
                                                <td>{{$suggestions->address}}</td>
                                                <td>{{$suggestions->service_provided}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <h4 style="text-align: center; color: grey;">There are no suggestions at the moment, please check back</h4>
                        @endif
                    </div>
                </div>
            @endif
            @if ($user->company_id === 1 && $user->submitted_to_itf === 0)
                <div class="panel panel-default">
                    <div class="panel-heading">Log Book</div>

                    <div class="panel-body">
                        @if ($user->verified_by_itf === 0 || $user->verified_by_itf === 2)
                            @foreach ($user->week->all() as $weeks)
                                <button class="btn btn-primary" data-toggle="collapse" data-target="#logs" style="width: 100%;">
                                    <h5>{{$weeks->name}}</h5>
                                </button>
                                <br /><br />
                                <div id="logs" class="collapse">
                                    <div class="row">
                                        @if (!empty($user->week->last()->posts))
                                            @foreach ($user_day as $users_day)
                                                <div class="col-md-3" style="margin-bottom: 3%;">
                                                    <a href="{{action('PostController@showing', [
                                                        'week'=>$week,
                                                        'day'=>Carbon\Carbon::createFromFormat('d/m/Y', $users_day->day_of_week)->day,
                                                        'month'=>Carbon\Carbon::createFromFormat('d/m/Y', $users_day->day_of_week)->month,
                                                        'year'=>Carbon\Carbon::createFromFormat('d/m/Y', $users_day->day_of_week)->year,
                                                        ])}}">
                                                        <button class="btn btn-info" style="width: 100%">
                                                            {{$weekDays[Carbon\Carbon::createFromFormat('d/m/Y', $users_day->day_of_week)->dayOfWeek]}}  {{$users_day->day_of_week}}
                                                        </button>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($user->submitted_to_itf === 0 && ($user->verified_by_itf === 0 || $user->verified_by_itf === 2))
                        <div style="text-align: right; padding-right: 2%; padding-bottom: 2%;">
                            <a href="{{action('UserController@submitToItf', ['user'=>$user])}}">
                                <button class="btn btn-success" style="width: 30%;">
                                    Submit To ITF
                                </button>
                            </a>
                        </div>
                    @endif
                    
                    @if ($user->verified_by_itf === 1 && ($user->submitted_to_supervisor === 0 && $user->verified_by_supervisor === 2))
                        <div style="text-align: right; padding-right: 2%; padding-bottom: 2%;">
                            <a href="{{action('UserController@submitToSupervisor', ['user'=>$user])}}">
                                <button class="btn btn-success" style="width: 30%;">
                                    Submit To Supervisor
                                </button>
                            </a>
                        </div>
                    @endif
                </div>
            @endif
            @if ($user->submitted_to_itf === 1)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">Wait for your logbook to be verified by ITF</h4>
                </div>
            @endif
            @if ($user->submitted_to_supervisor === 1)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">Wait for your logbook to be verified by Supervisor</h4>
                </div>
            @endif
            @if ($user->verified_by_itf === 1)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">Your logbook have been verified by ITF</h4>
                </div>
            @endif
            @if ($user->verified_by_supervisor === 1)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">Your logbook have been verified by the school supervisor</h4>
                </div>
            @endif
            @if ($user->verified_by_itf === 2)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">
                        Your logbook have been rejected by ITF, please make sure that all weeks were submitted 
                        and verified accordingly by the company supervisor
                    </h4>
                </div>
            @endif
            @if ($user->verified_by_supervisor === 2)
                <div class="alert alert-success">
                    <h4 style="text-align: center; color: grey;">
                        Your logbook have been rejected by the school supervisor, please make sure that all weeks were submitted 
                        and verified accordingly by the company supervisor and re-submit to ITF
                    </h4>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
