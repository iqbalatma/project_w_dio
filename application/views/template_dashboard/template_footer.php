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
                timer: 5000,
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
        <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/datatables/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
                // Add Row
                $('#add-row').DataTable({
                    "pageLength": 25,
                });
            });

            $(document).ready(function() {
                $('#table-kas').DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: -1,
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return `Detail untuk kode : ${data[7]}`;
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                        }
                    },
                    columnDefs: [{
                        className: 'control',
                        orderable: false,
                        targets: -1
                    }],
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

    <?php if (isset($select2)) { ?>
        <!-- Select2 -->
        <script src="<?= base_url('vendor/select2/select2/dist/js/select2.min.js') ?>"></script>
    <?php } ?>

    <!-- Atlantis JS -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/atlantis.min.js"></script>



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
    // cek hanya untuk controller data-master-produk ($submenuActive itu isinya nama controller)
    // untuk hitung prosentase margin keuntungan ketika edit harga jual produk
    if ($submenuActive == 'data-master-produk') : ?>
        <script>
            // inisiasi variable
            let input           = $('.live-typing'),
                output          = $('.live-output'),
                hpp             = $('.hpp'),
                sellingprice    = $('.sellingprice');

            // output prosentase margin
            output.text(((sellingprice.val() - hpp.val()) / hpp.val() * 100).toFixed(2) + ' %');

            // hitung PROSENTASE MARGIN DARI HPP DAN INPUT HARGA JUAL secara live
            sellingprice.bind('keydown keypress', function() {
                setTimeout(function() {
                    output.text(((sellingprice.val() - hpp.val()) / hpp.val() * 100).toFixed(2) + ' %');
                }, 0);
            });
        </script>
    <?php endif; ?>

    <?php
    // cek hanya untuk controller Kasir ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'kasir' || $submenuActive == 'data-transaksi-barang') : ?>
        <script>
            // untuk set select2 libs, jgn lupa lempar parameter {'select2' => 1}  di method
            $(document).ready(function() {
                $('.select2').select2();
            });

            // fungsi enable/disabled qty dan harga custom
            // btn diclick
            $('.kasir-product').on('click', function() {
                // ambil id btn
                let btnId   = this.id;
                // pecah id btn
                let splitId = btnId.split("-");
                // ambil hanya nomor id btn saja
                let id      = splitId[1];
                // tambahkan nomor id ke belakang nama id dari element quantity dan custom price
                let kasirQuantity   = '#kasirquantity-' + id;
                let customPrice     = '#kasircustomprice-' + id;

                // cek btn .kasir-product dengan id btn yg diclick
                if ($(this).prop('checked')) {
                    // ENABLE qty dan custom harga jika button dengan id yg sama diklik
                    $(kasirQuantity).prop('disabled', false);
                    $(customPrice).prop('disabled', false);
                } else {
                    // DISABLE qty dan custom harga jika button dengan id yg sama diklik
                    $(kasirQuantity).prop('disabled', true);
                    $(customPrice).prop('disabled', true);
                }
            });

            //show or hide when the toggle-btn is clicked
            $('.toggle-btn').on('click', function() {
                if ($('.toggle-item').is(':hidden')) {
                    $('.toggle-item').fadeIn();
                } else {
                    $('.toggle-item').fadeOut();
                }
            });

            // Add dot(s) automagically to input text
            $('#paid_amount').on("keyup", function(event) {
                let maxLength = 9;
                var selection = window.getSelection().toString();

                // kalo buat pilihan atau pencet panah, maka keluar
                if (selection !== '') return;
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) return;

                // ambil value skrg di inputan
                var $this   = $(this);
                var inputz  = $this.val();

                // replace sama kosong kalo selain Digits
                var inputz = inputz.replace(/[\D\s\._\-]+/g, "");

                // kalo panjangnya lebih dari maxLength, maka ambil sejumlah maxLength
                if (inputz.length > maxLength) inputz = inputz.substr(0, maxLength);

                // jaddiin integer
                inputz = inputz ? parseInt(inputz, 10) : 0;

                $this.val(function() {
                    // format ke INDONESIA = id-ID
                    return (inputz === 0) ? "" : inputz.toLocaleString("id-ID");
                });
            });

            // untuk modal pada konfirmasi kasir (tipe bayar)
            let kontrabon         = $("#kontrabon")
            let transfer          = $("#transfer")
            let cash              = $("#cash")
            let paymentCashInput  = $(".payment_cash")

            $(cash).on("click", function() {
                paymentCashInput.fadeIn()
            })
            $(kontrabon).on("click", function() {
                paymentCashInput.fadeOut()
            })
            $(transfer).on("click", function() {
                paymentCashInput.fadeOut()
            })
        </script>
    <?php endif; ?>

    <?php
    // cek hanya untuk controller Data_master_pelanggan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'data-master-pelanggan') : ?>
        <script>
            // fungsi menampilkan tombol tambah
            $(function() {
                if ($('input[name="show-or-hide"]').prop('checked')) {
                    console.log('1')
                    $('.add-customprice-div').fadeIn();
                } else {
                    console.log('2')
                    $('.add-customprice-div').hide();
                }

                //show it when the show-or-hide is clicked
                $('input[name="show-or-hide"]').on('click', function() {
                    if ($(this).prop('checked')) {
                        console.log('3')
                        $('.add-customprice-div').fadeIn();
                    } else {
                        console.log('4')
                        $('.add-customprice-div').hide();
                    }
                });
            });

            // fungsi menambah input box
            $(function() {
                // Add new element
                $(".add-customprice-div").click(function() {
                    console.log('custom price div')
                    // Finding total number of elements added
                    var total_element = $(".element").length;
                    // last <div> with element class id
                    var lastid = $(".element:last").attr("id");
                    var split_id = lastid.split("-");
                    var nextindex = Number(split_id[1]) + 1;
                    // set max product
                    var max = 21;
                    // Check total number elements
                    if (total_element < max) {
                        // Adding new div container after last occurance of element class
                        $(".element:last").after(`
                            <div class='element' id='div-${nextindex}'></div>
                        `);
                        // Adding element to <div>
                        $("#div-" + nextindex).append(`
                        <div class='d-flex justify-content-center'>
                            <div class='col-6 form-group row mx-auto'>
                                <label>Kode produk (${nextindex}) <span class="text-danger">*</span></label>
                                    <select required class="form-control select2" id='add-customproduct-${nextindex}' name='custom[${nextindex}][product_code]'>
                                    <option selected disabled>-- Pilih produk --</option>
                                    <?php foreach ($products as $row) : ?>
                                        <option value='<?= "{$row['product_code']}" ?>'>
                                            <?= "{$row['product_code']} - {$row['full_name']} (Rp.&nbsp;" . number_format($row['selling_price'], 0, '', '.') . ")"; ?>
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <div class='col-4 form-group row mx-auto'>
                                <label>Harga kustom (${nextindex}) <span class="text-danger">*</span></label>
                                <input required type='tel' pattern="[0-9]{1,8}" title="Harga harus angka minimal 1 dan maksimal angka" placeholder='Input harga' id='add-customprice-${nextindex}' name='custom[${nextindex}][price]' class='form-control form-control-sm'>
                            </div>
                            <div class='py-4 h1'>
                                <span id='remove-${nextindex}' class='remove h2 text-danger'>&times</span>
                            </div>
                        </div>
                    `);
                    }

                    // untuk set select2 libs hanya ketika element di atas ditambah
                    $(document).ready(function() {
                        console.log('select2')
                        $('.select2').select2();
                    });
                });

                // Remove element
                $('.bungkus').on('click', '.remove', function() {
                    console.log('bungkus')
                    var id = this.id;
                    var split_id = id.split("-");
                    var deleteindex = split_id[1];
                    // Remove <div> with id
                    $("#div-" + deleteindex).remove();

                });
            });
        </script>
    <?php endif; ?>

    <?php
    // cek hanya untuk controller Data_master_pelanggan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'data-master-produk') : ?>
        <script>
            // fungsi menampilkan tombol tambah
            $(function() {
                if ($('input[name="show-or-hide"]').prop('checked')) {
                    $('.add-komposisi-div').fadeIn();
                } else {
                    $('.add-komposisi-div').hide();
                }

                //show it when the show-or-hide is clicked
                $('input[name="show-or-hide"]').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('.add-komposisi-div').fadeIn();
                    } else {
                        $('.add-komposisi-div').hide();
                    }
                });
            });

            // fungsi menambah input box
            $(function() {
                // Add new element
                $(".add-komposisi-div").click(function() {
                    // Finding total number of elements added
                    var total_element = $(".element").length;
                    // last <div> with element class id
                    var lastid = $(".element:last").attr("id");
                    var split_id = lastid.split("-");
                    var nextindex = Number(split_id[1]) + 1;
                    // set max product
                    var max = 16;
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
                                <label>Kode bahan baku (${nextindex}) <span class="text-danger">*</span></label>
                                    <select required class="form-control select2" id='add-bahanbaku-${nextindex}' name='custom[${nextindex}][material_code]'>
                                    <option selected disabled>-- Pilih bahan baku --</option>
                                    <?php if (isset($materials)) : foreach ($materials as $row) : ?>
                                        <option value=<?= "{$row['material_code']}" ?>>
                                            <?= "{$row['material_code']} - {$row['full_name']}" ?>
                                        </option>
                                    <?php endforeach;
                                    endif; ?>
                                    </select>
                                </label>
                            </div>
                            <div class='form-group row mx-auto'>
                                <label>Total volume / qty (${nextindex}) <span class="text-danger">*</span></label>
                                <input required type='tel' pattern="[0-9]{1,6}" title="Harus angka minimal 1 dan maksimal 6 angka" placeholder='Input volume / qty' id='add-komposisi-${nextindex}' name='custom[${nextindex}][volume]' class='form-control' data-filter="\+?\d{0,8}">
                            </div>
                            <div class='py-4 h1'>
                                <span id='remove-${nextindex}' class='remove h2 text-danger'>&times</span>
                            </div>
                        </div>
                    `);
                    }

                    // untuk set select2 libs hanya ketika element di atas ditambah
                    $(document).ready(function() {
                        $('.select2').select2();
                    });
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

    <?php
    // cek hanya untuk controller Data_kas_perusahaan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'data-kas-perusahaan') : ?>
        <script>
            // Add dot(s) automagically to input text
            $('#add-nominal').on("keyup", function(event) {
                let maxLength = 9;
                var selection = window.getSelection().toString();

                // kalo buat pilihan atau pencet panah, maka keluar
                if (selection !== '') return;
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) return;

                // ambil value skrg di inputan
                var $this = $(this);
                var inputz = $this.val();

                // replace sama kosong kalo selain Digits
                var inputz = inputz.replace(/[\D\s\._\-]+/g, "");

                // kalo panjangnya lebih dari maxLength, maka ambil sejumlah maxLength
                if (inputz.length > maxLength) inputz = inputz.substr(0, maxLength);

                // jaddiin integer
                inputz = inputz ? parseInt(inputz, 10) : 0;

                $this.val(function() {
                    // format ke INDONESIA = id-ID
                    return (inputz === 0) ? "" : inputz.toLocaleString("id-ID");
                });
            });
        </script>
    <?php endif; ?>

    <?php
    // cek hanya untuk controller Data_kas_perusahaan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'data-hutang-piutang') : ?>
        <script>
            // Add dot(s) automagically to input text
            $('#pembayaran').on("keyup", function(event) {
                let maxLength = 9;
                var selection = window.getSelection().toString();

                // kalo buat pilihan atau pencet panah, maka keluar
                if (selection !== '') return;
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) return;

                // ambil value skrg di inputan
                var $this = $(this);
                var inputz = $this.val();

                // replace sama kosong kalo selain Digits
                var inputz = inputz.replace(/[\D\s\._\-]+/g, "");

                // kalo panjangnya lebih dari maxLength, maka ambil sejumlah maxLength
                if (inputz.length > maxLength) inputz = inputz.substr(0, maxLength);

                // jaddiin integer
                inputz = inputz ? parseInt(inputz, 10) : 0;

                $this.val(function() {
                    // format ke INDONESIA = id-ID
                    return (inputz === 0) ? "" : inputz.toLocaleString("id-ID");
                });
            });
        </script>
    <?php endif; ?>


    <?php // input filter for all input with data-filter properties ?>
    <script>
        // Apply filter to all inputsFilter with data-filter. The filter is depend on RegEx in every data-filter on input tag
        var inputsFilter = document.querySelectorAll('input[data-filter]');

        for (var i = 0; i < inputsFilter.length; i++) {
            var inputs = inputsFilter[i];
            var state = {
                value: inputs.value,
                start: inputs.selectionStart,
                end: inputs.selectionEnd,
                pattern: RegExp('^' + inputs.dataset.filter + '$')
            };

            inputs.addEventListener('input', function(event) {
                if (state.pattern.test(inputs.value)) {
                    state.value = inputs.value;
                } else {
                    inputs.value = state.value;
                    inputs.setSelectionRange(state.start, state.end);
                }
            });

            inputs.addEventListener('keydown', function(event) {
                state.start = inputs.selectionStart;
                state.end = inputs.selectionEnd;
            });
        }
    </script>









    <?php
    // cek hanya untuk controller Data_master_pelanggan ($submenuActive itu isinya nama controller)
    if ($submenuActive == 'demooo') : ?>
        <?php // script bawaan template (jangan dihapus dulu dipake buat contoh bikin chart) 
        ?>
        <?php // =========================================================================== 
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
    <?php endif; ?>
    <?php // =========================================================================== 
    ?>



    </body>

    </html>


    <?php
    // $xxx  = (memory_get_usage() - $start_memory) / 1000000;
    // $xxx .= ' MB memory terpakai';

    // echo '<script>';
    // echo 'console.log("' . $xxx . '");';
    // echo '</script>';

    // end_time('kasir_limit_10000', 's');
    ?>