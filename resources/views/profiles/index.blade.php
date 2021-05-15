@extends('layouts.master')
@section('title', 'Users')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">My Profile</h1>
            {{-- <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Users</a> --}}
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('profiles.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}">

                        @include('layouts.partials._error', [
                        'name' => 'name'
                        ])
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">

                        @include('layouts.partials._error', [
                        'name' => 'email'
                        ])
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Kosongkan jika tidak mengganti password">

                        @include('layouts.partials._error', [
                        'name' => 'password'
                        ])
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control">

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection