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
                        @if ($user->submitted_to_itf === 1)
                            <div class="alert alert-success">
                                <h4 style="text-align: center; color: grey;">You just submitted your log book to ITF</h4>
                            </div>
                        @endif
                        @if ($user->submitted_to_supervisor === 1)
                            <div class="alert alert-success">
                                <h4 style="text-align: center; color: grey;">Wait for your logbook to be verified by ITF</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
