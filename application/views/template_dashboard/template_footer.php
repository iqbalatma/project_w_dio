    <!-- Start footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright ml-auto">
                © 2020 <a href="http://sabun-aryanz.com">Sabun-aryanz</a> — <a href="#">@Galaxxdev</a>
            </div>
        </div>
    </footer>
    </div>

    <!-- sweetalert modal notification -->
    <?php if ($this->session->flashdata('success_message')) : ?>
        <script>
            swal({
                title: "<?= $this->session->title; ?>",
                text: "<?= $this->session->text; ?>",
                timer: 2000,
                button: false,
                icon: 'success'
            });
        </script>
    <?php endif; ?>
    <?php if ($this->session->flashdata('failed_message')) : ?>
        <script>
            swal({
                title: "<?= $this->session->title; ?>",
                text: "<?= $this->session->text; ?>",
                timer: 2000,
                button: false,
                icon: 'error'
            });
        </script>
    <?php endif; ?>
    <!-- sweetalert end -->

    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/core/bootstrap.min.js"></script>

    <?php if (isset($jqueryui)) { ?>
        <!-- jQuery UI -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <?php } ?>

    <?php if (isset($jqueryscrollbar)) { ?>
        <!-- jQuery Scrollbar -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <?php } ?>


    <?php if (isset($chartjs)) { ?>
        <!-- Chart JS -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart.js/chart.min.js"></script>
    <?php } ?>

    <?php if (isset($sparkline)) { ?>
        <!-- jQuery Sparkline -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <?php } ?>

    <?php if (isset($chartcircle)) { ?>
        <!-- Chart Circle -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart-circle/circles.min.js"></script>
    <?php } ?>

    <?php if (isset($datatables)) { ?>
        <!-- Datatables -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/datatables/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                // Add Row
                $('#add-row').DataTable({
                    "pageLength": 25,
                });
            });
        </script>
    <?php } ?>

    <?php if (isset($bsnotify)) { ?>
        <!-- Bootstrap Notify -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <?php } ?>

    <?php if (isset($vectormaps)) { ?>
        <!-- jQuery Vector Maps -->
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
    <?php } ?>

    <!-- Atlantis JS -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/atlantis.min.js"></script>

    <?php
    /**
     * ! yang di bawah bisa dihapus nanti, cuma bawaan default buat contoh
     */
    ?>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/setting-demo.js"></script>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/demo.js"></script>
    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: 60,
            maxValue: 100,
            width: 7,
            text: 5,
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: 70,
            maxValue: 100,
            width: 7,
            text: 36,
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 40,
            maxValue: 100,
            width: 7,
            text: 12,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                datasets: [{
                    label: "Total Income",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false //this will remove only the label
                        },
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }]
                },
            }
        });

        $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>

    <script>
        $(document).ready(function() {

            // get Edit Product
            $('.btn-edit').on('click', function() {
                // get data from button edit
                var id = $(this).data('id');
                var material_code = $(this).data('material_code');
                var full_name = $(this).data('full_name');
                var unit = $(this).data('unit');
                var volume = $(this).data('volume');
                var price_base = $(this).data('price_base');
                var image = $(this).data('image');
                // Set data to Form Edit
                $('.id').val(id).trigger('change');
                $('.material_code').val(material_code);
                $('.full_name').val(full_name);
                $('.unit').val(unit);
                $('.volume').val(volume);
                $('.price_base').val(price_base);
                $('.image').val(image);

                // Call Modal Edit
                $('#modalUpdate').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('.id').val(id);
            });

        });
    </script>

    <?php
    // hanya untuk controller Data_master_pelanggan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'data-master-pelanggan') : ?>
        <script>
            // fungsi menampilkan tombol tambah
            $(function() {
                if ($('input[name="show-or-hide"]').prop('checked')) {
                    $('.add-customprice-div').fadeIn();
                } else {
                    $('.add-customprice-div').hide();
                }

                //show it when the show-or-hide is clicked
                $('input[name="show-or-hide"]').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('.add-customprice-div').fadeIn();
                    } else {
                        $('.add-customprice-div').hide();
                    }
                });
            });

            // fungsi menambah input box
            $(function() {
                // Add new element
                $(".add-customprice-div").click(function() {
                    // Finding total number of elements added
                    var total_element = $(".element").length;
                    // last <div> with element class id
                    var lastid = $(".element:last").attr("id");
                    var split_id = lastid.split("-");
                    var nextindex = Number(split_id[1]) + 1;
                    // set max product
                    var max = 6;
                    // Check total number elements
                    if (total_element < max) {
                        // Adding new div container after last occurance of element class
                        $(".element:last").after(`
                        <div class='element' id='div-${nextindex}'></div>
                    `);
                        // Adding element to <div>
                        $("#div-" + nextindex).append(`
                        <div class='d-flex justify-content-center'>
                            <div class='form-group row mx-auto'>
                                <label>Kode produk</label>
                                    <input required type='text' placeholder='Input kode' id='add-customproduct-${nextindex}' name='custom[${nextindex}][product_code]' class='form-control'>
                                </label>
                            </div>
                            <div class='form-group row mx-auto'>
                                <label>Harga kustom</label>
                                <input required type='tel' pattern="[0-9]{1,}" title="Harga harus angka dan minimal 1 angka" placeholder='Input harga' id='add-customprice-${nextindex}' name='custom[${nextindex}][price]' class='form-control'>
                            </div>
                            <div class='py-4 h1'>
                                <span id='remove-${nextindex}' class='remove h2 text-danger'>&times</span>
                            </div>
                        </div>
                    `);
                    }
                });

                // Remove element
                $('.bungkus').on('click', '.remove', function() {
                    var id = this.id;
                    var split_id = id.split("-");
                    var deleteindex = split_id[1];
                    // Remove <div> with id
                    $("#div-" + deleteindex).remove();

                });
            });
        </script>



    <?php endif; ?>

    </body>

    </html>