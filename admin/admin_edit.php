<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_admin'];
  $user  = $_POST['username'];
  $pass  = ($_POST['password']);

  $simpan = mysqli_query($koneksi, "UPDATE data_admin SET nama_admin = '$nama', username = '$user', password = '$pass' WHERE id_admin = '$_GET[id_admin]'");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_admin.php'</script>";

}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Data Admin</h4>
                <div class="table-responsive">
                    <?php
                        $id    = $_GET['id_admin'];
                        $query = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE id_admin = '$id'");
                        $data  = mysqli_fetch_array($query);
                        ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_admin">Nama Admin</label>
                            <input type="text" class="form-control" name="nama_admin" value="<?= $data['nama_admin'] ?>"
                                placeholder="Input Nama Admin" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>"
                                placeholder="Input Username" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password</label>
                            <input type="text" class="form-control" name="password" value="<?= $data['password'] ?>"
                                placeholder="Input Password" required>
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