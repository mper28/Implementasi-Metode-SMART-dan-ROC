<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama_pelanggan  = $_POST['nama_pelanggan'];
  $no_internet  = $_POST['no_internet'];
  $tanggal = $_POST['tanggal'];
  $jenis_gangguan = $_POST['jenis_gangguan'];
  $k1    = $_POST['k1'];
  $k2    = $_POST['k2'];
  $k3    = $_POST['k3'];
  $k4    = $_POST['k4'];
  $deskripsi    = $_POST['deskripsi'];

  $simpan = mysqli_query($koneksi, "UPDATE data_nilai SET nama_pelanggan = '$nama_pelanggan', no_internet = '$no_internet' ,tanggal = '$tanggal', jenis_gangguan = '$jenis_gangguan', k1 = '$k1', k2 = '$k2', k3 = '$k3', k4 = '$k4', deskripsi = '$deskripsi' WHERE id_pelanggan = '$_GET[id_pelanggan]'");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_nilai.php'</script>";

}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Data Nilai</h4>
                <div class="table-responsive">
                    <?php
                        $id    = $_GET['id_pelanggan'];
                        $query = mysqli_query($koneksi, "SELECT * FROM data_nilai WHERE id_pelanggan = '$id'");
                        $data  = mysqli_fetch_array($query);
                        ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" class="form-control" value="<?php echo $data['nama_pelanggan'] ?>"
                                name="nama_pelanggan" placeholder="Input Nama Pelanggan" required>
                        </div>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="form-control-label" for="no_internet">No Internet</label>
                                <input type="text" class="form-control" value="<?php echo $data['no_internet'] ?>"
                                    name="no_internet" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal"
                                    value="<?php echo isset($tanggal) ? $tanggal : ''; ?>" placeholder="Masukan Tanggal"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="jenis_gangguan">Sampaikan Keluhan
                                    Gangguan</label>
                                <input type="text" class="form-control" name="jenis_gangguan"
                                    value="<?php echo isset($jenis_gangguan) ? $jenis_gangguan : ''; ?>"
                                    placeholder="Masukan keluhan gangguan " required>
                            </div>

                            <?php
                              $namaKriteria = array();
                              $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                              while($dt = mysqli_fetch_array($qry)){
                                array_push($namaKriteria, $dt['nama_kriteria']);
                              }
                            ?>
                            <div class="form-group">
                                <label class="form-control-label" for="k1"><?= $namaKriteria[0] ?></label>
                                <select class="form-control" name="k1" required>
                                    <option value="1" <?php if($data['k1'] == 1){ echo "selected"; } ?>>Sedikit</option>
                                    <option value="3" <?php if($data['k1'] == 3){ echo "selected"; } ?>>Sedang</option>
                                    <option value="5" <?php if($data['k1'] == 5){ echo "selected"; } ?>>Banyak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="k2"><?= $namaKriteria[1] ?></label>
                                <select class="form-control" name="k2" required>
                                    <option value="1" <?php if($data['k2'] == 1){ echo "selected"; } ?>>Biasa</option>
                                    <option value="3" <?php if($data['k2'] == 3){ echo "selected"; } ?>>Serius</option>
                                    <option value="5" <?php if($data['k2'] == 5){ echo "selected"; } ?>>Sangat Serius
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="k3"><?= $namaKriteria[2] ?></label>
                                <select class="form-control" name="k3" required>
                                    <option value="1" <?php if($data['k3'] == 1){ echo "selected"; } ?>>Biasa</option>
                                    <option value="3" <?php if($data['k3'] == 3){ echo "selected"; } ?>>Berdampak
                                    </option>
                                    <option value="5" <?php if($data['k3'] == 5){ echo "selected"; } ?>>Berdampak Besar
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="k4"><?= $namaKriteria[3] ?></label>
                                <select class="form-control" name="k4" required>
                                    <option value="1" <?php if($data['k4'] == 1){ echo "selected"; } ?>>Penangan Biasa
                                    </option>
                                    <option value="3" <?php if($data['k4'] == 3){ echo "selected"; } ?>>Teknisi dan Alat
                                        Biasa</option>
                                    <option value="5" <?php if($data['k4'] == 5){ echo "selected"; } ?>>Butuh Teknisi
                                        dan Alat Tambahan</option>
                                </select>
                            </div>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label class="form-control-label" for="deskripsi">Deskripsi alamat</label>
                                    <input type="text" class="form-control" value="<?php echo $data['deskripsi'] ?>"
                                        name="deskripsi" placeholder="" required>
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