<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
            
                <li class="nav-item <?php if ($menuActive == 'dashboard') { echo 'active'; } ?>">
                    <a href=<?= base_url("dashboard") ?>>
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <hr width=90%>

                <!-- kelas ACTIVE untuk indikator menu yg aktif -->
                <li class="nav-item <?php if ($menuActive == 'data-gudang') { echo 'active'; } ?>">
                    <a data-toggle="collapse" href="#data-gudang">
                        <i class="fas fa-layer-group"></i>
                        <p>Data Gudang</p>
                        <span class="caret"></span>
                    </a>
                    <!-- kelas SHOW untuk membuka seluruh submenu ketika submenu ada yg aktif -->
                    <div class="collapse <?php if ($menuActive == 'data-gudang') { echo 'show'; } ?>" id="data-gudang">
                        <ul class="nav nav-collapse">
                            <!-- kelas ACTIVE menjadi indikator submenu mana yg sedang aktif -->
                            <li class="<?php if ($submenuActive == 'data-barang-kimia') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Barang Kimia</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'data-barang-kemasan') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Barang Kemasan</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'setting-harga-barang-kimia') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Setting Harga Barang Kimia</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'setting-harga-barang-kimia') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Setting Harga Barang Kemasan</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'barang-masuk') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'barang-keluar') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if ($menuActive == 'data-pelanggan') { echo 'active'; } ?>">
                    <a data-toggle="collapse" href="#data-pelanggan">
                        <i class="fas fa-users"></i>
                        <p>Data Pelanggan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php if ($menuActive == 'data-pelanggan') { echo 'show'; } ?>" id="data-pelanggan">
                        <ul class="nav nav-collapse">
                            <li class="<?php if ($submenuActive == 'data-master-pelanggan') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Master Pelanggan</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'setting-harga-penjualan') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Setting Harga Penjualan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if ($menuActive == 'data-produksi') { echo 'active'; } ?>">
                    <a data-toggle="collapse" href="#data-produksi">
                        <i class="fas fa-shapes"></i>
                        <p>Data Produksi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php if ($menuActive == 'data-produksi') { echo 'show'; } ?>" id="data-produksi">
                        <ul class="nav nav-collapse">
                            <li class="<?php if ($submenuActive == 'data-produk') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Produk (Barang Jadi)</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'komposisi-produk') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Komposisi Produk</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'setting-harga-produk') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Setting Harga Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if ($menuActive == 'data-penjualan') { echo 'active'; } ?>">
                    <a data-toggle="collapse" href="#data-penjualan">
                        <i class="fas fa-signal"></i>
                        <p>Data Penjualan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php if ($menuActive == 'data-penjualan') { echo 'show'; } ?>" id="data-penjualan">
                        <ul class="nav nav-collapse">
                            <li class="<?php if ($submenuActive == 'data-master-penjualan') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Master Penjualan</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'data-penjualan-per-cabang') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Penjualan per Cabang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if ($menuActive == 'data-keuangan') { echo 'active'; } ?>">
                    <a data-toggle="collapse" href="#data-keuangan">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Data Keuangan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php if ($menuActive == 'data-keuangan') { echo 'show'; } ?>" id="data-keuangan">
                        <ul class="nav nav-collapse">
                            <li class="<?php if ($submenuActive == 'data-hutang-piutang') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Hutang Piutang</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'data-pengeluaran') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Pengeluaran</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'data-laba-rugi') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Laba / Rugi</span>
                                </a>
                            </li>
                            <li class="<?php if ($submenuActive == 'data-kas-perusahaan') { echo 'active'; } ?>">
                                <a href=<?= base_url("") ?>>
                                    <span class="sub-item">Data Kas Perusahaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if ($menuActive == 'informasi-perusahaan') { echo 'active'; } ?>">
                    <a href=<?= base_url("informasi-perusahaan") ?>>
                        <i class="fas fa-info-circle"></i>
                        <p>Informasi Perusahaan</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

<!-- Start Content page -->
<div class="main-panel">