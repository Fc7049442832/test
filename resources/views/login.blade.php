{{-- extends layout file --}}
@extends('layout')

{{-- Hero section --}}
@section('content')
<div class="row p-5 justify-content-center">
    <div class="col-md-6 col-12">
        {{-- error message show --}}
        @foreach($errors->all() as $error)
        <li class="text-danger">{{$error}}</li>
        @endforeach

        {{-- warning (url hit)--}}
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('warning') }}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form Start --}}
        <form action="{{route('login')}}" method="POST">
            <h2 class="mb-3">Login</h2>
            @csrf
            <div class="form-group">
                <label for="Type">Type</label>
                <select name="type" id="" required>
                    <option value="0">Company</option>
                    <option value="1">Employee</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email I'd" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" required>
            </div>
            {{-- Form Submit Button --}}
            <button type="submit" class="btn btn-success">Login</button>
           
        </form>
    </div>
</div>
@endsection