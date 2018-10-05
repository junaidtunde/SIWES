@extends('layouts.company_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Interns</div>

                <div class="panel-body">
                    @if (count($student))
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Matric Number</th>
                                        <th>Course</th>
                                        <th>Student Email</th>
                                        <th>Verify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $students)
                                        <tr>
                                            <td>{{$students->lastname}} {{$students->firstname}}</td>
                                            <td>{{$students->matric_no}}</td>
                                            <td>{{$students->course}}</td>
                                            <td>{{$students->email}}</td>
                                            <td>
                                                @if ($students->part_of_company === 0)
                                                        <a href="{{action('CompanyController@add', ['id'=>$students->id])}}">
                                                            <button type="button" class="btn btn-success">
                                                                    <i class="fa fa-btn fa-user"></i> Add
                                                            </button>
                                                        </a>
                                                        <a href="{{action('CompanyController@remove', ['id'=>$students->id])}}">
                                                            <button type="button" class="btn btn-danger">
                                                                    <i class="fa fa-btn fa-user"></i> Remove
                                                            </button>
                                                        </a>
                                                @elseif ($students->part_of_company === 1)
                                                        <a href="{{action('CompanyController@check', ['id'=>$students->id])}}">
                                                            <button type="button" class="btn btn-info">
                                                                    <i class="fa fa-btn fa-user"></i> Check On
                                                            </button>
                                                        </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection