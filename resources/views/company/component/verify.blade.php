@extends('layouts.company_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$student->lastname}} {{$student->firstname}}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/images/{{$student->path}}" alt="" height="40%" width="40%">
                        </div>
                        <div class="col-md-8">
                            @foreach ($student->week->all() as $weeks)
                                <button class="btn btn-primary" data-toggle="collapse" data-target="#logs" style="width: 100%; margin-top: 1%">
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
                                                @if (!empty($weeks->posts))
                                                    @foreach ($weeks->posts as $weekly_post)
                                                        <tr>
                                                            <td>{{$weekly_post->day_of_week}}</td>
                                                            <td>{{$weekly_post->content}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center">
                                        {!! Form::open(["method" => "POST", "action" => ["CompanyController@store"]]) !!}
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('comment_by_supervisor') ? ' has-error' : '' }}">
                                                <label for="comment_by_supervisor" class="col-md-4 control-label">Supervisor Comment</label>

                                                {{--  <input id="comment_by_supervisor" type="text" class="form-control" name="comment_by_supervisor" value="{{ old('comment_by_supervisor') }}">  --}}
                                                <textarea class="form-control" rows="5" id="comment_by_supervisor" name="comment_by_supervisor" value="{{ old('comment_by_supervisor') }}"></textarea>

                                                @if ($errors->has('comment_by_supervisor'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('comment_by_supervisor') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input name="week" value="{{$weeks->id}}" type="hidden"/>
                                            </div>
                                            @if ($weeks->week_ended === 0)
                                                <button type="submit" class="btn btn-success" disabled>
                                                    Verify Week Log
                                                </button>
                                            @endif
                                            @if ($weeks->week_ended === 1 && $weeks->verify_by_supervisor === 0)
                                                <button type="submit" class="btn btn-success">
                                                    Verify Week Log
                                                </button>
                                            @endif
                                        {!! Form::close() !!}
                                        @if ($weeks->verify_by_supervisor === 1)
                                            <div class="alert alert-success">
                                                <strong>Verified!</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
