@extends('partials.main')

@section('container')
<div class="container mt-4">
    <h1 class="text-center mb-4">Login Page</h1>

    <div class="row justify-content-center">
        <div class="col-md-5">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="post" action="/login">
                @csrf
                <div class="mb-3 form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="email@example.org" value="{{old('email')}}" autofocus>
                    <label for="email" class="form-label">Email address</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                    <label class="form-check-label" for="remember_me">Ingat saya?</label>
                </div>
                <p class="text-center">Don't have account?
                    <a href="/register">Register here</a>
                </p>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
