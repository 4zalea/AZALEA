<!DOCTYPE html>
<html>
<head>
	<title>Ubah Boneka</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<h1>Ubah Boneka</h1>
		<?php
			// Memulai koneksi ke database
			include 'koneksi.php';

			// Mengambil id siswa dari parameter URL
			$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

			// Query untuk mengambil data siswa berdasarkan id
			$query = "SELECT * FROM data_boneka WHERE id='$id'";
			$result = mysqli_query($koneksi, $query);

			// Mengubah data menjadi bentuk array
			$data = mysqli_fetch_array($result);
		?>
		<form action="proses_ubah.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">
			<label>Nama:</label>
			<input type="text" name="nama" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" required>

			<label>Jumlah:</label>
            <input type="number" name="jumlah" value="<?php echo isset($data['jumlah']) ? $data['jumlah'] : ''; ?>" required>

			<label>Harga</label>
            <input type="number" name="harga" value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" required>

			<label>Foto:</label>
			<?php
				if (isset($data['foto']) && $data['foto']) {
				  echo '<img src="uploads/'.$data['foto'].'" class="your-image-class">';
				} else {
				  echo 'Tidak ada Foto';
				}
			?>
			<input type="file" name="foto" accept="image/*">

			<div class="buttons">
				<button type="submit">Ubah Boneka</button>
				<button id="cancel-button" onclick="location.href='index.html'">Cancel</button>
			</div>
		</form>
	</div>
</body>
</html>
