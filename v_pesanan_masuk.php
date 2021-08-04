<div class="col-sm-12">

	<?php
	if ($this->session->flashdata('pesan')) {
		echo '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="icon fas fa-check"></i> Success!   ';
		echo $this->session->flashdata('pesan');
		echo '</h5></div>';
	} ?>

	<div class="card card-primary card-outline card-outline-tabs">
		<div class="card-header p-0 border-bottom-0">
			<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Masuk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Diproses</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content" id="custom-tabs-four-tabContent">
				<div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

					<!-- table untuk pesanan masuk -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Tanggal</th>
								<th>Tujuan</th>
								<th>Penerima</th>
								<th>No HP</th>
								<th>Menu</th>
								<!-- <th>Jumlah Pesan</th> -->
								<th>Total Bayar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($pesanan as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td><?= $value->alamat ?></td>
									<td><?= $value->nama_penerima ?></td>
									<td><?= $value->no_hp ?></td>
									<td><?= $value->nama_menu ?></td>
									<!-- <td><?= $value->qty ?></td> -->
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<?php if ($value->status_bayar == 0) { ?>
											<span class="badge badge-warning">Belum Bayar</span>
										<?php	} else { ?>
											<span class="badge badge-success">Sudah Bayar</span><br>
											<span class="badge badge-primary">Menunggu Konfirmasi</span>
										<?php } ?>
									</td>
									<td>
										<?php if ($value->status_bayar == 1) { ?>
											<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#cek<?= $value->id_transaksi ?>">Cek Bukti Bayar</button>
											<a href="<?= base_url('admin/proses/' . $value->id_transaksi) ?>" class="btn btn-sm btn-info">Proses</a>
										<?php } ?>

									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>

				</div>
				<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

					<!-- table untuk pesanan diproses dan kirim -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Tanggal</th>
								<th>Total Bayar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($pesanan_diproses as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-primary">Sedang Diproses</span>
									</td>
									<td>
										<?php if ($value->status_bayar == 1) { ?>
											<a href="<?= base_url('admin/kirim/' . $value->id_transaksi) ?>" class="btn btn-sm btn-info"><i class="fa fa-paper-plane"></i> Kirim</a>
										<?php } ?>

									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">

					<!-- table untuk pesanan dikirim -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Tanggal</th>
								<th>Total Bayar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($pesanan_dikirim as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-success">Pesanan Dikirim</span>
									</td>
									<td>
									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
					<!-- table untuk pesanan dikirim -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Tanggal</th>
								<th>Total Bayar</th>
								<th>Info</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($pesanan_selesai as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-info">Diterima</span>
									</td>
									<td>Pesanan Selesai</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.card -->
	</div>
</div>

<?php foreach ($pesanan as $key => $value) { ?>
	<!-- Modal Cek Bukti Pembayaran -->
	<div class="modal fade" id="cek<?= $value->id_transaksi ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Pesanan Masuk Ke : <?= $value->id_transaksi ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-hover">
						<tr>
							<th>Nama Bank</th>
							<th>:</th>
							<td><?= $value->nama_bank ?></td>
						</tr>
						<tr>
							<th>Nomor Rekening</th>
							<th>:</th>
							<td><?= $value->no_rek ?></td>
						</tr>
						<tr>
							<th>Atas Nama</th>
							<th>:</th>
							<td><?= $value->atas_nama ?></td>
						</tr>
						<tr>
							<th>Total Bayar</th>
							<th>:</th>
							<td>Rp. <?= number_format($value->total_bayar, 0) ?></td>
						</tr>
					</table>
					<img class="img-fluid pad" src="<?= base_url('assets/bukti_bayar/' . $value->bukti_bayar) ?>" alt="">
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>
