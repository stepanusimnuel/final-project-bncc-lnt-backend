@extends('partials.main')

@section('container')
<div class="container mt-4">
    <h1 class="text-center mb-4">Register Page</h1>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <form method="post" action="/register">
                @csrf
                <div class="mb-3 form-floating">
                    <input type="text" name="first_name" class="form-control @error('first_name')
                        is-invalid
                    @enderror" id="first_name" placeholder="First Name" value="{{old('first_name')}}">
                    <label for="first_name" class="form-label">First Name</label>

                    @error('first_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="last_name" class="form-control @error('last_name')
                        is-invalid
                    @enderror" id="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                    <label for="last_name" class="form-label">Last Name</label>

                    @error('last_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" class="form-control @error('email')
                        is-invalid
                    @enderror" id="email" placeholder="email@example.org" value="{{old('email')}}">
                    <label for="email" class="form-label">Email address</label>

                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" name="password" class="form-control @error('password')
                        is-invalid
                    @enderror" id="password" placeholder="Password">
                    <label for="password" class="form-label">Password</label>

                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <p class="text-center">Already have account?
                    <a href="/login">Login here</a>
                </p>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
