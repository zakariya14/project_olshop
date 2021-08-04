<?php
if ($this->session->flashdata('pesan')) {
	echo '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i> Success!';
	echo $this->session->flashdata('pesan');
	echo '</h5></div>';
} ?>
<div class="col-sm-12">
	<div class="card card-primary card-outline card-outline-tabs">
		<div class="card-header p-0 border-bottom-0">
			<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Saya</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Diproses</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Diterima</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content" id="custom-tabs-four-tabContent">
				<div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

					<!-- table untuk pesanan saya -->
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
							foreach ($belum_bayar as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
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
										<?php if ($value->status_bayar == 0) { ?>
											<a href="<?= base_url('pesanan_saya/bayar/' . $value->id_transaksi) ?>" class="btn btn-sm btn-flat btn-info">Bayar Sekarang</a>
										<?php } ?>

									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>

				</div>
				<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

					<!-- table untuk pesanan diproses -->
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
							foreach ($diproses as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-primary">Sudah Dikonfirmasi</span><br>
										<span class="badge badge-success">Pesanan Sedang Diproses</span><br>
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
								<th>Info</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($dikirim as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-primary">Pesanan Dikirim</span><br>
									</td>
									<td><b>Silahkan Tunggu</b></td>
									<td><a href="<?= base_url('pesanan_saya/diterima/' . $value->id_transaksi) ?>" class="btn btn-success btn-sm">Pesanan Diterima</a></td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">

					<!-- table untuk pesanan selesai -->
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
							foreach ($selesai as $key => $value) { ?>
								<tr>
									<td><?= $value->no_transaksi ?></td>
									<td><?= $value->tgl_transaksi ?></td>
									<td>
										<b>Rp. <?= number_format($value->total_bayar, 0) ?></b> <br>
										<span class="badge badge-primary">Pesanan Selesai</span><br>
									</td>
									<td><b>Selamat Menikmati</b></td>
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
<br><br><br><br><br><br><br><br><br><br>
