<?php include 'src/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data Kriteria</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Kriteria</th>
                                <th class="text-center">Bobot</th>
                                <th class="text-center">Bobot Akhir</th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM data_kriteria");
                            while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_kriteria'] ?></td>
                                <td><?= $data['bobot'] ?></td>
                                <?php
                                $sqljumlah ="SELECT SUM(bobot) FROM data_kriteria";
                                $queryjumlah= mysqli_query($koneksi,$sqljumlah);
                                $jumlah0=mysqli_fetch_array($queryjumlah);
                                $jumlah = $jumlah0[0];
                                ?>
                                <td><?= round($data['bobot']/$jumlah, 3) ?></td>
                                <td>
                                    <a href="kriteria_edit.php?id_kriteria=<?php echo $data['id_kriteria']; ?>"><button
                                            type="button"
                                            class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span
                                                aria-hidden="true"></span>Edit</button></a>
                                    <a href="kriteria_delete.php?id_kriteria=<?php echo $data['id_kriteria']; ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button
                                            type="button"
                                            class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span
                                                aria-hidden="true"></span>Delete</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr class="inverse">
                                <td colspan="2">Total</td>
                                <td><?= $jumlah ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Data Kriteria</h4>
                <div class="table-responsive">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria"
                                placeholder="Input Nama Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="bobot">Bobot</label>
                            <input type="number" class="form-control" name="bobot" placeholder="Input Bobot" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'
                                name="simpan"><span aria-hidden="true"></span>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>