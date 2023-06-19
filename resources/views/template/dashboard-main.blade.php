<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }}</title>
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<!-- Style CSS -->
	@yield('css')
	<!-- Fonts Google -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<!-- Logo Title Bar -->
	<link rel="icon" href="{{ asset('dashboard/images/MOAND Agency 1.png') }}" type="image/x-icon">
	<!-- Icon Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Option 1: Include in HTML -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="{{ asset('dashboard/images/anggasnack.png') }}" alt="" width="130"height="80"
					class="align-text-top d-inline-block">
			</a>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="mb-2 navbar-nav me-auto mb-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Pembelian Grosir
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="/oleh-oleh">Oleh-Oleh</a></li>
							<li><a class="dropdown-item" href="/reseller">Reseller</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/eceran">Pembelian Eceran</a>
					</li>
				</ul>
				<div class="shopping">
					<i data-bs-toggle="modal" data-bs-target="#drafModal" class="fa-solid fa-bag-shopping fa-xl"></i>
				</div>
				<button type="button" data-bs-toggle="modal" data-bs-target="#profileModal" class="btn-profile">Profile</button>
			</div>
		</div>
	</nav>
	<!-- Maincontent -->
	@yield('content')
	<!-- End Maincontent -->
	@yield('js')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
	</script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	@if (session('success'))
		<script>
			swal({
				title: "Berhasil!",
				text: "{{ session('success') }}",
				icon: "success",
				button: "OK",
			});
		</script>
	@endif
</body>

</html>
