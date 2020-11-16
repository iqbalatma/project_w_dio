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
<?php if ($this->session->flashdata('success_message')): ?>
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
  <?php if ($this->session->flashdata('failed_message')): ?>
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
<?php if ( isset($chartjs) ) { ?>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart.js/chart.min.js"></script>
<?php } ?>

<!-- jQuery Sparkline -->
<?php if ( isset($sparkline) ) { ?>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
<?php } ?>

<!-- Chart Circle -->
<?php if ( isset($chartcircle) ) { ?>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/chart-circle/circles.min.js"></script>
<?php } ?>

<!-- Datatables -->
<?php if ( isset($datatables) ) { ?>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/datatables/datatables.min.js"></script>
<?php } ?>

<!-- Bootstrap Notify -->
<?php if ( isset($bsnotify) ) { ?>
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<?php } ?>

<!-- jQuery Vector Maps -->
<?php if ( isset($vectormaps) ) { ?>
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
</body>

</html>