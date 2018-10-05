@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div style="text-align: center">
                        <img src="/images/{{$user->path}}" alt="" height="20%" width="20%">
                        <br />
                        You can now fill the log books
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
