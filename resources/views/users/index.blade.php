@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Users List') }}<br>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-success float-center">
                        {{ __('Add User') }}
                    </a>
                    <!-- Add a link to view trashed users -->
                    <a href="{{ route('users.trashed') }}" class="btn btn-outline-dark float-right">View Trashed Users</a>

                </div>


                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Prefix Name') }}</th>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->prefixname }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary">
                                            {{ __('View') }}
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning">
                                            {{ __('Edit') }}
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('No users found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
