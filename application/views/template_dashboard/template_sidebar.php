<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
            
                <li class="nav-item">
                    <a href="<?= base_url() ?>dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <hr width=90%>

                <li class="nav-item active">
                    <a data-toggle="collapse" href="#data-gudang">
                        <i class="fas fa-layer-group"></i>
                        <p>Data Gudang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-gudang">
                        <ul class="nav nav-collapse">
                            <li class='active'>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Barang Kimia</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Barang Kemasan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Setting Harga Barang Kimia</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Setting Harga Barang Kemasan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#data-pelanggan">
                        <i class="fas fa-users"></i>
                        <p>Data Pelanggan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-pelanggan">
                        <ul class="nav nav-collapse">
                            <li class=''>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Master Pelanggan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Setting Harga Penjualan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#data-produksi">
                        <i class="fas fa-shapes"></i>
                        <p>Data Produksi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-produksi">
                        <ul class="nav nav-collapse">
                            <li class=''>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Produk (Barang Jadi)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Komposisi Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Setting Harga Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#data-penjualan">
                        <i class="fas fa-signal"></i>
                        <p>Data Penjualan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-penjualan">
                        <ul class="nav nav-collapse">
                            <li class=''>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Master Penjualan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Penjualan per Cabang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#data-keuangan">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Data Keuangan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-keuangan">
                        <ul class="nav nav-collapse">
                            <li class=''>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Hutang Piutang</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Pengeluaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Laba / Rugi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>">
                                    <span class="sub-item">Data Kas Perusahaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href=<?= base_url(); ?>>
                        <i class="fas fa-info-circle"></i>
                        <p>Informasi Perusahaan</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->