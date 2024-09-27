@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class=" col-12">
            <h2>Employees</h2>
            {{-- Success message (ADD, Edit and Delete) --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- Employee Add Button --}}
            <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create New Employee</a>
            {{-- Employees Details in Table  --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    {{-- @if ($employee->profile_picture)
                        <img src="{{ Storage::url($employee->profile_picture) }}" alt="Profile Picture" width="100px">
                    @endif --}}
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->company->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                           
                            <td><img src="{{ asset('storage/' . $employee->profile_picture) }}" width="50"></td>
                            <td>
                                {{-- Single Employee Details Edit page link --}}
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                                {{-- Single Employee Details Delete Btn --}}
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $employees->links() }} <!-- Pagination links -->
        </div>
    </div>
@endsection
