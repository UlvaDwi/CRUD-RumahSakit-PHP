<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
	border: 3px solid #f1f1f1;
	background-color: white;
	/*font-family: arial;*/
	font-size: 15px;
	padding: 10px;
	border-radius: 30px;
}
	</style>
</head>
<body>

</body>
</html><?php
	/*Skrip ini tidak menggunakan OOP
	/*Memanggil file koneksi hanya satu kali*/
	require_once('koneksi.php');

	$query 	= "SELECT * FROM pasien";
	$link 	= "index.php?lihat=pasien/";
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class = "text-primary">Data Pasien</h3>
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
				<th>Id Pasien</th>
				<th>Nama Pasien</th>
				<th>Jenis Kelamin</th>
				<th>No Telp</th>
				<th>Alamat</th>
				<th style="text-align: center;">Aksi</th>
			</tr>
			
			<?php
			if($data = mysqli_query($koneksi,$query)){
				$no=1;
				while($tampil = mysqli_fetch_object($data)){
				?>

					<tr>
						<td><?= $no ?></td>
						<td><?= $tampil->id_pasien ?></td>
						<td><?= $tampil->nama_pasien?></td>
						<td><?= $tampil->jk ?></td>
						<td><?= $tampil->no_telp ?></td>
						<td><?= $tampil->alamat ?></td>
						<td style="text-align: center;">
							<a href="<?= $link.'edit&id_pasien='.$tampil->id_pasien ?>" class="btn btn-primary btn-sm">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?= $link.'hapus&id_pasien='.$tampil->id_pasien ?>" class="btn btn-danger btn-sm">
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