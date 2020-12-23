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
                    <a href="#">Gudang</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-gudang/Data_transaksi_barang'); ?>">Checkout Ket Toko Cabang</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Checkout Station</div>
                    </div>

                    <?= form_open('data-gudang/Data_transaksi_barang/konfirmasi_kasir'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Toko</label>
                                    <select class="form-control select2 col-11 col-xl-12" id="nama_pelanggan" name="nama_pelanggan" onchange='changeValue(this.value)' required>
                                        <option value="" selected disabled>-Pilih Toko-</option>
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
                                        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" maxlength=250 readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" readonly>
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

                                                    // urang nambahin ini kalau engga, ntar line 161 $cek_inventory[0][quantity] ngasih false malah muncul error
                                                    if ($this->Kasir_model->cek_inventory($material_id, $this->session->store_id) !== false) {
                                                        // kalo belum row di tabel inventory == FALSE == NULL
                                                        $cek_inventory = $this->Kasir_model->cek_inventory($material_id, $this->session->store_id);
                                                        // jika NULL maka tetap akan menghasilkan NULL
                                                        $cek_inventory = $cek_inventory[0]['quantity'];
                                                        // jika NULL / $volume (int) == menjadi (int)0
                                                        // kalo error harusnya pasti 0, karena dari NULL di atas
                                                        $quantity = $cek_inventory / $volume;

                                                        $kuantitas_product[$q] = $quantity;
                                                    } else {
                                                        // echo "FALSE";
                                                        $kuantitas_product[$q] = 0;
                                                    }
                                                }
                                                sort($kuantitas_product);
                                                $kuantitas_material = $kuantitas_product[0];





                                                ?>

                                                <?php if ($kuantitas_material >= 1) : ?>
                                                    <div class="d-flex flex-column col-sm-7 col-md-6 col-xl-4 mt-4">
                                                        <label class="selectgroup-item">
                                                            <input type="checkbox" class="selectgroup-input kelas_product <?= "kasir-product" ?>" name="<?= "product[{$i}]" ?>" id="<?= "kasirproduct-{$ii}" ?>" value="<?= $row['id']; ?>">
                                                            <!-- <input type="checkbox" name="product[<?= $i; ?>]" id="product" value="<?= $row['id']; ?>" class="selectgroup-input kelas_product"> -->
                                                            <span class="selectgroup-button font-weight-bold"><?= $row['full_name']; ?> | <?= price_format($row['price_base']) ?></span>
                                                        </label>
                                                        <div class="d-flex justify-content-center">
                                                            <select disabled class="select2 col-5 mx-1 mt-1 form-control form-control-sm border-info <?= "kasir-quantity" ?>" name="<?= "quantity[{$row['id']}]" ?>" id="<?= "kasirquantity-{$ii}" ?>" <?= ($kuantitas_material < 1) ? 'disabled' : '' ?>>
                                                                <!-- <select class="col-2 mx-1 mt-1 form-control form-control-sm border-info" name="quantity[<?= $row['id']; ?>]" id="quantity<?= $i; ?>" <?= ($kuantitas_material < 1) ? 'disabled' : '' ?>> -->
                                                                <option value="0" selected>0</option>
                                                                <?php
                                                                $j = 1;
                                                                $maxShowNumber = 2000;
                                                                while ($j <= $kuantitas_material) {
                                                                    // maksimal tampil jumlah produk sekali cekout 200/produk/cekout. 
                                                                    // Biar ngga exceeds memory kalo jumlah yg bisa dibelinya sampe ribuan
                                                                    if ($j > $maxShowNumber) break;
                                                                ?>
                                                                    <option value="<?= $j; ?>"><?= ($j == $maxShowNumber) ? 'Max.' : '' ?> <?= $j; ?></option>
                                                                <?php
                                                                    $j++;
                                                                }; ?>
                                                            </select>


                                                            </input>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="selling_price<?= $i; ?>" value="<?= $row['price_base'];; ?>">
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
                                                            <span class="selectgroup-button bg-light"><?= $row['full_name']; ?> | <?= price_format($row['selling_price']) ?></span>

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

                        <button type="submit" class="btn btn-primary px-5">Selanjutnya</button>
                    </div>



                    <?= form_close(); ?>



                </div>
            </div>
        </div>
    </div>
</div>