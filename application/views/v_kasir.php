<div class="content">
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

                    <?= form_open('Kasir/insert'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <select class="form-control" id="nama_pelanggan" name="nama_pelanggan" onchange='changeValue(this.value)' required>
                                        <option value="">-Pilih Pelanggan-</option>

                                        <?php
                                        $jsArray = "var prdName = new Array();\n";
                                        foreach ($data_customer as $row) {
                                        ?>
                                            <option name="id_customer" value="<?= $row['id']; ?>"><?= $row['full_name']; ?></option>
                                            <?php
                                            $jsArray .= "prdName['" . $row['id'] . "'] = {alamat_pelanggan:'" . addslashes($row['address']) . "',phone:'" . addslashes($row['phone']) . "'};\n";
                                            ?>
                                        <?php
                                        }; ?>

                                    </select>
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

                                    function changeValue(id) {
                                        document.getElementById('alamat_pelanggan').value = prdName[id].alamat_pelanggan;
                                        document.getElementById('phone').value = prdName[id].phone;

                                    };
                                </script>

                                <div class="form-group">

                                    <label class="form-label">Barang yang dibeli</label>

                                    <!-- <?php echo  $trans_number = 'TRANS-' . date("m.d.y"); ?> -->
                                    <div class="selectgroup selectgroup-pills">

                                        <?php
                                        $i = 0;
                                        foreach ($data_product as $row) {
                                        ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="product[<?= $i; ?>]" value="<?= $row['id']; ?>" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= $row['full_name']; ?> | Rp <?= $row['price_retail']; ?></span>

                                                <select name="quantity[<?= $row['id']; ?>]" id="quantity">
                                                    <?php
                                                    $j = 1;
                                                    while ($j <= $row['quantity']) {
                                                    ?>
                                                        <option value="<?= $j; ?>"><?= $j; ?></option>

                                                    <?php
                                                        $j++;
                                                    }; ?>

                                                </select>
                                            </label>
                                        <?php
                                            $i++;
                                        }; ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control" aria-label="Pembayaran">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?= base_url(); ?>" class="btn btn-danger">Keluar</a>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>