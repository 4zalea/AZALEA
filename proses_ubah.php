<?php
// Memulai koneksi ke database
require_once 'koneksi.php';

// Mengambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['jumlah'];
$no_presensi = $_POST['harga'];

// Mengecek apakah ada file Foto yang diupload
if (isset($_FILES['Foto']['name']) && $_FILES['foto']['name'] != '') {
    // Mengambil Nama file dan direktori sementara
    $filename = $_FILES['Foto']['name'];
    $tempname = $_FILES['Foto']['tmp_name'];

    // Menghapus Foto lama
    $query = "SELECT foto FROM data_boneka WHERE Nomor=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $Foto_lama = $data['foto'];
    unlink('uploads/'.$Foto_lama);

    // Memindahkan file Foto dari direktori sementara ke direktori yang ditentukan
    move_uploaded_file($tempname, 'uploads/'.$filename);

    // Menyimpan Nama file ke database
    $query = "UPDATE data_boneka SET nama=?, jumlah=?, harga=?, foto=? WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $nama, $kelas, $no_presensi, $filename, $id);
} else {
    // Jika tidak ada file Foto yang diupload, hanya update data siswa tanpa mengubah Foto
    $query = "UPDATE data_boneka SET nama=?, jumlah=?, harga=? WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssi", $nama, $kelas, $no_presensi, $id);
}

// Menjalankan query untuk mengupdate data siswa
if ($stmt->execute()) {
    header('Location: index.html');
} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi ke database
$stmt->close();
$koneksi->close();
?>