@extends('layout')

@section('content')
    <div class="container">
        <h2>Companies</h2>
        {{-- Success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- Create Button --}}
        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Create New Company</a>
        {{-- INDEX TABLE --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td><img src="{{ asset('storage/' . $company->logo) }}" width="50"></td>
                        <td>
                            {{-- Edit page Link --}}
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                            {{-- Row data delete btn --}}
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $companies->links() }} <!-- Pagination links -->
    </div>
@endsection
