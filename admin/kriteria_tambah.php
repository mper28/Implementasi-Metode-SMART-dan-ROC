<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_kriteria'];
  $bbt   = ($_POST['bobot']);

  $simpan = mysqli_query($koneksi, "INSERT INTO data_kriteria (nama_kriteria, bobot) VALUES ('$nama', '$bbt')");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_kriteria.php'</script>";

}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Data Kriteria</h4>
                <div class="table-responsive">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria"
                                placeholder="Input Nama Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="bobot">Bobot</label>
                            <input type="number" class="form-control" name="bobot" placeholder="Input Bobot" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'
                                name="simpan"><span aria-hidden="true"></span>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>