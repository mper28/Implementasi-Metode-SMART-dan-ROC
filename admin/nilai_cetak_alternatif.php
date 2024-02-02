<?php
session_start();
include "../koneksi.php";

$namaKriteria = array();
$qry = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
while ($dt = mysqli_fetch_array($qry)) {
    array_push($namaKriteria, $dt['nama_kriteria']);
}
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
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>No Internet</th>
                                <th>Tanggal</th>
                                <th>Jenis Gangguan</th>
                                <th>Deskripsi Alamat</th>
                                <th>Prevalensi</th>
                                <th>Seriousness</th>
                                <th>Community Concern</th>
                                <th>Manageability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM data_nilai WHERE nama_pelanggan = '$_POST[nama_pelanggan]'");
                            while ($data = mysqli_fetch_array($query)) {
                                echo '<tr>';
                                echo '<td>' . $no . '</td>';
                                echo '<td>' . $data['nama_pelanggan'] . '</td>';
                                echo '<td>' . $data['no_internet'] . '</td>';
                                echo '<td>' . $data['tanggal'] . '</td>';
                                echo '<td>' . $data['jenis_gangguan'] . '</td>';
                                echo '<td>' . $data['deskripsi'] . '</td>';
                                echo '<td>' . $data['k1'] . '</td>';
                                echo '<td>' . $data['k2'] . '</td>';
                                echo '<td>' . $data['k3'] . '</td>';
                                echo '<td>' . $data ['k4'] . '</td>';
                                echo '</tr>';

                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <hr>
        <?php
// Ambil ID admin dari session
$data_admin_query = mysqli_query($koneksi, "SELECT * FROM data_admin");
$data_admin = array();
while ($admin = mysqli_fetch_assoc($data_admin_query)) {
    $data_admin[$admin['id_admin']] = $admin;
}

$adminId = $_SESSION['id'] ?? null;
$selectedAdmin = $data_admin[$adminId] ?? null;
?>
        <h2>Mengetahui, Admin BGES: </h2>
        <h3> <?php echo $selectedAdmin['nama_admin'] ?? ''; ?></h3>
        <br>
        <script>
        window.print();
        </script>
    </div>
</body>