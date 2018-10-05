@extends('layouts.company_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Company Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/company/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
{{--  
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Supervisor Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  --}}

                        <div class="form-group{{ $errors->has('RC') ? ' has-error' : '' }}">
                            <label for="RC" class="col-md-4 control-label">Company RC</label>

                            <div class="col-md-6">
                                <input id="RC" type="text" class="form-control" name="RC" value="{{ old('RC') }}">

                                @if ($errors->has('RC'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('RC') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Company Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('LGA') ? ' has-error' : '' }}">
                            <label for="LGA" class="col-md-4 control-label">Local Government Area</label>

                            <div class="col-md-6">
                                <input id="LGA" type="text" class="form-control" name="LGA" value="{{ old('LGA') }}">

                                @if ($errors->has('LGA'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LGA') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Select State</label>
                            <div class="col-md-6">
                                {{--  <input id="matric_no" type="text" class="form-control" name="matric_no" value="{{ old('matric_no') }}">  --}}
                                
                                {!! Form::select('state', [
                                    'Lagos' => 'Lagos',
                                    'Abuja' => 'Abuja',
                                    'Katsina' => 'Katsina',
                                    'Calabar' => 'Calabar',
                                    'Ogun' => 'Ogun',
                                    'Osun' => 'Osun',
                                    ], 'Lagos', 
                                ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('supervisor_name') ? ' has-error' : '' }}">
                            <label for="supervisor_name" class="col-md-4 control-label">Company Supervisor Name</label>

                            <div class="col-md-6">
                                <input id="supervisor_name" type="text" class="form-control" name="supervisor_name" value="{{ old('supervisor_name') }}">

                                @if ($errors->has('supervisor_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supervisor_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Company Supervisor E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('supervisor_phone_number') ? ' has-error' : '' }}">
                            <label for="supervisor_phone_number" class="col-md-4 control-label">Company Supervisor Phone number</label>

                            <div class="col-md-6">
                                <input id="supervisor_phone_number" type="tel" class="form-control" name="supervisor_phone_number" value="{{ old('supervisor_phone_number') }}">

                                @if ($errors->has('supervisor_phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supervisor_phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('service_provided') ? ' has-error' : '' }}">
                            <label for="service_provided" class="col-md-4 control-label">Service Provided</label>

                            <div class="col-md-6">
                                <input id="service_provided" type="tel" class="form-control" name="service_provided" value="{{ old('service_provided') }}" placeholder="Type of service provided by the company">

                                @if ($errors->has('service_provided'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('service_provided') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
