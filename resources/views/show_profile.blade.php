@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <image src="/uploads/avatars/{{ $user->avatar }}" style="width:350px; height:350px; border-radius:50%; margin-bottom:10px;">
                <form enctype="multipart/form-data" action="/profile/avatar" method="post">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-sm btn-primary" value="Upload Profile">
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif

                        <form action="{{ route('edit_profile') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="Role">Role</label>
                                <input type="text" name="role" class="form-control" value="{{ $user->is_admin ? 'Admin' : 'Member' }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Password">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Change Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
