<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_kriteria'];
  $bbt   = ($_POST['bobot']);

  $simpan = mysqli_query($koneksi, "UPDATE data_kriteria SET nama_kriteria = '$nama', bobot = '$bbt' WHERE id_kriteria = '$_GET[id_kriteria]'");
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
                <h4 class="card-title">Edit Data Kriteria</h4>
                <div class="table-responsive">
                    <?php
                        $id    = $_GET['id_kriteria'];
                        $query = mysqli_query($koneksi, "SELECT * FROM data_kriteria WHERE id_kriteria = '$id'");
                        $data  = mysqli_fetch_array($query);
                        ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria"
                                value="<?= $data['nama_kriteria'] ?>" placeholder="Input Nama Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="bobot">Bobot</label>
                            <input type="number" class="form-control" name="bobot" value="<?= $data['bobot'] ?>"
                                placeholder="Input Bobot" required>
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
</div>

<?php include 'src/footer.php'; ?>