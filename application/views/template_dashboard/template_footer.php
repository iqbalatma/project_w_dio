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

    <!-- jQuery UI -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <?php if (isset($chartjs)) { ?>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart.js/chart.min.js"></script>
    <?php } ?>

    <!-- jQuery Sparkline -->
    <?php if (isset($sparkline)) { ?>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <?php } ?>

    <!-- Chart Circle -->
    <?php if (isset($chartcircle)) { ?>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart-circle/circles.min.js"></script>
    <?php } ?>

    <!-- Datatables -->
    <?php if (isset($datatables)) { ?>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/datatables/datatables.min.js"></script>
    <?php } ?>

    <!-- Bootstrap Notify -->
    <?php if (isset($bsnotify)) { ?>
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <?php } ?>

    <!-- jQuery Vector Maps -->
    <?php if (isset($vectormaps)) { ?>
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
    <!-- <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/setting-demo.js"></script>
<script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/demo.js"></script> -->
    <!-- <script>
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
</script> -->


    <script>
        $(document).ready(function() {




            // get Edit Product
            // $('.btn-edit').on('click', function() {
            //     // get data from button edit
            //     var id = $(this).data('id');
            //     var material_code = $(this).data('materialcode');
            //     var full_name = $(this).data('fullname');
            //     var unit = $(this).data('unitbahan');
            //     var volume = $(this).data('volumeinput');
            //     var price_base = $(this).data('pricebase');
            //     var image = $(this).data('image');
            //     // Set data to Form Edit
            //     $('.id').val(id).trigger('change');
            //     $('.materialcode').val(material_code);
            //     $('.fullname').val(full_name);
            //     $('.unitbahan').val(unit);
            //     $('.volumeinput').val(volume);
            //     $('.pricebase').val(price_base);
            //     $('.image').val(image);

            //     // Call Modal Edit
            //     $('#modalUpdate').modal('show');
            //     // $.ajax({
            //     //     url: "<?php echo base_url('data-gudang/Data_barang_kimia/update'); ?>",
            //     //     type: 'POST',
            //     //     data: form_data1,
            //     //     success: function(msg) {
            //     //         if (msg == 'YES')
            //     //             $('#alert-msg').html('<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
            //     //         else if (msg == 'NO')
            //     //             $('#alert-msg').html('<div class="alert alert-danger text-center">Error in sending your message! Please try again later.</div>');
            //     //         else
            //     //             // alert(imageinput.files);
            //     //             $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
            //     //     }
            //     // });
            //     // return false;
            // });

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');

                $('.id').val(id);



            });


            // $('#submit_barang_masuk').click(function() {
            //     var form_data = {
            //         material_code: $('#material_code').val(),
            //         store: $('#store').val(),
            //         quantity: $('#quantity').val(),
            //         updated_by: $('#updated_by').val(),


            //     };
            //     $.ajax({
            //         url: "<?php echo base_url('data-gudang/Data_barang_masuk/insert'); ?>",
            //         type: 'POST',
            //         data: form_data,
            //         success: function(msg) {
            //             if (msg == 'YES')
            //                 $('#alert-msg').html('<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
            //             else if (msg == 'NO')
            //                 $('#alert-msg').html('<div class="alert alert-danger text-center">Error in sending your message! Please try again later.</div>');
            //             else
            //                 $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
            //         }
            //     });
            //     return false;
            // });


            // $('#submit_barang_kimia').click(function() {
            //     var form_data1 = {
            //         material: $('#material').val(),
            //         fullname: $('#fullname').val(),
            //         volumeinput: $('#volumeinput').val(),
            //         pricebase: $('#pricebase').val(),
            //         unitbahan: $('#unitbahan').val(),
            //         // imageinput: $('#imageinput').val(),


            //     };
            //     $.ajax({
            //         url: "<?php echo base_url('data-gudang/Data_barang_kimia/insert'); ?>",
            //         type: 'POST',
            //         data: form_data1,
            //         success: function(msg) {
            //             if (msg == 'YES')
            //                 $('#alert-msg').html('<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
            //             else if (msg == 'NO')
            //                 $('#alert-msg').html('<div class="alert alert-danger text-center">Error in sending your message! Please try again later.</div>');
            //             else
            //                 // alert(imageinput.files);
            //                 $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
            //         }
            //     });
            //     return false;
            // });

            // $('#submit_barang_kimia').click(function() {
            //     var form_data2 = {
            //         material: $('#material').val(),
            //         fullname: $('#fullname').val(),
            //         volumeinput: $('#volumeinput').val(),
            //         pricebase: $('#pricebase').val(),
            //         unitbahan: $('#unitbahan').val(),
            //         // imageinput: $('#imageinput').val(),


            //     };
            //     $.ajax({
            //         url: "<?php echo base_url('data-gudang/Data_barang_kimia/update'); ?>",
            //         type: 'POST',
            //         data: form_data1,
            //         success: function(msg) {
            //             if (msg == 'YES')
            //                 $('#alert-msg').html('<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
            //             else if (msg == 'NO')
            //                 $('#alert-msg').html('<div class="alert alert-danger text-center">Error in sending your message! Please try again later.</div>');
            //             else
            //                 // alert(imageinput.files);
            //                 $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
            //         }
            //     });
            //     return false;
            // });

        });
    </script>


    <script type="text/javascript">

    </script>


    <script type="text/javascript">

    </script>
    </body>

    </html>