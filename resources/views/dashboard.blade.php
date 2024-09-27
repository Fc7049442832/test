{{-- extends layout file --}}
@extends('layout')

{{-- Hero section --}}
@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-6 mt-5">
            <h2>
                Welcome to  {{Auth::user()->name}}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center text-center mt-4 fs-4">
        <div class="col-md-2  col-12 m-1">
            <a href="{{route('companies.index')}}" class="btn btn-primary"><h3>Companies</h3></a>
        </div>
        <div class="col-md-2 col-12 m-1">
            <a href="{{route('employees.index')}}" class="btn btn-primary"><h3>Employees</h3></a>
        </div>
        
        
    </div>
@endsection