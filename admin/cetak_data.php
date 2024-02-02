<?php
session_start();
include "../koneksi.php";

// Query untuk mengambil data dari tabel 'data_ticket'
$data_ticket_query = mysqli_query($koneksi, "SELECT * FROM data_ticket ORDER BY id_ticket ASC");
$data_ticket = array();
while ($ticket = mysqli_fetch_assoc($data_ticket_query)) {
    $data_ticket[] = $ticket;
}

// Query untuk mengambil data dari tabel 'data_nilai'
$data_nilai_query = mysqli_query($koneksi, "SELECT * FROM data_nilai");
$data_nilai = array();
while ($nilai = mysqli_fetch_assoc($data_nilai_query)) {
    $data_nilai[$nilai['id_pelanggan']] = $nilai;
}

// Query untuk mengambil data dari tabel 'data_hasil'
$data_hasil_query = mysqli_query($koneksi, "SELECT * FROM data_hasil");
$data_hasil = array();
while ($hasil = mysqli_fetch_assoc($data_hasil_query)) {
    $data_hasil[$hasil['id_pelanggan']] = $hasil;
}

// Query untuk mengambil data dari tabel 'data_karyawan'
$data_karyawan_query = mysqli_query($koneksi, "SELECT * FROM data_karyawan");
$data_karyawan = array();
while ($karyawan = mysqli_fetch_assoc($data_karyawan_query)) {
    $data_karyawan[$karyawan['id_karyawan']] = $karyawan;
}

// Query untuk mengambil data dari tabel 'data_admin'
$data_admin_query = mysqli_query($koneksi, "SELECT * FROM data_admin");
$data_admin = array();
while ($admin = mysqli_fetch_assoc($data_admin_query)) {
    $data_admin[$admin['id_admin']] = $admin;
}

// Fungsi updateStatus_ticket
function updateStatus($idTicket, $status) {
    global $koneksi;
    $status = mysqli_real_escape_string($koneksi, $status);
    if ($status === 'DELETE') {
        $query = "DELETE FROM data_ticket WHERE id_ticket='$idTicket'";
        if (mysqli_query($koneksi, $query)) {
            echo 'Status tiket berhasil diperbarui.';
            header("Location: ticket_list.php?admin_id={$_SESSION['id']}");
            exit();
        } else {
            echo 'Terjadi kesalahan dalam memperbarui status tiket: ' . mysqli_error($koneksi);
        }
    } else {
        $query = "UPDATE data_ticket SET status_ticket='$status' WHERE id_ticket='$idTicket'";
        if (mysqli_query($koneksi, $query)) {
            echo 'Status tiket berhasil diperbarui.';
            header("Location: ticket_list.php?admin_id={$_SESSION['id']}");
            exit();
        } else {
            echo 'Terjadi kesalahan dalam memperbarui status tiket: ' . mysqli_error($koneksi);
        }
    }
}
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
                                <th>No</th>
                                <th>Prioritas</th>
                                <th>TimeLine Pengerjaan</th>
                                <th>No Ticket</th>
                                <th>No. Internet</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Jenis Gangguan</th>
                                <th>Deskripsi Alamat</th>
                                <th>Hasil</th>
                                <th>Karyawan Teknisi Menangani:</th>
                                <th>Status Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            foreach ($data_ticket as $ticket) {
                                $selectedNilai = isset($data_nilai[$ticket['id_pelanggan']]) ? $data_nilai[$ticket['id_pelanggan']] : null;
                                $selectedHasil = isset($data_hasil[$ticket['id_pelanggan']]) ? $data_hasil[$ticket['id_pelanggan']] : null;
                                $selectedKaryawan = isset($data_karyawan[$ticket['id_karyawan']]) ? $data_karyawan[$ticket['id_karyawan']] : null;
                
                                echo '<tr>';
                                echo '<td>' . $nomor . '</td>';
                                echo '<td>';
                                if ($selectedHasil && $selectedHasil['ket'] == "Medium") {
                                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden='true'></span>Medium</button>";
                                } elseif ($selectedHasil && $selectedHasil['ket'] == "High") {
                                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden='true'></span>High</button>";
                                } else {
                                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden='true'></span>Low</button>";
                                }
                                echo '</td>';
                                echo '<td>' . ($ticket['timeline'] ?? '') . '</td>';
                                echo '<td>' . ($ticket['no_ticket'] ?? '') . '</td>';
                                echo '<td>' . ($selectedNilai['no_internet'] ?? '') . '</td>';
                                echo '<td>' . ($selectedNilai['nama_pelanggan'] ?? '') . '</td>';
                              
                                echo '<td>' . ($selectedNilai['tanggal'] ?? '') . '</td>';
                                echo '<td>' . ($selectedNilai['jenis_gangguan'] ?? '') . '</td>';
                                echo '<td>' . ($selectedNilai['deskripsi'] ?? '') . '</td>';
                                echo '<td>' . ($selectedHasil['hasil'] ?? '') . '</td>';
                                
                                echo '<td>' . ($selectedKaryawan['nama_karyawan'] ?? '') . '</td>';
                                echo '<td>' . ($ticket['status_ticket'] ?? '') . '</td>';
                                
                
                                $nomor++;
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
        $adminId = $_SESSION['id'] ?? null;

        // Dapatkan detail admin berdasarkan ID
        $selectedAdmin = $data_admin[$adminId] ?? null;
        ?>
        <h1>Mengetahui,Admin BGES :</h1>
          <h2>  <?php echo $selectedAdmin['nama_admin'] ?? ''; ?></h2>
        <br>
        <br>
        <script>
        window.print()
        </script>
    </div>
</body>