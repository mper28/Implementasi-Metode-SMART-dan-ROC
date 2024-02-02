<?php
ob_start(); // Mulai output buffering

include 'src/header.php';

// Inisialisasi nilai awal untuk $sortColumn dan $sortOrder
$sortColumn = 'id_ticket'; // Kolom yang digunakan untuk mengurutkan (misalnya: 'id_ticket', 'no_ticket', 'timeline', dll.)
$sortOrder = 'ASC'; // Urutan pengurutan (ASC = ascending, DESC = descending)

// Query to fetch data from the 'data_ticket' table
$data_ticket_query = mysqli_query($koneksi, "SELECT * FROM data_ticket ORDER BY $sortColumn $sortOrder");
$data_ticket = array();
while ($ticket = mysqli_fetch_assoc($data_ticket_query)) {
    $data_ticket[] = $ticket;
}

// Query to fetch data from the 'data_nilai' table
$data_nilai_query = mysqli_query($koneksi, "SELECT * FROM data_nilai");
$data_nilai = array();
while ($nilai = mysqli_fetch_assoc($data_nilai_query)) {
    $data_nilai[$nilai['id_pelanggan']] = $nilai;
}

// Query to fetch data from the 'data_hasil' table
$data_hasil_query = mysqli_query($koneksi, "SELECT * FROM data_hasil");
$data_hasil = array();
while ($hasil = mysqli_fetch_assoc($data_hasil_query)) {
    $data_hasil[$hasil['id_pelanggan']] = $hasil;
}

// Query to fetch data from the 'data_karyawan' table
$data_karyawan_query = mysqli_query($koneksi, "SELECT * FROM data_karyawan");
$data_karyawan = array();
while ($karyawan = mysqli_fetch_assoc($data_karyawan_query)) {
    $data_karyawan[$karyawan['id_karyawan']] = $karyawan;
}

// Fungsi untuk menghapus data dari tabel data_nilai dan data_hasil berdasarkan id_pelanggan
function deleteData($idPelanggan) {
    global $koneksi;

    // Hapus data dari tabel data_nilai berdasarkan id_pelanggan
    mysqli_query($koneksi, "DELETE FROM data_nilai WHERE id_pelanggan='$idPelanggan'");

    // Hapus data dari tabel data_hasil berdasarkan id_pelanggan
    mysqli_query($koneksi, "DELETE FROM data_hasil WHERE id_pelanggan='$idPelanggan'");
}

// Fungsi update status_ticket
function updateStatus($idTicket, $status) {
    global $koneksi;

    // Persiapkan query dengan placeholder
    if ($status === 'DELETE') {
        // Get the id_pelanggan associated with the ticket
        $idPelangganQuery = mysqli_query($koneksi, "SELECT id_pelanggan FROM data_ticket WHERE id_ticket='$idTicket'");
        $idPelangganData = mysqli_fetch_assoc($idPelangganQuery);
        $idPelanggan = $idPelangganData['id_pelanggan'];

        // Call the deleteData function to remove related data from data_nilai and data_hasil tables
        deleteData($idPelanggan);

        $query = "DELETE FROM data_ticket WHERE id_ticket=?";
    } else {
        $query = "UPDATE data_ticket SET status_ticket=? WHERE id_ticket=?";
    }

    // Persiapkan pernyataan (prepared statement)
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind parameter ke prepared statement sesuai jenis data
        if ($status === 'DELETE') {
            mysqli_stmt_bind_param($stmt, "i", $idTicket);
        } else {
            mysqli_stmt_bind_param($stmt, "si", $status, $idTicket);
        }

        // Eksekusi pernyataan
        if (mysqli_stmt_execute($stmt)) {
            if ($status === 'DONE') {
                // Tandai data terkait pada tabel data_nilai dan data_hasil sebagai "hidden"
                mysqli_query($koneksi, "UPDATE data_nilai SET hidden=1 WHERE id_pelanggan=(SELECT id_pelanggan FROM data_ticket WHERE id_ticket='$idTicket')");
                mysqli_query($koneksi, "UPDATE data_hasil SET hidden=1 WHERE id_pelanggan=(SELECT id_pelanggan FROM data_ticket WHERE id_ticket='$idTicket')");
            } else {
                // Jika status_ticket bukan "DONE", ubah kembali status hidden menjadi 0
                mysqli_query($koneksi, "UPDATE data_nilai SET hidden=0 WHERE id_pelanggan=(SELECT id_pelanggan FROM data_ticket WHERE id_ticket='$idTicket')");
                mysqli_query($koneksi, "UPDATE data_hasil SET hidden=0 WHERE id_pelanggan=(SELECT id_pelanggan FROM data_ticket WHERE id_ticket='$idTicket')");
            }

            echo 'Status tiket berhasil diperbarui.';
            header("Location: ticket_list.php"); // Alihkan ke halaman ticket_list.php setelah pembaruan status tiket
            exit();
        } else {
            echo 'Terjadi kesalahan dalam memperbarui status tiket: ' . mysqli_stmt_error($stmt);
        }

        // Tutup pernyataan
        mysqli_stmt_close($stmt);
    } else {
        echo 'Terjadi kesalahan dalam persiapan pernyataan: ' . mysqli_error($koneksi);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_ticket'])) {
    $selectedStatusTicket = $_POST['status_ticket'];
} else {
    $selectedStatusTicket = "ALL";
}

