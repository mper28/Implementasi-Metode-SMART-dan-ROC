<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "DELETE FROM data_karyawan WHERE id_karyawan = '$_GET[id_karyawan]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_admin.php'</script>";

?>