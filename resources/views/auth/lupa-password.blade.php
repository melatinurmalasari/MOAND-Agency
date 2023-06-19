@extends('template.auth-main')

@section('css')
	<link rel="stylesheet" href="{{ asset('auth/css/lupa_password.css') }}">
@endsection

@section('content')
	<section class="password d-flex">
		<div class="password-left w-100 h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-10">
					<div class="header">
						<h1>Lupa Kata Sandi?</h1>
						<p>Masukkan alamat email yang Anda gunakan saat bergabung dan kami akan mengirimkan instruksi untuk mengatur ulang
							kata sandi Anda melalui email anda.</p>
					</div>
					<div class="password-form">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email">
						<button class="submit">Kirim Instruksi</button>
					</div>
				</div>
			</div>
		</div>
		<div class="password-right">
			<img src="{{ asset('auth/images/wrap.png') }}">
		</div>
	</section>
@endsection
