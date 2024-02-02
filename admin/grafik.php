<?php include 'src/header.php'; ?>

<div class="container">
    <div class="" align=" center">
        <h2>Grafik Gangguan pelanggan</h2>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th bgcolor="yellow">Kriteria</th>
                                <th bgcolor="yellow">Persentase (%)</th>
                            </tr>
                        </thead>

                        <tr>
                            <td>Cara Membaca</td>
                            <td>75%</td>
                        </tr>

                        <tr>
                            <td>Menulis</td>
                            <td>65%</td>
                        </tr>
                        <tr>
                            <td>Mewarnai</td>
                            <td>77%</td>
                        </tr>

                        <tr>
                            <td>Keaktifan Bermain</td>
                            <td>88%</td>
                        </tr>
                        <tr>
                            <td>Perilaku Siswa</td>
                            <td>90%</td>
                        </tr>





                        <tbody id="">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-primary">

                <div class="panel-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'src/footer.php'; ?>