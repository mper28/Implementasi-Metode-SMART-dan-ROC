<?php
include 'src/header.php';


// Periksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Periksa nilai yang dipilih dari dropdown
    $tanggal = $_POST['tanggal'];

    // Lakukan operasi filter berdasarkan nilai tanggal yang dipilih
    if ($tanggal == "today") {
        // Filter untuk hari ini
        $start_date = date("Y-m-d");
        $end_date = date("Y-m-d");
    } elseif ($tanggal == "1_week") {
        // Filter untuk 1 minggu terakhir
        $start_date = date("Y-m-d", strtotime("-1 week"));
        $end_date = date("Y-m-d");
    } elseif ($tanggal == "1_month") {
        // Filter untuk 1 bulan terakhir
        $start_date = date("Y-m-d", strtotime("-1 month"));
        $end_date = date("Y-m-d");
    } elseif ($tanggal == "6_months") {
        // Filter untuk 6 bulan terakhir
        $start_date = date("Y-m-d", strtotime("-6 months"));
        $end_date = date("Y-m-d");
    } elseif ($tanggal == "1_year") {
        // Filter untuk 1 tahun terakhir
        $start_date = date("Y-m-d", strtotime("-1 year"));
        $end_date = date("Y-m-d");
    }

    // Lakukan operasi query sesuai dengan filter tanggal
    $query = mysqli_query($koneksi, "SELECT * FROM data_nilai WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
    // ... (lanjutkan dengan pengolahan data hasil filter) ...
?>

<!-- Tambahkan kode HTML untuk tampilan halaman filter_ticket_tanggal.php di sini -->
<!DOCTYPE html>
<html>

<head>
    <title>Filter Tanggal</title>
</head>

<body>
    <div class="row">
        <!-- ... (tambahkan tampilan sesuai kebutuhan Anda) ... -->
    </div>
</body>

</html>

<?php
} // Tutup blok if untuk periksa form disubmit
?>