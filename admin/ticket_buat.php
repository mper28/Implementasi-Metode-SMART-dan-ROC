<?php
include 'src/header.php';

/// Query untuk mengambil data dari tabel 'data_hasil'
$data_hasil_query = mysqli_query($koneksi, "SELECT * FROM data_hasil ORDER BY id_hasil DESC");
$data_hasil = array();
while ($hasil = mysqli_fetch_assoc($data_hasil_query)) {
    $data_hasil[] = $hasil;
}

// Query untuk mengambil data dari tabel 'data_karyawan'
$data_karyawan_query = mysqli_query($koneksi, "SELECT * FROM data_karyawan ORDER BY id_karyawan DESC");
$data_karyawan = array();
while ($karyawan = mysqli_fetch_assoc($data_karyawan_query)) {
    $data_karyawan[] = $karyawan;
}

// Query untuk mengambil data dari tabel 'data_nilai'
$data_nilai_query = mysqli_query($koneksi, "SELECT * FROM data_nilai");
$data_nilai = array();
while ($nilai = mysqli_fetch_assoc($data_nilai_query)) {
    $data_nilai[] = $nilai;
}

if (isset($_POST['submit'])) {
    // Ambil data yang dipilih dari form
    $no_ticket = $_POST['no_ticket'];
    $timeline = $_POST['timeline'];
    $selectedDataNilai = (int)$_POST['data_nilai'];
    $selectedDataKaryawan = (int)$_POST['data_karyawan'];

    // Masukkan data yang dipilih ke dalam tabel 'data_ticket'
    $insertQuery = "INSERT INTO data_ticket (no_ticket, timeline, id_pelanggan, id_karyawan) VALUES ('$no_ticket', '$timeline', $selectedDataNilai, $selectedDataKaryawan)";
    mysqli_query($koneksi, $insertQuery);

    // Tampilkan pesan sukses atau lakukan tindakan lebih lanjut
    echo "Data berhasil disimpan ke dalam tabel data_ticket!";
}
?>


<div class="row">
    <div class="col-md-12">
        <div class="card mx-auto">
            <h2 class="card-title">Time Line</h2>
            <h4 class="card-title">Berikut adalah aturan Penanganan Ticket Gangguan Pelanggan:</h4>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>Prioritas</th>
                            <th>Waktu Penyelesaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>High</td>
                            <td>2 Jam setelah ticket diProses</td>
                        </tr>
                        <tr>
                            <td>Medium</td>
                            <td>5 Jam setelah ticket diProses</td>
                        </tr>
                        <tr>
                            <td>Low</td>
                            <td>8 Jam setelah ticket diProses</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mx-auto">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">people</i>
                </div>
                <h1 class="card-title">Buat Ticket Penanganan Gangguan Pelanggan</h1>
                <div class="table-responsive">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="data_ticket">Nomer Ticket:</label>
                            <input type="text" name="no_ticket" class="form-control"
                                value="<?php echo substr(uniqid(), 0, 10); ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label for="data_ticket">Time Line Pengerjaan:</label>
                            <select name="timeline" class="form-control" required="true">
                                <?php
        // Ambil nilai dari tipe data ENUM di database (2jam, 5jam, 8jam)
        $timeline_values = array('2Jam', '5Jam', '8Jam');

        // Loop melalui nilai ENUM dan tampilkan sebagai opsi dalam elemen select
        foreach ($timeline_values as $value) {
            echo '<option value="' . $value . '">' . $value . '</option>';
        }
        ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="data_nilai">Nama Pelanggan:</label>
                                <select name="data_nilai" class="form-control" required="true">
                                    <option value="">~ Pilih Nama Pelanggan ~</option>
                                    <?php 
                                    foreach ($data_nilai as $nilai) {
                                        // Ambil id_pelanggan dari data pelanggan saat ini
                                        $idPelanggan = $nilai['id_pelanggan'];
                                    
                                        // Query untuk mendapatkan status tiket dari data_ticket berdasarkan id_pelanggan
                                        $statusTicketQuery = mysqli_query($koneksi, "SELECT status_ticket FROM data_ticket WHERE id_pelanggan='$idPelanggan'");
                                        $statusTicketData = mysqli_fetch_array($statusTicketQuery);
                                        $statusTicket = $statusTicketData['status_ticket'];
                                    
                                        // Cek apakah status tiket adalah 'DONE'
                                        $isTicketDone = $statusTicket === 'DONE';
                                    
                                        // Jika tiket sudah selesai, sembunyikan data_nilai dengan menambahkan kondisi berikut:
                                        if ($isTicketDone) {
                                            continue; // Lewatkan iterasi ini dan lanjutkan ke iterasi selanjutnya (data tidak akan ditampilkan)
                                        }
                                    
                                        // Jika tiket belum selesai, maka tampilkan opsi untuk pelanggan ini dalam elemen select
                                        // beserta informasi yang ingin ditampilkan (nama pelanggan, no internet, tanggal, jenis gangguan, deskripsi, dan lainnya)
                                        $selectedDataHasil = null;
                                        $selectedKet = null;
                                        foreach ($data_hasil as $data) {
                                            if ($data['id_pelanggan'] === $nilai['id_pelanggan']) {
                                                $selectedDataHasil = $data['hasil'];
                                                $selectedKet = $data['ket'];
                                                break;
                                            }
                                        }
                                        echo '<option value="' . $nilai['id_pelanggan'] . '">' . $nilai['nama_pelanggan'] . ' - ' . $nilai['no_internet'] . ' - ' . $nilai['tanggal'] . ' - ' . $nilai['jenis_gangguan'] . ' - ' . $nilai['deskripsi'] . ' - ' . $selectedDataHasil . ' - ' . $selectedKet . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="data_karyawan">Karyawan Teknisi Lapangan:</label>
                                <select name="data_karyawan" class="form-control">
                                    <option value="">~ Pilih Karyawan Teknisi Lapangan untuk menangani gangguan ~
                                    </option>
                                    <?php foreach ($data_karyawan as $karyawan) {
                                    echo '<option value="' . $karyawan['id_karyawan'] . '">' . $karyawan['nama_karyawan'] . ' - ' . $karyawan['no_hpkaryawan'] . ' - ' . $karyawan['email_karyawan'] . '</option>';
                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
                </form>
            </div>
        </div>

        <?php include 'src/footer.php'; ?>