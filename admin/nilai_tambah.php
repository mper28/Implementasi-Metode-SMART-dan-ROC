<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
  $nama_pelanggan = $_POST['nama_pelanggan'];
  $no_internet = $_POST['no_internet'];
  $tanggal = $_POST['tanggal'];
  $jenis_gangguan = $_POST['jenis_gangguan'];
  $k1 = $_POST['k1'];
  $k2 = $_POST['k2'];
  $k3 = $_POST['k3'];
  $k4 = $_POST['k4'];
  $deskripsi = $_POST['deskripsi'];

  // Validasi data sebelum INSERT
  // Pastikan semua kolom yang diperlukan terisi
  if (empty($nama_pelanggan) || empty($no_internet) || empty($tanggal) || empty($jenis_gangguan) || empty($k1) || empty($k2) || empty($k3) || empty($k4) || empty($deskripsi)) {
    echo "<script>alert('Harap lengkapi semua kolom');</script>";
  } else {
    // Lakukan operasi INSERT
    $query = "INSERT INTO data_nilai (nama_pelanggan, no_internet, tanggal, jenis_gangguan, k1, k2, k3, k4, deskripsi) VALUES (
    '$nama_pelanggan', '$no_internet', '$tanggal', '$jenis_gangguan', '$k1', '$k2', '$k3', '$k4', '$deskripsi')";

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
      echo "<script>alert('Data Berhasil Disimpan');window.location='data_nilai.php'</script>";
    } else {
      echo 'Terjadi kesalahan dalam menyimpan data: ' . mysqli_error($koneksi);
    }
  }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Data Nilai</h4>
                <div class="table-responsive">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan"
                                placeholder="Masukan Nama Pelanggan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="no_internet">No Internet</label>
                            <input type="text" class="form-control" name="no_internet" placeholder="Masukan No Internet"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="tanggal">Waktu Gangguan</label>
                            <input type="date" class="form-control" name="tanggal"
                                value="<?php echo isset($tanggal) ? $tanggal : ''; ?>" placeholder="Masukan Tanggal"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="jenis_gangguan">Sampaikan Keluhan Gangguan</label>
                            <input type="text" class="form-control" name="jenis_gangguan"
                                value="<?php echo isset($jenis_gangguan) ? $jenis_gangguan : ''; ?>"
                                placeholder="Masukan keluhan gangguan " required>
                        </div>

                        <?php
            $namaKriteria = array();
            $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
            while ($dt = mysqli_fetch_array($qry)) {
              array_push($namaKriteria, $dt['nama_kriteria']);
            }
            ?>

                        <div class="form-group">
                            <label class="form-control-label" for="k1"><?= $namaKriteria[0] ?></label>
                            <select class="form-control" name="k1" required>
                                <option value="">-- <?= $namaKriteria[0] ?> --</option>
                                <option value="1">Sedikit</option>
                                <option value="3">Sedang</option>
                                <option value="5">Banyak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="k2"><?= $namaKriteria[1] ?></label>
                            <select class="form-control" name="k2" required>
                                <option value="">-- <?= $namaKriteria[1] ?> --</option>
                                <option value="1">Biasa</option>
                                <option value="3">Serius</option>
                                <option value="5">Sangat Serius</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="k3"><?= $namaKriteria[2] ?></label>
                            <select class="form-control" name="k3" required>
                                <option value="">-- <?= $namaKriteria[2] ?> --</option>
                                <option value="1">Biasa</option>
                                <option value="3">Berdampak</option>
                                <option value="5">Berdampak Besar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="k4"><?= $namaKriteria[3] ?></label>
                            <select class="form-control" name="k4" required>
                                <option value="">-- <?= $namaKriteria[3] ?> --</option>
                                <option value="1">Penanganan Biasa</option>
                                <option value="3">Teknisi dan Alat Biasa</option>
                                <option value="5">Butuh Teknisi dan alat khusus</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="deskripsi">Deskripsi Alamat</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'
                                name="simpan"><span aria-hidden="true"></span>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>