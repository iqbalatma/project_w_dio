<div class="content">
    <?php if ($this->session->flashdata('message_berhasil')) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('message_berhasil'); ?>
        </div>
    <?php
    }; ?>
    <?php if ($this->session->flashdata('message_gagal')) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('message_gagal'); ?>
        </div>
    <?php
    }; ?>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="<?= base_url(); ?>">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Kasir</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Kasir'); ?>">Checkout Kasir</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Checkout Station</div>
                    </div>

                    <?= form_open('Kasir/konfirmasi_kasir'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <select class="form-control" id="nama_pelanggan" name="nama_pelanggan" onchange='changeValue(this.value)' required>
                                        <option value="" selected disabled>-Pilih Pelanggan-</option>


                                        <?php
                                        $jsArray = "var prdName = new Array();\n";
                                        foreach ($data_customer as $row) {
                                        ?>
                                            <option name="id_customer" value="<?= $row['id']; ?>"><?= "{$row['full_name']} - {$row['cust_type']}"; ?></option>
                                            <?php
                                            $jsArray .= "prdName['" . $row['id'] . "'] = {alamat_pelanggan:'" . addslashes($row['address']) . "',phone:'" . addslashes($row['phone']) . "'};\n";
                                            ?>
                                        <?php
                                        }; ?>

                                    </select>
                                </div>




                                <!-- <div>
                                    <div class="form-group">
                                        <label for="custom_alamat">Custom Alamat ? </label>
                                        <input type="checkbox" class="ml-2" id="custom_alamat" name="custom_alamat" onclick="myFunction()">
                                        </input>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="form-check">
                                    <label class="form-check-label d-flex flex-col">
                                        <input class="form-check-input" id="custom_alamat" name="custom_alamat" onclick="myFunction()" type="checkbox" value="scheckbox">
                                        <span class="form-check-sign">Custom Alamat ?</span>
                                    </label>
                                    </div>
                                </div>


                                <div id="form_custom_kasir">
                                    <div class="form-group">
                                        <label for="alamat_pelanggan">Alamat Pelanggan</label>
                                        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" readonly>
                                        </input>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" readonly>
                                        </input>
                                    </div>
                                </div>


                                <script type="text/javascript">
                                    <?php echo $jsArray; ?>

                                    function myFunction() {
                                        // Get the checkbox
                                        var checkBox = document.getElementById("custom_alamat");
                                        // Get the output text
                                        var alamat = document.getElementById("alamat_pelanggan");

                                        // If the checkbox is checked, display the output text
                                        if (checkBox.checked == true) {
                                            alamat.removeAttribute('readonly');
                                        } else {

                                            alamat.setAttribute('readonly', true);
                                        }
                                    }





                                    function changeValue(id) {
                                        var sel = document.getElementById('nama_pelanggan');
                                        console.log(sel.value);
                                        // $(document).ready(function() {
                                        // document.writeln("<?php echo "" ?>");

                                        // });
                                        document.getElementById('alamat_pelanggan').value = prdName[id].alamat_pelanggan;
                                        document.getElementById('phone').value = prdName[id].phone;
                                    };
                                </script>


                                <div class="form-group">

                                    <label class="form-label">Barang yang dibeli</label>
                                    <div class="d-flex selectgroup selectgroup-pills">

                                        <?php
                                        if ($data_product !== FALSE) :
                                            $i  = 0;
                                            $ii = 0;
                                            foreach ($data_product as $row) :
                                            ?>
                                                <script type="text/javascript">

                                                </script>

                                                <?php

                                                $cek_kuantitas_material = $this->Kasir_model->cek_kuantitas_material($row['id']); //mencari data material berdasarkan id_product

                                                $kuantitas_product = array();
                                                $q = 0;
                                                foreach ($cek_kuantitas_material as $data) {
                                                    $volume = $data['volume'];
                                                    $material_id = $data['material_id']; //id material pada satu product
                                                    
                                                    // kalo belum row di tabel inventory == FALSE == NULL
                                                    $cek_inventory = $this->Kasir_model->cek_inventory($material_id);
                                                    // jika NULL maka tetap akan menghasilkan NULL
                                                    $cek_inventory = $cek_inventory[0]['quantity'];
                                                    // jika NULL / $volume (int) == menjadi (int)0
                                                    // kalo error harusnya pasti 0, karena dari NULL di atas
                                                    $quantity = $cek_inventory / $volume;
                                                    
                                                    $kuantitas_product[$q] = $quantity;
                                                    // pprintd($kuantitas_product);
                                                    $q++;
                                                }
                                                sort($kuantitas_product);
                                                // pprint($kuantitas_product);
                                                $kuantitas_material = $kuantitas_product[0];
                                                ?>

                                                <?php if ($kuantitas_material >= 1) : ?>
                                                    <div class="d-flex flex-column col-sm-7 col-md-6 col-xl-4">
                                                        <label class="selectgroup-item mt-2">
                                                            <input type="checkbox" class="selectgroup-input kelas_product <?= "kasir-product" ?>" name="<?= "product[{$i}]" ?>" id="<?= "kasirproduct-{$ii}" ?>" value="<?= $row['id']; ?>">
                                                            <!-- <input type="checkbox" name="product[<?= $i; ?>]" id="product" value="<?= $row['id']; ?>" class="selectgroup-input kelas_product"> -->
                                                            <span class="selectgroup-button font-weight-bold"><?= $row['full_name']; ?> | Rp <?= $row['selling_price']; ?></span>

                                                            <div class="d-flex justify-content-center">
                                                                <select disabled class="col-2 mx-1 mt-1 form-control form-control-sm border-info <?= "kasir-quantity" ?>" name="<?= "quantity[{$row['id']}]" ?>" id="<?= "kasirquantity-{$ii}" ?>" <?= ($kuantitas_material < 1) ? 'disabled' : '' ?>>
                                                                <!-- <select class="col-2 mx-1 mt-1 form-control form-control-sm border-info" name="quantity[<?= $row['id']; ?>]" id="quantity<?= $i; ?>" <?= ($kuantitas_material < 1) ? 'disabled' : '' ?>> -->
                                                                    <option value="0" selected>0</option>
                                                                    <?php
                                                                    $j = 1;
                                                                    $maxShowNumber = 200;
                                                                    while ($j <= $kuantitas_material) {
                                                                        // maksimal tampil jumlah produk sekali cekout 200/produk/cekout. 
                                                                        // Biar ngga exceeds memory kalo jumlah yg bisa dibelinya sampe ribuan
                                                                        if($j > $maxShowNumber) break;
                                                                        ?>
                                                                            <option value="<?= $j; ?>"><?= ($j == $maxShowNumber) ? 'Max.' : '' ?> <?= $j; ?></option>
                                                                        <?php
                                                                        $j++;
                                                                    }; ?>
                                                                </select>
                                                                <input disabled type="text" class="col-9 mx-1 mt-1 form-control form-control-sm <?= "kasir-customprice" ?>" name="<?= "custom_harga[{$row['id']}]" ?>" id="<?= "kasircustomprice-{$ii}" ?>" placeholder="Custom Harga Satuan">
                                                                <!-- <input class="col-9 mx-1 mt-1 form-control form-control-sm" type="text" class="" id="custom_harga<?= $i; ?>" name="custom_harga[<?= $row['id']; ?>]" placeholder="Custom Harga"> -->
                                                                </input>
                                                            </div>

                                                        </label>
                                                    </div>

                                                    <input type="hidden" id="selling_price<?= $i; ?>" value="<?= $row['selling_price'];; ?>">
                                                <?php
                                                $ii++;
                                                endif;
                                                if ($kuantitas_material < 1) :
                                                    $notAvailableProduct[] = $row;
                                                endif;
                                                $i++;
                                            endforeach;
                                            echo "<input type='hidden' id='counter' value='{$i}'>";
                                        else :
                                            echo "<label class='form-label text-danger'>Terjadi kesalahan. Cek komposisi pada masing-masing produk.</label>";
                                        endif; ?>

                                    </div>


                                    <?php if (isset($notAvailableProduct)) : ?>
                                        <hr width="80%" class="mt-5 mb-4">
                                        <div class="d-flex justify-content-center">
                                            <label class="d-block text-center mt-1">Barang yang habis stok</label>
                                            <span class="btn btn-sm btn-outline-secondary ml-3 toggle-btn">Tampilkan</span>
                                        </div>

                                        <div class="toggle-item" style="display:none;">
                                            <div class="d-flex selectgroup selectgroup-pills show-or-hide">

                                                <?php
                                                $i = 0;
                                                foreach ($notAvailableProduct as $row) { ?>
                                                        <div class="d-flex flex-column col-sm-7 col-md-6 col-xl-4">
                                                            <label class="selectgroup-item mt-2">
                                                                    <input type="checkbox" class="selectgroup-input" disabled>
                                                                    <span class="selectgroup-button bg-light"><?= $row['full_name']; ?> | Rp. <?= $row['selling_price']; ?></span>

                                                                    <!-- <select class="col-11 mx-auto mt-1 text-danger form-control form-control-sm" name="quantity[<?= $row['id']; ?>]" id="quantity<?= $i; ?>" disabled>
                                                                        <option class="mx-auto">Stok habis!</option>
                                                                    </select> -->
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="col-3 mx-1 mt-1 text-danger form-control form-control-sm" placeholder="Stok habis!" disabled>
                                                                        <input type="text" class="col-8 mx-1 mt-1 form-control form-control-sm" placeholder="Custom harga" disabled>
                                                                    </div>
                                                            </label>
                                                        </div>
                                                    <?php
                                                    $i++;
                                                };;
                                                ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>



                                </div>
                                <!-- / form group -->



                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?= base_url(); ?>" class="btn btn-outline-danger px-5">Keluar</a>
                        <!-- <a href="#modal_kasir" class="btn btn-danger">Keluar</a> -->
                        <!-- Button trigger modal -->


                        <!-- <button type="button" class="btn btn-primary open-modal-kasir" data-toggle="modal" data-target="#modal">
                            Checkout
                        </button> -->
                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                        <button type="submit" class="btn btn-primary px-5">Selanjutnya</button>
                    </div>




                    <!-- Modal -->
                    <!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Checkout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <label class="form-label" id="total_bayar">Total Bayar</label>
                                    <div class="form-group">
                                        <label class="form-label">Yang Dibayarkan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="paid_amount" id="paid_amount" class="form-control" aria-label="Pembayaran" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <?= form_close(); ?>



                </div>
            </div>
        </div>
    </div>
</div>