@extends('layouts.itf_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Students to be verified</div>

                <div class="panel-body">
                    @if(!empty($itf->users))
                        <div class="table-responsive">          
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Students Name</th>
                                    <th>Students School</th>
                                    <th>Students Matric Number</th>
                                    <th>Company Name</th>
                                    <th>Company Address</th>
                                    <th>Verify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($itf->users as $itfusers)
                                    @if($itfusers->submitted_to_itf === 1)
                                        <tr>
                                            <td>{{$itfusers->lastname}} {{$itfusers->firstname}}</td>
                                            <td>{{$itfusers->school}}</td>
                                            <td>{{$itfusers->matric_no}}</td>
                                            <td>{{$itfusers->company->name}}</td>
                                            <td>{{$itfusers->company->address}}</td>
                                            <td>
                                                <a href="{{action('ItfController@show', ['id'=>$itfusers->id])}}">
                                                    <button type="button" class="btn btn-success">
                                                        <i class="fa fa-btn fa-user"></i> Check Log Book
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(empty($itf->users))
                        <h4 style="text-align: center; color: grey;">No student have submitted</h4>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">List of students already verified</div>

                <div class="panel-body">
                    @if(!empty($itf->users))
                        <div class="table-responsive">          
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Students Name</th>
                                    <th>Students School</th>
                                    <th>Students Matric Number</th>
                                    <th>Company Name</th>
                                    <th>Company Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($verified as $verified_users)
                                    @if($verified_users->verified_by_itf === 1)
                                        <tr>
                                            <td>{{$verified_users->lastname}} {{$verified_users->firstname}}</td>
                                            <td>{{$verified_users->school}}</td>
                                            <td>{{$verified_users->matric_no}}</td>
                                            <td>{{$verified_users->company->name}}</td>
                                            <td>{{$verified_users->company->address}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(empty($itf->users))
                        <h4 style="text-align: center; color: grey;">No student have submitted</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection