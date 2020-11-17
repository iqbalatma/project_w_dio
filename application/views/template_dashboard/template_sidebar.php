<?php

// initialize main menu segment for url
$_data_gudang           = 'data-gudang';
$_data_produksi         = 'data-produksi';
$_data_penjualan        = 'data-penjualan';
$_data_keuangan         = 'data-keuangan';
$_data_pelanggan        = 'data-pelanggan';
$_data_pegawai          = 'data-pegawai';
$_informasi_perusahaan  = 'informasi-perusahaan';

$mainMenu = array(
  [
    'no'      => 1,
    'name'    => 'Data Gudang',
    'slug'    => $_data_gudang,
    'url'     => $_data_gudang,
    'icon'    => 'fas fa-layer-group',
    'submenu' => array(
      [
        'name'  => 'Data Barang Mentah',
        'slug'  => 'data-barang-mentah',
        'url'   => "{$_data_gudang}/data-barang-mentah",
      ],[
        'name'  => 'Data Inventory Barang Mentah',
        'slug'  => 'data-inventory-barang-mentah',
        'url'   => "{$_data_gudang}/data-inventory-barang-mentah",
      ],[
        'name'  => 'Data Transaksi Barang',
        'slug'  => 'data-transaksi-barang',
        'url'   => "{$_data_gudang}/data-transaksi-barang",
      ],
    )
  ], [
    'no'      => 2,
    'name'    => 'Data Produksi',
    'slug'    => $_data_produksi,
    'url'     => $_data_produksi,
    'icon'    => 'fas fa-shapes',
    'submenu' => array(
      [
        'name'  => 'Data Master Produk (Barang Jadi)',
        'slug'  => 'data-master-produk',
        'url'   => "{$_data_produksi}/data-master-produk",
      ],
    )
  ], [
    'no'      => 3,
    'name'    => 'Data Penjualan',
    'slug'    => $_data_penjualan,
    'url'     => $_data_penjualan,
    'icon'    => 'fas fa-signal',
    'submenu' => array(
      [
        'name'  => 'Data Master Penjualan',
        'slug'  => 'data-penjualan',
        'url'   => "{$_data_penjualan}/data-penjualan",
      ], [
        'name'  => 'Data Penjualan per Cabang',
        'slug'  => 'data-penjualan#per-cabang',
        'url'   => "{$_data_penjualan}/data-penjualan#per-cabang",
      ],
    )
  ], [
    'no'      => 4,
    'name'    => 'Data Keuangan',
    'slug'    => $_data_keuangan,
    'url'     => $_data_keuangan,
    'icon'    => 'fas fa-money-bill-wave',
    'submenu' => array(
      [
        'name'  => 'Data Hutang Piutang',
        'slug'  => 'data-hutang-piutang',
        'url'   => "{$_data_keuangan}/data-hutang-piutang",
      ], [
        'name'  => 'Data Pengeluaran',
        'slug'  => 'data-pengeluaran',
        'url'   => "{$_data_keuangan}/data-pengeluaran",
      ], [
        'name'  => 'Data Laba / Rugi',
        'slug'  => 'data-laba-rugi',
        'url'   => "{$_data_keuangan}/data-laba-rugi",
      ], [
        'name'  => 'Data Kas Perusahaan',
        'slug'  => 'data-kas-perusahaan',
        'url'   => "{$_data_keuangan}/data-kas-perusahaan",
      ],
    )
  ], [
    'no'      => 5,
    'name'    => 'Data Pelanggan',
    'slug'    => $_data_pelanggan,
    'url'     => $_data_pelanggan,
    'icon'    => 'fas fa-users',
    'submenu' => array(
      [
        'name'  => 'Data Master Pelanggan',
        'slug'  => 'data-master-pelanggan',
        'url'   => "{$_data_pelanggan}/data-master-pelanggan",
      ],
    )
  ], [
    'no'      => 6,
    'name'    => 'Data Pegawai',
    'slug'    => $_data_pegawai,
    'url'     => $_data_pegawai,
    'icon'    => 'fas fa-user-tie',
    'submenu' => array(
      [
        'name'  => 'Data Master Pegawai',
        'slug'  => 'data-master-pegawai',
        'url'   => "{$_data_pegawai}/data-master-pegawai",
      ],
    )
  ], [
    'no'      => 7,
    'name'    => 'Informasi Perusahaan',
    'slug'    => $_informasi_perusahaan,
    'url'     => $_informasi_perusahaan,
    'icon'    => 'fas fa-info-circle',
    'submenu' => FALSE
  ],
);

?>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-primary">

        <li class="nav-item <?php if ($menuActive == 'dashboard') {
                              echo 'active';
                            } ?>">
          <a href=<?= base_url("dashboard") ?>>
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

                <?php
                foreach ($mainMenu as $mm) : ?>
                <?php // kelas ACTIVE untuk indikator menu yg aktif ?>
                <li class="nav-item <?php if ($menuActive == $mm['slug']) { echo 'active'; } ?>">
                    <?php
                    if ($mm['submenu'] !== FALSE) { 
                    ?>
                    <a data-toggle="collapse" href="<?= "#{$mm['url']}" ?>">
                        <i class="<?= $mm['icon'] ?>"></i>
                        <p><?= $mm['name'] ?></p>
                        <span class="caret"></span>
                    </a>
                    <?php 
                    } else { 
                    ?>
                    <a href="<?= base_url("{$mm['url']}") ?>">
                        <i class="<?= $mm['icon'] ?>"></i>
                        <p><?= $mm['name'] ?></p>
                    </a>
                    <?php 
                    }
                    if ($mm['submenu'] !== FALSE) : 
                    ?>
                    <?php // kelas SHOW untuk membuka seluruh submenu ketika submenu ada yg aktif ?>
                    <div class="collapse <?php if ($menuActive == $mm['slug']) { echo 'show'; } ?>" id="<?= $mm['url'] ?>">
                        <ul class="nav nav-collapse">
                            <?php // kelas ACTIVE menjadi indikator submenu mana yg sedang aktif ?>
                            <?php
                            foreach ($mm['submenu'] as $sm) :
                            ?>
                            <li class="<?php if ($submenuActive == $sm['slug']) { echo 'active'; } ?>">
                                <a href=<?= base_url("{$sm['url']}") ?>>
                                    <span class="sub-item"><?= $sm['name'] ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>



      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->

<!-- Start Content page -->
<div class="main-panel">