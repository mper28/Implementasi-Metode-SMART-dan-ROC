<?php include 'src/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">apps</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data Nilai</h4>
                <form method="POST" action="nilai_cetak_alternatif.php" target="_blank()">
                    <div class="form-group">
                        <label class="form-control-label" for="nama_pelanggan">Nama Pelanggan</label>
                        <select class="form-control" name="nama_pelanggan">
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT * FROM data_nilai GROUP BY nama_pelanggan");
                            while($datas = mysqli_fetch_array($sql)){
                                echo "<option value='$datas[nama_pelanggan]'>$datas[nama_pelanggan]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" align="right">
                        <button type="submit" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'
                            name="cetak"><span aria-hidden="true"></span>Cetak</button>
                    </div>
                </form>

                <form method="POST" action="filter_tanggal.php">
                    <div class="form-group">
                        <label class="form-control-label">Filter Tanggal</label>
                        <select class="form-control" name="tanggal">
                            <option value="today">Hari Ini</option>
                            <option value="1_week">1 Minggu</option>
                            <option value="1_month">1 Bulan</option>
                            <option value="6_months">6 Bulan</option>
                            <option value="1_year">1 Tahun</option>
                        </select>
                    </div>
                    <div class="form-group" align="right">
                        <button type="submit" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'
                            name="submit"><span aria-hidden="true"></span>Filter</button>
                    </div>
                </form>

                <a href="nilai_tambah.php"><button type="button"
                        class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span
                            aria-hidden="true"></span>Tambah Data</button></a>
                <a href="nilai_cetak.php" target="_blank()"><button type="button"
                        class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span
                            aria-hidden="true"></span>Cetak</button></a>
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
                            $query = mysqli_query($koneksi, "SELECT * FROM data_nilai");
                            while($data = mysqli_fetch_array($query)){
                                include 'src/kondisi.php';
                                // Ambil status tiket terkait dari tabel data_ticket berdasarkan id_pelanggan
    $idPelanggan = $data['id_pelanggan'];
    $statusTicketQuery = mysqli_query($koneksi, "SELECT status_ticket FROM data_ticket WHERE id_pelanggan='$idPelanggan'");
    $statusTicketData = mysqli_fetch_array($statusTicketQuery);

    // Periksa apakah ada data tiket terkait dengan pelanggan
    if ($statusTicketData !== null) {
        $statusTicket = $statusTicketData['status_ticket'];

        // Cek apakah status tiket adalah 'DONE'
        $isTicketDone = $statusTicket === 'DONE';

        // Jika tiket sudah selesai, sembunyikan data_nilai dengan menambahkan kondisi berikut:
        if ($isTicketDone) {
            continue; // Lewatkan iterasi ini dan lanjutkan ke iterasi selanjutnya (data tidak akan ditampilkan)
        }
    }
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
            </div>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>