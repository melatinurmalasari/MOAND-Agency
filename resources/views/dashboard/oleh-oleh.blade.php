@extends('template.dashboard-main')

@section('css')
	<link rel="stylesheet" href="{{ asset('dashboard/css/reseller.css') }}">
@endsection

@section('content')
	<div class="wrapper">
		<div class="text-center col-lg-8 offset-lg2">
			<div class="h-search-form">
				<form action="/oleh-oleh/barang" method="GET">
					<input type="search" name="keyword" placeholder="Mau cari apa...">
					<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
				</form>
			</div>
		</div>
		<div class="item">
			<button type="button" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn-item">
				<i class="fa-solid fa-plus"></i>Tambah Barang
			</button>
		</div>

		<div class="mt-3 container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="table">
						<table id="myTable" class="table">
							<thead align="center">
								<tr>
									<th>Nama</th>
									<th>Terjual</th>
									<th>Tersedia</th>
									<th>Harga</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody align="center">
								@foreach ($barang as $item)
									<tr>
										<td>
											<p>{{ $item->nama }}</p>
											<input id="nama{{ $item->id }}" type="hidden" value="{{ $item->nama }}">
										</td>
										<td>
											<input type="text" value="{{ $item->terjual }}">
										</td>
										<td>
											<input id="stock{{ $item->id }}" type="text" value="{{ $item->stok }}">
										</td>
										<td>
											<input type="text" value="Rp {{ number_format($item->harga, 0, ',', '.') }}" class="price" disabled>
											<input id="harga{{ $item->id }}" type="hidden" value="{{ $item->harga }}">
										</td>
										<td>
											<div class="button-container">
												<button id="min-qty{{ $item->id }}" onclick="minQty({{ $item->id }})" class="cart-qty-minus"
													type="button" value="-">-</button>
												<input type="text" name="qty" class="qty form-control" value="0"
													id="qty-barang{{ $item->id }}">
												<button id="add-qty{{ $item->id }}" onclick="addQty({{ $item->id }})" class="cart-qty-plus"
													type="button" value="+">+</button>
												<input id="result-qty-barang{{ $item->id }}" type="hidden" name="quantity" value="0">
											</div>
										</td>
										<td>
											<button type="button" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
												class="btn-edit">
												<i class="fa-solid fa-pen-to-square"></i>
											</button>
										</td>
										<td>
											<button id="chart{{ $item->id }}" onclick="addToChart({{ $item->id }})" type="button"
												class="btn-cart">
												<i class="fa-solid fa-cart-shopping"></i>
											</button>
										</td>
									</tr>
									<!-- Modal Edit-->
									<div class="editModal modal fade" id="editModal{{ $item->id }}" tabindex="-1"
										aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form action="/oleh-oleh/barang/{{ $item->id }}" method="POST">
													@csrf
													@method('PUT')
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<label>Nama Barang</label>
															<input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
															<label>Harga Barang</label>
															<input type="text" name="harga" class="form-control" value="{{ $item->harga }}" required>
															<label>Jumlah Barang</label>
															<button onclick="deleteStock({{ $item->id }})" type="button" class="btn btn-delete"><i
																	class="fa-solid fa-trash-can"></i></button>
															<button onclick="minStock({{ $item->id }})" type="button" class="btn-less">
																<i class="fa-solid fa-square-minus"></i>
															</button>
															<button type="button" class="btn-number">
																<input value="{{ $item->stok }}" id="stock-barang{{ $item->id }}">
															</button>
															<button onclick="addStock({{ $item->id }})" type="button" class="btn-add">
																<i class="fa-solid fa-square-plus"></i>
															</button>
															<input id="result-stock-barang{{ $item->id }}" type="hidden" name="stok"
																value="{{ $item->stok }}">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-drop btn-dismiss" data-bs-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-save">Simpan Perubahan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Tambah-->
	<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="/oleh-oleh/barang" method="POST">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Barang</label>
							<input type="text" name="nama" class="form-control" required>
							<label>Harga Barang</label>
							<input type="text" name="harga" class="form-control" required>
							<label>Jumlah Barang</label>
							<button id="btn-less-jumlah-barang" type="button" class="btn-less">
								<i class="fa-solid fa-square-minus"></i>
							</button>
							<button type="button" class="btn-number">
								<input value="0" id="jumlah-barang">
							</button>
							<button id="btn-add-jumlah-barang" type="button" class="btn-add">
								<i class="fa-solid fa-square-plus"></i>
							</button>
							<input id="result-jumlah-barang" type="hidden" name="stok" value="0">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-batal btn-dismiss" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-tambah">Tambahkan Barang</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Modal Draf -->
	<div class="modal fade" id="drafModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Draf Pesanan Pelanggan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table">
						<table id="myTable" class="table">
							<thead align="center">
								<tr>
									<th>Nama</th>
									<th>Harga</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody align="center" id="tabel-draf-pesanan">
								<tr id="nothingOrder">
									<td colspan="3">Tidak ada pesanan</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<div class="gap-2 mx-auto d-grid col-12">
						<form action="/oleh-oleh/checkout" method="POST">
							@csrf
							<input id="dataPesanan" type="hidden" name="data_pesanan">
							<button type="submit" class="btn btn-lg btn-checkOut">Check Out</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Sidebar -->
	<div class="card">
		<h1>Pesanan Pelanggan</h1>
		<ul style="list-style-type: none;">
			<li><a href="#" class="draf">Draf Semuanya</a></li>
			<li><a href="#" class="delete">Hapus Semuanya</a></li>
		</ul>
		<hr>
		<div class="checkOut">
			<button type="button" class="btn-print">Cetak Nota</button>
			<button type="button" class="btn-cancel">Batalkan Pesanan</button>
		</div>
	</div>
	</div>


	<!-- Modal Profile -->
	<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" value="{{ Auth::user()->nama }}" disabled>
					</div>
				</div>
				<div class="modal-footer">
					<div class="gap-2 mx-auto d-grid col-12">
						<a href="/logout"><button type="button" class="btn btn-lg btn-out">Keluar</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('dashboard/js/reseller.js') }}"></script>
@endsection
