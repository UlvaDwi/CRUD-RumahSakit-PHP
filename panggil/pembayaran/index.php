<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
	border: 3px solid #f1f1f1;
	background-color: white;
	font-family: arial;
	width: 500px;
	margin: auto;
}
	</style>
</head>
<body>

</body>
</html>
<?php
	/*Skrip ini tidak menggunakan OOP
	/*Memanggil file koneksi hanya satu kali*/
	require_once('koneksi.php');

	$query 	= "SELECT pembayaran.*, view_passien.nama_pasien, view_pembayaranobat.totalObat, view_pembayarankamar.bayarkamar FROM pembayaran INNER JOIN view_passien ON pembayaran.id_inap = view_passien.id_inap INNER JOIN view_pembayaranobat ON pembayaran.id_inap = view_pembayaranobat.id_inap INNER JOIN view_pembayarankamar ON pembayaran.id_inap = view_pembayarankamar.id_inap";
	$link 	= "index.php?lihat=pembayaran/";
?>
<div class="row">
	<div class="col-lg-12">
		<h3 class = "text-primary">Data Pembayaran</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- Tombol Tambah -->
		<a href="<?= $link.'tambah' ?>" class="btn btn-success btn-sm">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</a>
		<!-- Menampilkan Tabel -->
		<div class="box-body table-responsive no-padding">
		<table class="table table-hover table-bordered" style="margin-top: 10px">
			<tr class="info">
				<th>No</th>
				<th>Kode Pembayaran</th>
				<th>Tanggal Pembayaran</th>
				<th>Id Inap</th>
				<th>Nama Pasien</th>
				<th>Harga Kamar</th>
				<th>Total Obat</th>
				<th>Total Bayar</th>
				<th style="text-align: center;">Aksi</th>	
			</tr>
			<?php
			if($data = mysqli_query($koneksi,$query)){
				$no=1;
				while($tampil = mysqli_fetch_object($data)){
				?>

					<tr>
						<td><?= $no ?></td>
						<td><?= $tampil->id_pembayaran?></td>
						<td><?= $tampil->tanggal?></td>
						<td><?= $tampil->id_inap?></td>
						<td><?= $tampil->nama_pasien?></td>
						<td><?= $tampil->bayarkamar?></td>
						<td><?= $tampil->totalObat?></td>
						<td><?= $tampil->total?></td>
						<td style="text-align: center;">
							<a href="<?= $link.'edit&id_pembayaran='.$tampil->id_pembayaran ?>" class="btn btn-primary btn-sm">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?= $link.'hapus&id_pembayaran='.$tampil->id_pembayaran ?>" class="btn btn-danger btn-sm">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
					</tr>
				
				<?php
					$no++;
				}//Tutup while
			}//Tutup if
			?>

		</table>
		</div><!-- .table-responsive -->
	</div>
</div>