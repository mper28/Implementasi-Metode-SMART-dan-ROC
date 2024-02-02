<?php
include "../koneksi.php";
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<body style="padding: 0 20;">
    <div>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <img align="left" width="130" src="../logo.jpg" />
                    <h1>PT Telekomunikasi Indonesia</h1>
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
                  $query = mysqli_query($koneksi, "SELECT data_nilai.*, data_hasil.* FROM data_hasil, data_nilai WHERE data_hasil.id_pelanggan = data_nilai.id_pelanggan AND data_nilai.nama_pelanggan = '$_POST[nama_pelanggan]'");
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
  session_start();

  // Query untuk mengambil data dari tabel 'data_admin'
  $data_admin_query = mysqli_query($koneksi, "SELECT * FROM data_admin");
  $data_admin = array();
  while ($admin = mysqli_fetch_assoc($data_admin_query)) {
      $data_admin[$admin['id_admin']] = $admin;
  }

  // Ambil ID admin dari session
  $adminId = $_SESSION['id'] ?? null;

  // Dapatkan detail admin berdasarkan ID
  $selectedAdmin = $data_admin[$adminId] ?? null;
  ?>
<h3>Mengetahui :<br>
    <br>
    <?php echo $selectedAdmin['nama_admin'] ?? ''; ?>
</h3>
<br>
<br>

<script>
window.print()
</script>