<?php
session_start();
include "../koneksi.php";

// Cek apakah ada data admin yang terdaftar dan terautentikasi sebelum mencetak
$data_admin_query = mysqli_query($koneksi, "SELECT * FROM data_admin");
$data_admin = array();
while ($admin = mysqli_fetch_assoc($data_admin_query)) {
    $data_admin[$admin['id_admin']] = $admin;
}

$adminId = $_SESSION['id'] ?? null;
$selectedAdmin = $data_admin[$adminId] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Gangguan Pelanggan</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="padding: 0 20;">
    <div>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <img align="left" width="200" src="../logo.jpg" />
                    <h2>BGES Operation Witel Cirebon</h2>
                    <h4>Jln. Pagongan No. 11, Cirebon, Jawa Barat, Indonesia 0812-2383-5475</h4>
                    <hr width="100%">
                    <h1>Laporan Nilai Pelanggan</h1>
                    <table class="table table-striped" align="center" border="1">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelanggan</th>
                                <th>No Internet</th>
                                <th>Tanggal</th>
                                <th>Jenis Gangguan</th>
                                <th>Prevalensi</th>
                                <th>Seriousness</th>
                                <th>Community Concern</th>
                                <th>Manageability</th>
                                <th>Deskripsi Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Query untuk mengambil semua data nilai pelanggan
                            $query = mysqli_query($koneksi, "SELECT * FROM data_nilai");

                            // Pastikan ada data yang ditemukan
                            if (mysqli_num_rows($query) > 0) {
                                // Loop melalui data dan mencetak setiap baris data
                                while ($data = mysqli_fetch_array($query)) {
                                    echo "<tr>
                                            <td>$no</td>
                                            <td>{$data['nama_pelanggan']}</td>
                                            <td>{$data['no_internet']}</td>
                                            <td>{$data['tanggal']}</td>
                                            <td>{$data['jenis_gangguan']}</td>
                                            <td>{$data['k1']}</td>
                                            <td>{$data['k2']}</td>
                                            <td>{$data['k3']}</td>
                                            <td>{$data['k4']}</td>
                                            <td>{$data['deskripsi']}</td>
                                        </tr>";
                                    $no++;
                                }
                            } else {
                                // Jika data tidak ditemukan, tampilkan pesan error
                                echo "<tr><td colspan='10'>Data nilai pelanggan tidak ditemukan.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            // Menampilkan nama admin yang terautentikasi
            if ($selectedAdmin) {
                echo "<h2>Mengetahui, Admin BGES: </h2>";
                echo "<h3>{$selectedAdmin['nama_admin']}</h3>";
            }
            ?>

            <script>
            window.print();
            </script>
        </section>
    </div>
</body>

</html>