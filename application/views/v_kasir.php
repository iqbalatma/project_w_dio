<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Forms</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Basic Form</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Elements</div>
                    </div>
                    <!-- <pre><?php var_dump($_SESSION); ?></pre> -->
                    <?= form_open('Kasir/insert'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <pre><?php var_dump($data_product); ?></pre> -->
                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <select class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                                        <?php foreach ($data_customer as $row) {
                                        ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['full_name']; ?></option>
                                        <?php
                                        }; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Barang yang dibeli</label>

                                    <div class="selectgroup selectgroup-pills">

                                        <?php
                                        $i = 0;
                                        foreach ($data_product as $row) {
                                        ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="product[<?= $i; ?>]" value="<?= $row['id']; ?>" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= $row['full_name']; ?></span>


                                                <select name="quantity[<?= $i; ?>]" id="quantity">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
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

                                <div class="form-group">
                                    <label for="email2">Email Address</label>
                                    <input type="text" class="form-control" id="email2" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
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