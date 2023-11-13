<?php
// Panggil file koneksi.php
require_once 'koneksi.php';

// Ambil data dari form tambah siswa
$nama = $_POST['Nama'];
$jumlah = $_POST['Jumlah'];
$harga = $_POST['Harga'];

// Validasi input
if (empty($nama) || empty($jumlah) || empty($harga)) {
    die("Harap lengkapi semua kolom");
}

// Proses unggah Foto
$target_dir = "uploads/";
$unique_file_name = uniqid() . "_" . basename($_FILES["Foto"]["name"]);
$target_file = $target_dir . $unique_file_name;

if (!move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
    die("Gagal mengunggah file");
}

// Validasi file yang diunggah
$image_type = exif_imagetype($target_file);
$allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);

if (!in_array($image_type, $allowed_types)) {
    unlink($target_file); // hapus file yang diunggah karena bukan gambar
    die("File yang diunggah harus berupa gambar (JPEG, PNG, GIF)");
}

// Proses tambah data siswa ke database
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$stmt = $koneksi->prepare("INSERT INTO data_boneka (Nama, Jumlah, Harga, Foto) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die("Error: " . $koneksi->error);
}

$stmt->bind_param("ssss", $nama, $jumlah, $harga, $unique_file_name);

if ($stmt->execute()) {
    header('Location: index.html');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup koneksi database
$stmt->close();
$koneksi->close();

?>

<!-- Footer HTML -->
<footer>
    <p>&copy; Rumbon</p>
</footer>
