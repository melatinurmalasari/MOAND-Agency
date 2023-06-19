@extends('template.auth-main')

@section('css')
	<link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
@endsection

@section('content')
	<section class="login d-flex">
		<div class="login-left w-100 h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-10">
					<div class="header">
						<h1>Masuk ke Angga Snack Official</h1>
					</div>
					<div class="login-form">
						<form action="/login" method="POST">
							@csrf
							<label for="email" class="form-label">Email atau Nama Pengguna</label>
							<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
								name="email">
							@if ($errors->has('email'))
								<p class="mt-2 text-danger">{{ $errors->first('email') }}</p>
							@endif
							<label for="password" class="form-label">Kata Sandi <a href="/lupa-password" class="text-decoration-none">Lupa
									Kata
									Sandi?</a></label>
							<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
								name="password">
							@if ($errors->has('password'))
								<p class="mt-2 text-danger">{{ $errors->first('password') }}</p>
							@endif
							<button class="signin">Masuk</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="login-right">
			<img src="{{ asset('auth/images/wrap.png') }}">
		</div>
	</section>
@endsection
