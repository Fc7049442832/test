{{-- extends layout file --}}
@extends('layout')

{{-- Hero section --}}
@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-6 mt-5">
            <h2>
                Welcome To ABC Company
            </h2>
        </div>
    </div>
    <div class="row justify-content-center mt-4 fs-4">
        {{-- <div class="col-md-1 col-4">
          <a href="{{route('showForm')}}" class="btn btn-primary p-2">Registration</a>
        </div> --}}
        <div class="col-md-1 col-4">
            <a href="{{route('showLoginForm')}}" class="btn btn-primary p-2">Login</a>
        </div>
    </div>
@endsection