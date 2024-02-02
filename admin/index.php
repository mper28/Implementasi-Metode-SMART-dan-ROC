<?php
include 'src/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="red">
                <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Dashboard Admin</h4>
                <h4 class="card-title">Profil Perusahaan</h4>
                <div class="material-datatables">

                    <div class="material-datatables">
                        <h3 align="center">PROFIL BGES Operation Telekomunikasi Indonesia Witel Cirebon</h3>
                        <img class="center" src="../logo1.png" width="5" />
                        <hr>
                        <div class="card-body">
                            <strong>Nama </strong><br>
                            <input type="text" value="Telkom Cirebon" readonly class="form-control mt-2 mb-2"><br>
                            <strong>Alamat : </strong><br>
                            <input type="text"
                                value="Jl. Pagongan No.11, Pekalangan, Kec. Pekalipan, Kota Cirebon, Jawa Barat 45118, Indonesia"
                                readonly class="form-control mt-2"><br>
                            <strong>Website : </strong><br>
                            <input type="text" value="www.telkom.co.id" readonly class="form-control mt-2"><br>
                            <strong>Telepon : </strong><br>
                            <input type="text" value="081223835475" readonly class="form-control mt-2"><br>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'src/footer.php'; ?>