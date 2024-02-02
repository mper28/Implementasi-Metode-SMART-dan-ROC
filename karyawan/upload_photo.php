<?php
session_start();
include '../koneksi.php';

if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo = $_FILES['photo'];

    // Periksa tipe file gambar
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($photo['type'], $allowedTypes)) {
        echo "<script>alert('Tipe file tidak valid. Hanya file JPG dan PNG yang diizinkan.'); window.location='data_karyawan.php';</script>";
        exit;
    }

    // Periksa ukuran file gambar
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($photo['size'] > $maxFileSize) {
        echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.'); window.location='data_karyawan.php';</script>";
        exit;
    }

    // Generate nama unik untuk file gambar
    $fileName = uniqid() . '_' . $photo['name'];

    // Pindahkan gambar ke folder tujuan
    $destination = '../uploads/' . $fileName;
    if (move_uploaded_file($photo['tmp_name'], $destination)) {
        // Simpan nama file gambar ke database
        $id = $_SESSION['id'];
        $query = mysqli_query($koneksi, "UPDATE data_karyawan SET foto_karyawan='$fileName' WHERE id_karyawan='$id'");

        if ($query) {
            echo "<script>alert('Gambar profil berhasil diunggah.'); window.location='data_karyawan.php';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan dalam mengunggah gambar.'); window.location='data_karyawan.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Terjadi kesalahan dalam mengunggah gambar.'); window.location='data_karyawan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Terjadi kesalahan dalam mengunggah gambar.'); window.location='data_karyawan.php';</script>";
    exit;
}
?>
