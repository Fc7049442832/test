{{-- extends layout file --}}
@extends('layout')

{{-- Hero section --}}
@section('content')
<div class="row p-5 justify-content-center">
    <div class="col-md-6 col-12">
        
        <form action="{{route('register')}}" method="POST">
            <h2 class="mb-4">Register</h2>
            @csrf
            <div class="form-group">
                <label for="Type">Type</label>
                <select name="type" id="" required>
                    <option value="0">Employee</option>
                    <option value="1">Company</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Full Name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email I'd(ex. 'abc@example.com')" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter Your Password " required>
            </div>

            <button type="submit" class="btn btn-success">Register</button>
            <a href="{{route('showLoginForm')}}">Old User</a>
        </form>
    </div>
</div>
@endsection