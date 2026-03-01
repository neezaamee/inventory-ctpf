@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Update Profile Information -->
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Profile Information</h3>
                <p class="text-muted text-sm mb-0 d-block w-100 float-start mt-2">Update your account's profile information and email address.</p>
            </div>
            
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 text-warning">
                                <p class="text-sm">
                                    Your email address is unverified.
                                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">Click here to re-send the verification email.</button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="text-success fw-medium text-sm mt-2">
                                        A new verification link has been sent to your email address.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary">Save Profile Info</button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-success text-sm mb-0">Saved.</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Update Password -->
        <div class="card card-warning card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
                <p class="text-muted text-sm mb-0 d-block w-100 float-start mt-2">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div class="card-body">
                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password">
                        @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password">
                        @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-warning">Update Password</button>
                    @if (session('status') === 'password-updated')
                        <p class="text-success text-sm mb-0">Saved.</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Delete Account -->
        <div class="card card-danger card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Delete Account</h3>
                <p class="text-muted text-sm mb-0 d-block w-100 float-start mt-2">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('delete')
            
            <div class="modal-header">
                <h5 class="modal-title" id="confirmUserDeletionLabel">Are you sure you want to delete your account?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                
                <div class="mb-3 mt-4">
                    <label for="delete_current_password" class="form-label visually-hidden">Password</label>
                    <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="delete_current_password" name="password" placeholder="Password" focused>
                    @error('password', 'userDeletion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </div>
        </form>
    </div>
</div>

@endsection
