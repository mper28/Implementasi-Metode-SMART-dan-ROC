<?php
include 'src/header.php';

$hapus = mysqli_query($koneksi, "TRUNCATE TABLE data_hasil");

//MIN MAX
$QueryMin = mysqli_query($koneksi, "SELECT min(k1) as minK1, min(k2) as minK2, min(k3) as minK3, min(k4) as minK4 FROM data_nilai");
$DataMin  = mysqli_fetch_array($QueryMin);

$QueryMax = mysqli_query($koneksi, "SELECT max(k1) as maxK1, max(k2) as maxK2, max(k3) as maxK3, max(k4) as maxK4 FROM data_nilai");
$DataMax  = mysqli_fetch_array($QueryMax);

//BOBOT
$arrayBobot = array();
$QueryBobot = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
while($DataBobot = mysqli_fetch_array($QueryBobot)){
  array_push($arrayBobot, $DataBobot['bobot'] / 100);
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">apps</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Normalisasi Nilai alternatif</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
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
                                <td><?= $data['k1'] ?></td>
                                <td><?= $data['k2'] ?></td>
                                <td><?= $data['k3'] ?></td>
                                <td><?= $data['k4'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Proses Perhitungan Nilai utility
                            dengan rumus (Cout-Cmin)/(Cmax-cmin)*100=
                        </h4>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Pelanggan</th>

                                        <?php
                                $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                                while($dt = mysqli_fetch_array($qry)){
                                    echo "<th class='text-center'>$dt[nama_kriteria]</th>";
                                }
                                ?>

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
                                $k1 = (($data['k1'] - $DataMin['minK1']) / ($DataMax['maxK1'] - $DataMin['minK1'])) * 100;
                                $k2 = (($data['k2'] - $DataMin['minK2']) / ($DataMax['maxK2'] - $DataMin['minK2'])) * 100;
                                $k3 = (($data['k3'] - $DataMin['minK3']) / ($DataMax['maxK3'] - $DataMin['minK3'])) * 100;
                                $k4 = (($data['k4'] - $DataMin['minK4']) / ($DataMax['maxK4'] - $DataMin['minK4'])) * 100;
                                            

                                $hasil = $k1 + $k2 + $k3 + $k4 ;

                                if ($hasil <= 50) {
                                    $ket = "Low";
                                } elseif ($hasil <= 80) {
                                    $ket = "Medium";
                                } else {
                                    $ket = "High";
                                }

                                $simpan = mysqli_query($koneksi, "INSERT data_hasil VALUES('','$data[id_pelanggan]','$hasil','$ket')");
                            ?>
                                    <tr class="text-center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_pelanggan'] ?></td>

                                        <?php
                                    // Menampilkan proses perhitungan
                                    echo "<td>($data[k1] - $DataMin[minK1]) / ($DataMax[maxK1] - $DataMin[minK1]) * 100 = $k1</td>";
                                    echo "<td>($data[k2] - $DataMin[minK2]) / ($DataMax[maxK2] - $DataMin[minK2]) * 100 = $k2</td>";
                                    echo "<td>($data[k3] - $DataMin[minK3]) / ($DataMax[maxK3] - $DataMin[minK3]) * 100 = $k3</td>";
                                    echo "<td>($data[k4] - $DataMin[minK4]) / ($DataMax[maxK4] - $DataMin[minK4]) * 100 = $k4</td>";
                                ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">apps</i>
            </div>
            <div class="card-content">
            <h2 class="card-title">Perhitungan akhir</h2>
                <h4 class="card-title">Perhitungan dengan mengkalikan antara hasil perhitungan nilai utility dikalikan dengan bobot tiap kriteria padahalaman data kriteria</h4>
                <div class="material-datatables">
                    <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Pelanggan</th>

                                <?php
                                $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                                while($dt = mysqli_fetch_array($qry)){
                                  echo "<th class='text-center'>$dt[nama_kriteria]</th>";
                                }
                                ?>
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
                                    $k1 = @((($data['k1'] - $DataMin['minK1']) / ($DataMax['maxK1'] - $DataMin['minK1'])) * 100) * $arrayBobot[0];
                                    $k2 = @((($data['k2'] - $DataMin['minK2']) / ($DataMax['maxK2'] - $DataMin['minK2'])) * 100) * $arrayBobot[1];
                                    $k3 = @((($data['k3'] - $DataMin['minK3']) / ($DataMax['maxK3'] - $DataMin['minK3'])) * 100) * $arrayBobot[2];
                                    $k4 = @((($data['k4'] - $DataMin['minK4']) / ($DataMax['maxK4'] - $DataMin['minK4'])) * 100) * $arrayBobot[3];
                                    

                                    $hasil = $k1 + $k2 + $k3 + $k4 ;

                                    if ($hasil <= 50) {
                                        $ket = "Low";
                                    } elseif ($hasil <= 80) {
                                        $ket = "Medium";
                                    } else {
                                        $ket = "High";
                                    }

                                   // Periksa apakah data sudah ada dalam tabel data_hasil
$checkData = mysqli_query($koneksi, "SELECT * FROM data_hasil WHERE id_pelanggan = '$data[id_pelanggan]'");
if (mysqli_num_rows($checkData) == 0) {
    $simpan = mysqli_query($koneksi, "INSERT INTO data_hasil VALUES('', '$data[id_pelanggan]', '$hasil', '$ket')");
} else {
    // Jika data sudah ada, lakukan update
    $update = mysqli_query($koneksi, "UPDATE data_hasil SET hasil = '$hasil', ket = '$ket' WHERE id_pelanggan = '$data[id_pelanggan]'");
}
  ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_pelanggan'] ?></td>
                                <td><?= $k1 ?></td>
                                <td><?= $k2 ?></td>
                                <td><?= $k3 ?></td>
                                <td><?= $k4 ?></td>
                                <!-- <td></td> -->

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">apps</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Hasil Akhir </h4>
                <form method="POST" action="hasil_cetak_alternatif.php" target="_blank()">
                    <div class="form-group ">
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
                <a href="hasil_cetak.php" target="_blank()"><button type="button"
                        class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span
                            aria-hidden="true"></span>Cetak</button></a>
                <div class="material-datatables">
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">No Internet</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Jenis Gangguan</th>
                                <?php
                                $qry  = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                                while($dt = mysqli_fetch_array($qry)){
                                  echo "<th class='text-center'>$dt[nama_kriteria]</th>";
                                }
                                ?>
                                <th class="text-center">Hasil Perhitungan</th>
                                <th class="text-center">Prioritas</th>
                                <th class="text-center">Deskripsi Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT data_nilai.*, data_hasil.* FROM data_hasil, data_nilai WHERE data_hasil.id_pelanggan = data_nilai.id_pelanggan");
                                while($data = mysqli_fetch_array($query)){
                                    include 'src/kondisi.php';
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
                                  

                                    if ($data['ket'] == "Medium") {
                                        $keterangan = "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden='true'></span>Medium</button>";
                                    } elseif ($data['ket'] == "High") {
                                        $keterangan = "<button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden='true'></span>High</button>";
                                    } else {
                                        $keterangan = "
                                        <button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden='true'></span>Low</button>";
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
                                <td><?= $data['hasil'] ?></td>
                                <td><?= $keterangan ?></td>
                                <td text align="left"><?= $data['deskripsi'] ?></td>


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