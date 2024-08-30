@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <h1>Trashed Users</h1>

    @if ($trashedUsers->isEmpty())
        <p>No trashed users found.</p>
    @else
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Prefix Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->prefixname }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->deleted_at }}</td>
                    <td>
                        <!-- Restore Button -->
                        <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-success float-center">Restore</button>
                        </form>

                        <!-- Permanently Delete Button -->
                        <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to permanently delete this user?')">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('users.index') }}" class="btn btn-outline-dark">Back to Users List</a>
</div>
@endsection
