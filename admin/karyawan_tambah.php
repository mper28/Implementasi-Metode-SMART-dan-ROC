<?php
include 'src/header.php';

$data = array(); // Inisialisasi variabel $data sebagai array kosong

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_karyawan'];
  $nohpkaryawan  = $_POST['no_hpkaryawan'];
  $emailkaryawan  = $_POST['email_karyawan'];
  $user  = $_POST['username'];
  $pass  = ($_POST['password']);

  $simpan = mysqli_query($koneksi, "INSERT INTO data_karyawan VALUES('','$nama','$nohpkaryawan','$emailkaryawan','$user','$pass')");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_karyawan.php'</script>";

}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="red">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Data Karyawan</h4>
                    <div class="table-responsive">
                        <form action="" method="POST">
                            <div class="form-group">
                              <label class="form-control-label" for="nama_karyawan">Nama Karyawan</label>
                              <input type="text" class="form-control" name="nama_karyawan" placeholder="Input Nama Karyawan" required>
                            </div>
                            <div class="form-group">
                              <label class="form-control-label" for="no_hpkaryawan">No Hp Karyawan</label>
                              <input type="text" class="form-control" name="no_hpkaryawan" value="<?= isset($data['no_hpkaryawan']) ? $data['no_hpkaryawan'] : '' ?>" placeholder="Input No HP Karyawan" required>
                            </div>
                            <div class="form-group">
                              <label class="form-control-label" for="email_karyawan">Email Karyawan</label>
                              <input type="text" class="form-control" name="email_karyawan" value="<?= isset($data['email_karyawan']) ? $data['email_karyawan'] : '' ?>" placeholder="Email Karyawan" required>
                            </div>
                            <div class="form-group">
                              <label class="form-control-label" for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Input Username" required>
                            </div>
                            <div class="form-group">
                              <label class="form-control-label" for="password">Password</label>
                              <input type="text" class="form-control" id="password" name="password" placeholder="Input Password" required>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="simpan"><span aria-hidden="true"></span>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>