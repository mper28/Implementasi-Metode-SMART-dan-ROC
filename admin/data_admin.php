<?php include 'src/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data Admin</h4>
                <a href="admin_tambah.php"><button type="button"
                        class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span
                            aria-hidden="true"></span>Tambah User</button></a>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Admin</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Password</th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM data_admin");
                                while($data = mysqli_fetch_array($query)){
                              ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_admin'] ?></td>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['password'] ?></td>
                                <td>
                                    <a href="admin_edit.php?id_admin=<?php echo $data['id_admin']; ?>"><button
                                            type="button"
                                            class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span
                                                aria-hidden="true"></span>Edit</button></a>
                                    <a href="admin_hapus.php?id_admin=<?php echo $data['id_admin']; ?>"><button
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