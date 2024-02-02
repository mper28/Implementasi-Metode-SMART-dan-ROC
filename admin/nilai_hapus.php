<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "DELETE FROM data_nilai WHERE id_pelanggan= '$_GET[id_pelanggan]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_nilai.php'</script>";

?>