$filteredData = array_filter($data_ticket, function ($ticket) use ($selectedStatusTicket) {
    return $selectedStatusTicket === "ALL" || $ticket['status_ticket'] === $selectedStatusTicket;
});
?>

<form method="POST" action="cetak_data.php" target="_blank">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Cetak List ticket Keseluruhan</button>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">apps</i>
            </div>
            <div class="card-content">
                <h1 class="card-title">List Ticket Gangguan pelanggan</h1>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Prioritas</th>
                                <th>TimeLine</th>
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
                            foreach ($filteredData as $ticket) {
                                $selectedNilai = $data_nilai[$ticket['id_pelanggan']] ?? array();
                                $selectedHasil = $data_hasil[$ticket['id_pelanggan']] ?? null;

                                // Pemeriksaan menggunakan isset sebelum mengakses indeks "ket"
                                $selectedHasilKet = isset($selectedHasil['ket']) ? $selectedHasil['ket'] : null;
                                $selectedKaryawan = $data_karyawan[$ticket['id_karyawan']] ?? array();

                                // Cek apakah status tiket adalah 'DONE'
                                $isTicketDone = $ticket['status_ticket'] === 'DONE';

                                echo '<tr>';
                                echo '<td>' . $nomor . '</td>';
                                echo '<td>';
                                if ($selectedHasilKet === "Medium") {
                                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden='true'></span>Medium</button>";
                                } elseif ($selectedHasilKet === "High") {
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

                                echo '<td>';
                                echo '<form method="POST" action="">';
                                echo '<input type="hidden" name="idTicket" value="' . $ticket['id_ticket'] . '">';
                                echo '<select name="status" onchange="this.form.submit()">';
                                echo '<option value="NEW" ' . ($ticket['status_ticket'] == 'NEW' ? 'selected' : '') . '>NEW</option>';
                                echo '<option value="PROCESS" ' . ($ticket['status_ticket'] == 'PROCESS' ? 'selected' : '') . '>PROCESS</option>';
                                echo '<option value="PENDING" ' . ($ticket['status_ticket'] == 'PENDING' ? 'selected' : '') . '>PENDING</option>';
                                echo '<option value="CANCEL" ' . ($ticket['status_ticket'] == 'CANCEL' ? 'selected' : '') . '>CANCEL</option>';
                                echo '<option value="DONE" ' . ($ticket['status_ticket'] == 'DONE' ? 'selected' : '') . '>DONE</option>';
                                echo '<option value="DELETE" ' . ($ticket['status_ticket'] == 'DELETE' ? 'selected' : '') . '>DELETE</option>';
                                echo '</select>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';

                                $nomor++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Filter Form -->
<div class="row">
    <div class="material-datatables">
        <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <tr>
                <td colspan="12">
                    <div class="page-header">
                        <h1>Filter Ticket</h1>
                        <h3>Pilih Ticket berdasarkan status</h3>
                        <form method="GET" action="cetak_filter.php">
                            <div class="col-md-3 form-group">
                                <label for="">Status:</label>
                                <select name="status_ticket" class="form-control">
                                    <option value="ALL">- ALL-</option>
                                    <option value="NEW">NEW</option>
                                    <option value="PROCESS">PROCESS</option>
                                    <option value="PENDING">PENDING</option>
                                    <option value="CANCEL">CANCEL</option>
                                    <option value="DONE">DONE</option>
                                </select>
                            </div>
                            <input type="hidden" name="hideformfilter" value="true">
                            <input type="submit" name="filter" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTicket = $_POST['idTicket'];
    $status = $_POST['status'];
    updateStatus($idTicket, $status);
}

include 'src/footer.php';

ob_end_flush(); // Akhiri output buffering
?>
