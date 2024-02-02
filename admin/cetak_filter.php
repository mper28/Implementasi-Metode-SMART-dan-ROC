<?php
session_start();
include "../koneksi.php";
// Query untuk mengambil data dari tabel 'data_admin'
$data_admin_query = mysqli_query($koneksi, "SELECT * FROM data_admin");
$data_admin = array();
while ($admin = mysqli_fetch_assoc($data_admin_query)) {
    $data_admin[$admin['id_admin']] = $admin;
}
// Memeriksa apakah form telah disubmit
if (isset($_GET['filter'])) {
    // Memeriksa apakah status_ticket telah dipilih
    if (isset($_GET['status_ticket'])) {
        $selectedStatusTicket = $_GET['status_ticket'];

        $ticketStatusCondition = '';

        if ($selectedStatusTicket !== "ALL") {
            $selectedStatusTicket = mysqli_real_escape_string($koneksi, $selectedStatusTicket);
            $ticketStatusCondition = "AND t.status_ticket='$selectedStatusTicket'";
        }

        // Query untuk mengambil data dari tabel 'data_ticket', 'data_nilai', dan 'data_hasil' dengan penggabungan (join)
        $query = "SELECT t.*, n.*, h.hasil, k.nama_karyawan
                  FROM data_ticket t
                  INNER JOIN data_nilai n ON t.id_pelanggan = n.id_pelanggan
                  INNER JOIN data_hasil h ON t.id_pelanggan = h.id_pelanggan
                  INNER JOIN data_karyawan k ON t.id_karyawan = k.id_karyawan
                  WHERE 1 $ticketStatusCondition
                  ORDER BY t.id_ticket ASC";

        $data_query = mysqli_query($koneksi, $query);
        if (!$data_query) {
            die("Error executing query: " . mysqli_error($koneksi));
        }

        $data_count = mysqli_num_rows($data_query);

        echo '<link href="../assets/css/bootstrap.min.css" rel="stylesheet">';
        echo '<body style="padding: 0 20;">';
        echo '<div>';
        echo '<section class="content">';
        echo '<div class="row">';
        echo '<div class="col-xs-12 table-responsive">';
        echo '<img align="left" width="130" src="../logo.jpg"/>';

        echo '<h1>PT Telekomunikasi Indonesia</h1>
        <h2>BGES Operation Witel Cirebon</h2>
                        <h4>Jln. Pagongan No. 11, Cirebon, Jawa Barat, Indonesia
                        0812-2383-5475
                        </h4>';
        echo '<hr width="100%">';
        echo '<table class="table table-striped" align="center" border="1">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Prioritas</th>';
        echo '<th>TimeLine Pengerjaan</th>';
        echo '<th>No Ticket</th>';
        echo '<th>No. Internet</th>';
        echo '<th>Nama Pelanggan</th>';
        echo '<th>Tanggal</th>';
        echo '<th>Jenis Gangguan</th>';
        echo '<th>Deskripsi Alamat</th>';
        echo '<th>Karyawan Menangani</th>';
        echo '<th>Status Ticket</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        if ($data_count !== 0) {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($data_query)) {
                echo '<tr>';
                echo '<td>' . $counter . '</td>';
                echo '<td>';
                if (isset($row['hasil'])) {
                    if ($row['hasil'] <= 50) {
                        echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden='true'></span>Low</button>";
                    } elseif ($row['hasil'] <= 80) {
                        echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden='true'></span>Medium</button>";
                    } else {
                        echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden='true'></span>High</button>";
                    }
                }
                echo '</td>';
                echo '<td>' . $row['timeline'] . '</td>';
                echo '<td>' . $row['no_ticket'] . '</td>';
                echo '<td>' . $row['no_internet'] . '</td>';
                echo '<td>' . $row['nama_pelanggan'] . '</td>';
                echo '<td>' . $row['tanggal'] . '</td>';
                echo '<td>' . $row['jenis_gangguan'] . '</td>';
                echo '<td>' . $row['deskripsi'] . '</td>';
                echo '<td>' . $row['nama_karyawan'] . '</td>';
                echo '<td>' . $row['status_ticket'] . '</td>';
                echo '</tr>';
                $counter++;
            }
        } else {
            echo '<tr align="center">';
            echo '<td colspan="11">Tidak ada data!</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        echo '<hr>';

         // Dapatkan detail admin berdasarkan ID
         $adminId = $_SESSION['id'] ?? null;
         $selectedAdmin = $data_admin[$adminId] ?? null;
 
         echo '<h1>Mengetahui, Admin BGES: </h1>';
         echo '<h2>' . ($selectedAdmin['nama_admin'] ?? '') . '</h2>';
         echo '<br>';
         echo '<br>';
         echo '<script>window.print()</script>';
         echo '</div>';
         echo '</body>';
     } else {
        // Jika status_ticket tidak dipilih, tampilkan pesan atau tindakan yang sesuai
        echo 'Status tiket belum dipilih.';
        exit(); // Menghentikan eksekusi script selanjutnya
    }
} else {
    // Jika form tidak disubmit, tampilkan pesan atau tindakan yang sesuai
    echo 'Form belum disubmit.';
    exit(); // Menghentikan eksekusi script selanjutnya
}
?>
