    </div>
    </div>
    <ul>
        <ul>
            <ul>

                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>

                                <li>
                                    <a href="data_admin.php">
                                        Data Admin
                                    </a>
                                </li>
                                <li>
                                    <a href="data_kriteria.php">
                                        Data Kriteria
                                    </a>
                                </li>
                                <li>
                                    <a href="data_nilai.php">
                                        Data Nilai alnternatif
                                    </a>
                                </li>
                                <li>
                                    <a href="data_hasil.php">
                                        Data Hasil perhitungan
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                            document.write(new Date().getFullYear())
                            </script>
                            <a href="index.php"></a>, IMPLEMENTASI METODE SIMPLE MULTI ATTRIBUTE RATING TECHNIQUE DENGAN
                            PEMBOBOTAN RANK ORDER CENTROID DALAM PENENTUAN PRIORITAS TICKETING PENANGANAN GANGGUAN PADA
                            APLIKASI HELPDESK DI BGES OPERATION
                            WITEL CIREBON
                        </p>
                    </div>
                </footer>
                </div>
                </div>

                </body>
                <!--   Core JS Files   -->
                <script src="../assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
                <script src="../assets/js/jquery-ui.min.js" type="text/javascript"></script>
                <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="../assets/js/material.min.js" type="text/javascript"></script>
                <script src="../assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
                <!-- Forms Validations Plugin -->
                <script src="../assets/js/jquery.validate.min.js"></script>
                <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
                <script src="../assets/js/moment.min.js"></script>
                <!--  Charts Plugin -->
                <script src="../assets/js/chartist.min.js"></script>
                <!--  Plugin for the Wizard -->
                <script src="../assets/js/jquery.bootstrap-wizard.js"></script>
                <!--  Notifications Plugin    -->
                <script src="../assets/js/bootstrap-notify.js"></script>
                <!--   Sharrre Library    -->
                <script src="../assets/js/jquery.sharrre.js"></script>
                <!-- DateTimePicker Plugin -->
                <script src="../assets/js/bootstrap-datetimepicker.js"></script>
                <!-- Vector Map plugin -->
                <script src="../assets/js/jquery-jvectormap.js"></script>
                <!-- Sliders Plugin -->
                <script src="../assets/js/nouislider.min.js"></script>
                <!--  Google Maps Plugin    -->
                <!--<script src="../assets/js/jquery.select-bootstrap.js"></script>-->
                <!-- Select Plugin -->
                <script src="../assets/js/jquery.select-bootstrap.js"></script>
                <!--  DataTables.net Plugin    -->
                <script src="../assets/js/jquery.datatables.js"></script>
                <!-- Sweet Alert 2 plugin -->
                <script src="../assets/js/sweetalert2.js"></script>
                <!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
                <script src="../assets/js/jasny-bootstrap.min.js"></script>
                <!--  Full Calendar Plugin    -->
                <script src="../assets/js/fullcalendar.min.js"></script>
                <!-- TagsInput Plugin -->
                <script src="../assets/js/jquery.tagsinput.js"></script>
                <!-- Material Dashboard javascript methods -->
                <script src="../assets/js/material-dashboard.js"></script>
                <!-- Material Dashboard DEMO methods, don't include it in your project! -->
                <script src="../assets/js/demo.js"></script>
                <script type="text/javascript">
                $(document).ready(function() {

                    // Javascript method's body can be found in assets/js/demos.js
                    demo.initDashboardPageCharts();

                    demo.initVectorMap();
                });
                </script>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#datatables').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
                        }

                    });


                    var table = $('#datatables').DataTable();

                    // Edit record
                    table.on('click', '.edit', function() {
                        $tr = $(this).closest('tr');

                        var data = table.row($tr).data();
                        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] +
                            '\'s row.');
                    });

                    // Delete a record
                    table.on('click', '.remove', function(e) {
                        $tr = $(this).closest('tr');
                        table.row($tr).remove().draw();
                        e.preventDefault();
                    });

                    //Like record
                    table.on('click', '.like', function() {
                        alert('You clicked on Like button');
                    });

                    $('.card .material-datatables label').addClass('form-group');
                });
                </script>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#datatables1').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
                        }

                    });


                    var table = $('#datatables1').DataTable();

                    // Edit record
                    table.on('click', '.edit', function() {
                        $tr = $(this).closest('tr');

                        var data = table.row($tr).data();
                        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] +
                            '\'s row.');
                    });

                    // Delete a record
                    table.on('click', '.remove', function(e) {
                        $tr = $(this).closest('tr');
                        table.row($tr).remove().draw();
                        e.preventDefault();
                    });

                    //Like record
                    table.on('click', '.like', function() {
                        alert('You clicked on Like button');
                    });

                    $('.card .material-datatables label').addClass('form-group');
                });
                </script>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#datatables2').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
                        }

                    });


                    var table = $('#datatables2').DataTable();

                    // Edit record
                    table.on('click', '.edit', function() {
                        $tr = $(this).closest('tr');

                        var data = table.row($tr).data();
                        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] +
                            '\'s row.');
                    });

                    // Delete a record
                    table.on('click', '.remove', function(e) {
                        $tr = $(this).closest('tr');
                        table.row($tr).remove().draw();
                        e.preventDefault();
                    });

                    //Like record
                    table.on('click', '.like', function() {
                        alert('You clicked on Like button');
                    });

                    $('.card .material-datatables label').addClass('form-group');
                });
                </script>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#datatables3').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
                        }

                    });


                    var table = $('#datatables3').DataTable();

                    // Edit record
                    table.on('click', '.edit', function() {
                        $tr = $(this).closest('tr');

                        var data = table.row($tr).data();
                        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] +
                            '\'s row.');
                    });

                    // Delete a record
                    table.on('click', '.remove', function(e) {
                        $tr = $(this).closest('tr');
                        table.row($tr).remove().draw();
                        e.preventDefault();
                    });

                    //Like record
                    table.on('click', '.like', function() {
                        alert('You clicked on Like button');
                    });

                    $('.card .material-datatables label').addClass('form-group');
                });
                </script>

                <?php if(@$_SESSION['sukses']){ ?>
                <script>
                swal("Selamat Datang Admin <?= $dt['nama_admin'] ?>!", "<?php echo $_SESSION['sukses']; ?>", "success");
                </script>
                <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
                <?php unset($_SESSION['sukses']); } ?>


                <!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:16 GMT -->

                </html>