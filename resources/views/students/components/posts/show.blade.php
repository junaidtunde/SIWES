@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Logs</div>

                <div class="panel-body">
                    @if ($content === "")
                        <h4 style="text-align: center; color: grey;">You have not created a log for this day!</h4>
                    @else
                        <h4 style="text-align: center; color: grey;">Date: {{$day}}/{{$month}}/{{$year}}</h4>
                        <h4 style="text-align: center; color: grey;">Content: {{$content}}</h4>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Create Logs</div>

                <div class="panel-body">
                    <div style="text-align: center" class="row">
                            {!! Form::open(["method" => "POST", "action" => ["PostController@store"]]) !!}
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="content" class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                        {{--  <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}">  --}}
                                        <textarea class="form-control" rows="5" id="content" name="content" value="{{ old('content') }}"></textarea>

                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="day" value="{{$day}}" type="hidden"/>
                                </div>
                                <div class="form-group">
                                    <input name="month" value="{{$month}}" type="hidden"/>
                                </div>
                                <div class="form-group">
                                    <input name="year" value="{{$year}}" type="hidden"/>
                                </div>
                                <div class="form-group">
                                    <input name="week" value="{{$week}}" type="hidden"/>
                                </div>
                                <br /><br />                                
                                <br /><br />                                
                                <br /><br />                                

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Create Log / Edit Log
                                        </button>
                                    </div>
                                </div>                                 
                            {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
