<?php
include "../koneksi.php";

session_start(); // Panggil session_start() di bagian atas

?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

<body style="padding: 0 20;">
    <div>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 table-responsive">

                <img align="left" width="200" src="../logo.jpg" />
                    <h2>BGES Operation Witel Cirebon</h2>
                    <h4>Jln. Pagongan No. 11, Cirebon, Jawa Barat, Indonesia
                        0812-2383-5475
                    </h4>
                    <hr width="100%">
                    <table class="table table-striped" align="center" border="1">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">No Internet</th>
                                <th class="text-center">Tanggal </th>
                                <th class="text-center">Keluhan Gangguan</th>
                                <?php
                    $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                    while($dt = mysqli_fetch_array($qry)){
                        echo "<th class='text-center'>$dt[nama_kriteria]</th>";
                    }
                    ?>
                                <th class="text-center">Hasil</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT data_nilai.*, data_hasil.* FROM data_hasil, data_nilai WHERE data_hasil.id_pelanggan = data_nilai.id_pelanggan");
                  while($data = mysqli_fetch_array($query)){
                    include "src/kondisi.php";

                    if ($data['ket'] == "Medium") {
                      $keterangan = "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden='true'></span>Medium</button>";
                  } elseif ($data['ket'] == "High") {
                      $keterangan = "<button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden='true'></span>High</button>";
                  } else {
                      $keterangan = "<button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden='true'></span>Low</button>";
                  }
                  ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_pelanggan'] ?></td>
                                <td><?= $data['no_internet'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['jenis_gangguan'] ?></td>
                                <td><?= $k1 ?></td>
                                <td><?= $k2 ?></td>
                                <td><?= $k3 ?></td>
                                <td><?= $k4 ?></td>
                                <td><?= $data['hasil'] ?></td>
                                <td><?= $keterangan ?></td>
                                <td><?= $data['deskripsi'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        </section>
    </div>
</body>

<hr>

<?php
  // Query untuk mengambil data dari tabel 'data_karyawan'
  $data_karyawan_query = mysqli_query($koneksi, "SELECT * FROM data_karyawan");
  $data_karyawan = array();
  while ($karyawan = mysqli_fetch_assoc($data_karyawan_query)) {
      $data_karyawan[$karyawan['id_karyawan']] = $karyawan;
  }

  // Ambil ID karyawan dari session
  $karyawanId = $_SESSION['id'] ?? null;

  // Dapatkan detail karyawan berdasarkan ID
  $selectedKaryawan = $data_karyawan[$karyawanId] ?? null;
  ?>
<h3>Mengetahui, Karyawan BGES :<br>
    <br>
    <?php echo $selectedKaryawan['nama_karyawan'] . ', ' . $selectedKaryawan['no_hpkaryawan'] . ' - ' . $selectedKaryawan['email_karyawan'] ?? ''; ?>
</h3>


<script>
window.print()
</script>