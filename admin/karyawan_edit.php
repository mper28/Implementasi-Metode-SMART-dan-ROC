<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_karyawan'];
  $nohpkaryawan  = $_POST['no_hpkaryawan'];
  $emailkaryawan  = $_POST['email_karyawan'];
  $user  = $_POST['username'];
  $pass  = ($_POST['password']);

  $simpan = mysqli_query($koneksi, "UPDATE data_karyawan SET nama_karyawan = '$nama',no_hpkaryawan = '$nohpkaryawan',email_karyawan = '$emailkaryawan', username = '$user', password = '$pass' WHERE id_karyawan= '$_GET[id_karyawan]'");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_karyawan.php'</script>";

}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Data Karyawan</h4>
                <div class="table-responsive">
                    <?php
                        $id    = $_GET['id_karyawan'];
                        $query = mysqli_query($koneksi, "SELECT * FROM data_karyawan WHERE id_karyawan = '$id'");
                        $data  = mysqli_fetch_array($query);
                        ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama_karyawan"
                                value="<?= $data['nama_karyawan'] ?>" placeholder="Input Nama Karyawan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="no_hpkaryawan">No Hp Karyawan</label>
                            <input type="text" class="form-control" name="no_hpkaryawan"
                                value="<?= $data['no_hpkaryawan'] ?>" placeholder="Input No HP karyawan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="email_karyawan">Email Karyawan</label>
                            <input type="text" class="form-control" name="email_karyawan"
                                value="<?= $data['email_karyawan'] ?>" placeholder="EmailKaryawan" required>
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