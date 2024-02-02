<?php
include 'src/header.php';

if(isset($_GET['id_kriteria'])){
    $id = $_GET['id_kriteria'];
  
    // Hapus data kriteria dari database
    $hapus = mysqli_query($koneksi, "DELETE FROM data_kriteria WHERE id_kriteria = '$id'");
  
    if($hapus){
        echo "<script>alert('Data berhasil dihapus');window.location='data_kriteria.php';</script>";
    }else{
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}else{
    echo "<script>alert('ID Kriteria tidak ditemukan');</script>";
    echo "<script>window.location='data_kriteria.php';</script>";
}

include 'src/footer.php';
?>