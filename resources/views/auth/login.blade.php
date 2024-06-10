<!-- account/dashboard.blade.php -->

@extends('body.app')

@section('content')
<div>
  <main class="form-signin w-50 m-auto mt-4">
    <form action="{{ url('login_user') }}" method="post">
      @csrf
      <img class="mb-4" src="./images/login_page.svg" alt="" width="75" height="75">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating my-3">
        <input type="email" class="form-control" name="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating my-3">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
        <br>
        <a href="{{ url('/register') }}">Register</a>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-body-secondary">© 2023–2024</p>
    </form>
  </main>
</div>
@endsection