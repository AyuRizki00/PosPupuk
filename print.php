<?php
@ob_start();
session_start();
if (!empty($_SESSION['admin'])) {
} else {
	echo '<script>window.location="login.php";</script>';
	exit;
}
require 'config.php';
include $view;
$lihat = new view($config);
$toko = $lihat->toko();
$hsl = $lihat->penjualan();
?>
<html>

<head>
	<title>print</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
	<script>
		window.print();
	</script>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<center>
					<p><?php echo $toko['nama_toko']; ?></p>
					<p><?php echo $toko['alamat_toko']; ?></p>
					<p>Tanggal : <?php echo date("j F Y, G:i"); ?></p>
					<p>Kasir : <?php echo htmlentities($_GET['nm_member']); ?></p>
				</center>
				<style>
					.table {
						width: 100%;
						border-collapse: collapse;
					}

					.table td {
						border: 1px solid black;
						padding: 8px;
						text-align: center;
					}
				</style>
				<table class="table">
					<tr>
						<td style="border: 1px solid black; text-align: center;">No.</td>
						<td style="border: 1px solid black;">Barang</td>
						<td style="border: 1px solid black; text-align: center;">Jumlah</td>
						<td style="border: 1px solid black;">Total</td>
					</tr>
					<?php $no = 1;
					foreach ($hsl as $isi) { ?>
						<tr>
							<td style="border: 1px solid black; text-align: center; padding: 8px;"><?php echo $no; ?></td>
							<td style="border: 1px solid black; padding: 8px;"><?php echo $isi['nama_barang']; ?></td>
							<td style="border: 1px solid black; text-align: center; padding: 8px;"><?php echo $isi['jumlah']; ?></td>
							<td style="border: 1px solid black; padding: 8px;"><?php echo $isi['total']; ?></td>
						</tr>
					<?php $no++;
					} ?>
				</table>
				<br>
				<br>
				<div class="pull-right">
					<?php $hasil = $lihat->jumlah(); ?>
					Total : Rp.<?php echo number_format($hasil['bayar']); ?>,-
					<br />
					Bayar : Rp.<?php echo number_format(htmlentities($_GET['bayar'])); ?>,-
					<br />
					Kembali : Rp.<?php echo number_format(htmlentities($_GET['kembali'])); ?>,-
				</div>
				<div class="clearfix"></div>
				<center>
					<p>Terima Kasih Telah berbelanja di toko kami !</p>
				</center>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>

</html>