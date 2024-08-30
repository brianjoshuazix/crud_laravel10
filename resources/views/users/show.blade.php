@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Details') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->id }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Prefix Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->prefixname }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->firstname }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->middlename }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->lastname }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Suffix Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->suffixname }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->username }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->type }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo">{{ __('Photo') }}</label>
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->firstname }}'s Photo" class="img-thumbnail" style="max-width: 200px;">
                        @else
                            <p>{{ __('No photo available') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Created At') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->created_at }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Updated At') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->updated_at }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('users.index') }}" class="btn btn-primary">{{ __('Back to Users List') }}</a>
                        </div>
                    </div>
                    <!-- Delete Button -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
