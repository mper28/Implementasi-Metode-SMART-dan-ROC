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

    // ...
    // Lanjutkan dengan pengolahan data hasil filter
    // ...
}
?>

<!-- Tambahkan kode HTML untuk tampilan halaman filter_tanggal.php di sini -->
<!DOCTYPE html>
<html>

<head>
    <title>Filter Tanggal</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">apps</i>
                </div>
                <h2 class="card-title">Data Nilai Alternatif </h2>
                <h3 class="card-title">ini adalah tampilan data nilai alternatif berdasarkan filter tanggal yang dipilih
                </h3>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">No Internet</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Keluhan Gangguan</th>
                                <?php
                    $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                    while($dt = mysqli_fetch_array($qry)){
                        echo "<th class='text-center'>$dt[nama_kriteria]</th>";
                    }
                    ?>
                                <th class="text-center">Deskripsi Alamat </th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                    include 'src/kondisi.php';
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_pelanggan'] ?></td>
                                <td><?= $data['no_internet'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['jenis_gangguan'] ?></td>
                                <td><?= $k1 ?></td>
                                <td><?= $k2 ?></td>
                                <td><?= $k3 ?></td>
                                <td><?= $k4 ?></td>
                                <td><?= $data['deskripsi'] ?></td>
                                <td>
                                    <a href="nilai_edit.php?id_pelanggan=<?php echo $data['id_pelanggan']; ?>"><button
                                            type="button"
                                            class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span
                                                aria-hidden="true"></span>Edit</button></a>
                                    <a href="nilai_hapus.php?id_pelanggan=<?php echo $data['id_pelanggan']; ?>"><button
                                            type="button"
                                            class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span
                                                aria-hidden="true"></span>Delete</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
</body>

</html>

<?php include 'src/footer.php'; ?>