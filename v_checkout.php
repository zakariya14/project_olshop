	<!-- Main content -->
	<div class="invoice p-3 mb-3">
		<!-- title row -->
		<div class="row">
			<div class="col-12">
				<h4>
					<i class="fas fa-shopping-cart"></i> WarungSoto
					<small class="float-right">Tanggal : <?php
																								date_default_timezone_set("Asia/Jakarta");
																								$date = new DateTime('');
																								echo $date->format('d-m-Y');
																								?> <br> Jam : <?php
																															date_default_timezone_set("Asia/Jakarta");
																															$date = new DateTime('');
																															echo $date->format('H:i:s');
																															?> WIB</small>


					<?php  ?>
				</h4>
			</div>
			<!-- /.col -->
		</div>
		<!-- info row -->

		<!-- /.row -->

		<!-- Table row -->
		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Qty</th>
							<th>Menu</th>
							<th>Harga</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$i = 1;
						foreach ($this->cart->contents() as $items) { ?>
							<tr>
								<td><?php echo $items['qty']; ?></td>
								<td><?php echo $items['name']; ?></td>
								<td style="text-center">Rp. <?php echo number_format($items['price'], 0); ?></td>
								<td style="text-center">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<?php
		// menampilkan pesan error
		echo validation_errors('<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="icon fas fa-times"></i>', '</div>');
		?>

		<?php
		echo form_open('belanja/checkout');
		$no_transaksi = date('Ymd') . strtoupper(random_string('alnum', 10));
		?>
		<div class="row">
			<!-- accepted payments column -->
			<div class="col-sm-8 invoice-col">
				Tujuan :
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nama Penerima</label>
							<input type="text" name="nama_penerima" class="form-control" placeholder="Masukkan Nama" required></input>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>No Handphone</label>
							<input type="text" name="no_hp" class="form-control" placeholder="Masukkan No Handphone" required>
							</input>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap Anda" required>
							</input>
						</div>
					</div>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-4">
				<div class="table-responsive">
					<table class="table">
						<tr>
							<th style="width:">GrandTotal :</th>
							<td>
								<h4>Rp. <?php echo number_format($this->cart->total(), 0); ?> </h4>
							</td>
						</tr>
						<tr>
							<th>Ongkir:</th>
							<td><label>0</label></td>
						</tr>
						<tr>
							<th>Total Bayar:</th>
							<td>
								<h4>Rp. <?php echo number_format($this->cart->total(), 0); ?> </h4>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- awal simpan transaksi -->
		<input name="no_transaksi" value="<?= $no_transaksi; ?>" hidden>
		<input name="grand_total" value="<?php echo ($this->cart->total()); ?>" hidden>
		<input name="total_bayar" value="<?php echo ($this->cart->total()); ?>" hidden>
		<!-- akhir simpan transaksi -->

		<!-- awal simpan detail transaksi -->
		<?php
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			echo form_hidden('qty' . $i++, $items['qty']);
		}
		?>
		<!-- akhir simpan detail transaksi -->
		<div class="row no-print">
			<div class="col-12">
				<a href="<?= base_url('belanja') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali Ke Keranjang </a>
				<button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
					<i class="fas fa-shopping-cart"></i> Proses Checkout
				</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
	<!-- /.invoice -->


	<script>
		$(document).ready(function() {
			// data provinsi
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/provinsi') ?>",
				success: function(hasil_provinsi) {
					$("select[name=provinsi]").html(hasil_provinsi);
				}
			});

			// data kota
			$("select[name=provinsi]").on('change', function() {
				var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

				$.ajax({
					type: "POST",
					url: "<?= base_url('rajaongkir/kota') ?>",
					data: 'id_provinsi=' + id_provinsi_terpilih,
					success: function(hasil_kota) {
						$("select[name=kota]").html(hasil_kota);
					}
				});
			});


		});
	</script>
