<?php

// initialize main menu segment for url
$_dashboard             = 'dashboard';
$_data_gudang           = 'data-gudang';
$_data_produksi         = 'data-produksi';
$_data_penjualan        = 'data-penjualan';
$_data_keuangan         = 'data-keuangan';
$_data_laporan          = 'data-laporan';
$_data_pelanggan        = 'data-pelanggan';
$_data_pegawai          = 'data-pegawai';
$_informasi_perusahaan  = 'informasi-perusahaan';
$_kasir                 = 'kasir';
$_kas_perusahaan        = 'kas-perusahaan';

// Role sesuai dengan masing2 role id
// {owner=1 ; admin=2 ; cashier=3}
$_role_0            = '0';
$_role_1            = '1';
$_role_2            = '2';
$_role_3            = '3';

// Every menu and submenu has array key named 'hasAccess' and the value 0 or 1 returned from helper,
// helper role_access take 2 params, the first one is the logged in role id and the second is array
// containing comma seperated value refer to role id that will be matched up with the first params.
// 
// 'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_3]),


$mainMenu = array(
  // [
  //   'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
  //   'no'      => 1,
  //   'name'    => 'Generate Report',
  //   'slug'    => 'generate-report',
  //   'url'     => 'generate-report',
  //   'icon'    => 'fas fa-file-pdf',
  //   'submenu' => array(
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
  //       'name'  => 'PDF - Invoice',
  //       'slug'  => 'invoice/generate',
  //       'url'   => "generate-report/invoice/generate",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
  //       'name'  => 'PDF - Surat jalan',
  //       'slug'  => 'surat-jalan/generate',
  //       'url'   => "generate-report/surat-jalan/generate",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
  //       'name'  => 'PDF - Export report',
  //       'slug'  => 'pages/generate',
  //       'url'   => "generate-report/pages/generate",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
  //       'name'  => 'Semua menu ini cuma buat developing, nanti generate pdf gaakan dari sini tapi ketika udah cekout',
  //       'slug'  => $_dashboard,
  //       'url'   => $_dashboard,
  //     ],
  //   )
  // ],
  // [
  //   'hasAccess' => role_access($this->session->role_id, [$_role_0]),
  //   'no'      => 1,
  //   'name'    => 'SUPERADMIN HUB',
  //   'slug'    => 'superadmin',
  //   'url'     => 'superadmin/hub',
  //   'icon'    => 'fas fa-atom',
  //   'submenu' => FALSE,
  // ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
    'no'      => 1,
    'name'    => 'Dashboard',
    'slug'    => $_dashboard,
    'url'     => $_dashboard,
    'icon'    => 'fas fa-home',
    'submenu' => FALSE,
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
    'no'      => 2,
    'name'    => 'Data Gudang',
    'slug'    => $_data_gudang,
    'url'     => $_data_gudang,
    'icon'    => 'fas fa-layer-group',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Barang Mentah',
        'slug'  => 'data-barang-mentah',
        'url'   => "{$_data_gudang}/data-barang-mentah",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Inventory Barang Mentah',
        'slug'  => 'data-inventory-barang-mentah',
        'url'   => "{$_data_gudang}/data-inventory-barang-mentah",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Mutasi Barang',
        'slug'  => 'data-transaksi-barang',
        'url'   => "{$_data_gudang}/data-transaksi-barang",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Barang Laku',
        'slug'  => 'data-barang-laku',
        'url'   => "{$_data_gudang}/data-barang-laku",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Barang Kritis',
        'slug'  => 'data-barang-kritis',
        'url'   => "{$_data_gudang}/data-barang-kritis",
      ],
    )
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
    'no'      => 3,
    'name'    => 'Data Produksi',
    'slug'    => $_data_produksi,
    'url'     => $_data_produksi,
    'icon'    => 'fas fa-shapes',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
        'name'  => 'Data Master Produk',
        'slug'  => 'data-master-produk',
        'url'   => "{$_data_produksi}/data-master-produk",
        ],[
          'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
          'name'  => 'Data Inventory Produk',
          'slug'  => 'data-inventory-produk',
          'url'   => "{$_data_produksi}/data-inventory-produk",
        ],[
          'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
          'name'  => 'Data Mutasi Produk',
          'slug'  => 'data-transaksi-produk',
          'url'   => "{$_data_produksi}/data-transaksi-produk",
      ],
    )
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
    'no'      => 4,
    'name'    => 'Data Penjualan',
    'slug'    => $_data_penjualan,
    'url'     => $_data_penjualan,
    'icon'    => 'fas fa-signal',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
        'name'  => 'Data Master Penjualan',
        'slug'  => 'data-penjualan',
        'url'   => "{$_data_penjualan}/data-penjualan",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
        'name'  => 'Data Penjualan per Toko',
        'slug'  => 'data-penjualan-per-toko',
        'url'   => "{$_data_penjualan}/data-penjualan-pertoko/index/1",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
        'name'  => 'Data Invoice',
        'slug'  => 'data-invoice',
        'url'   => "{$_data_penjualan}/data-invoice",
      ],
    )
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
    'no'      => 5,
    'name'    => 'Data Keuangan',
    'slug'    => $_data_keuangan,
    'url'     => $_data_keuangan,
    'icon'    => 'fas fa-money-bill-wave',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
        'name'  => 'Data Hutang Piutang',
        'slug'  => 'data-hutang-piutang',
        'url'   => "{$_data_keuangan}/data-hutang-piutang",
      ], [
      //   'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
      //   'name'  => 'Data Pengeluaran',
      //   'slug'  => 'data-pengeluaran',
      //   'url'   => "{$_data_keuangan}/data-pengeluaran",
      // ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
        'name'  => 'Data Laba / Rugi',
        'slug'  => 'data-laba-rugi',
        'url'   => "{$_data_keuangan}/data-laba-rugi",
      ], [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
        'name'  => 'Data Kas Perusahaan',
        'slug'  => 'data-kas-perusahaan',
        'url'   => "{$_data_keuangan}/data-kas-perusahaan",
      ],
    )
  ],
  // [
  //   'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //   'no'      => 6,
  //   'name'    => 'Data Laporan',
  //   'slug'    => $_data_laporan,
  //   'url'     => $_data_laporan,
  //   'icon'    => 'fas fa-file-alt',
  //   'submenu' => array(
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Hutang piutang',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Pengeluaran',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Laba / rugi',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Kas perusahaan',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'barang masuk',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Barang keluar ke toko',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Barang keluar penjualan',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //     [
  //       'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
  //       'name'  => 'Penjualan',
  //       'slug'  => '##',
  //       'url'   => "{$_data_laporan}###",
  //     ],
  //   )
  // ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
    'no'      => 7,
    'name'    => 'Data Pelanggan',
    'slug'    => $_data_pelanggan,
    'url'     => $_data_pelanggan,
    'icon'    => 'fas fa-users',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2, $_role_3]),
        'name'  => 'Data Master Pelanggan',
        'slug'  => 'data-master-pelanggan',
        'url'   => "{$_data_pelanggan}/data-master-pelanggan",
      ],
    )
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
    'no'      => 8,
    'name'    => 'Data Pegawai',
    'slug'    => $_data_pegawai,
    'url'     => $_data_pegawai,
    'icon'    => 'fas fa-user-tie',
    'submenu' => array(
      [
        'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1]),
        'name'  => 'Data Master Pegawai',
        'slug'  => 'data-master-pegawai',
        'url'   => "{$_data_pegawai}/data-master-pegawai",
      ],
    )
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_1, $_role_2]),
    'no'      => 10,
    'name'    => 'Informasi Perusahaan',
    'slug'    => $_informasi_perusahaan,
    'url'     => $_informasi_perusahaan,
    'icon'    => 'fas fa-info-circle',
    'submenu' => FALSE
  ],
  [
    'hasAccess' => role_access($this->session->role_id, [$_role_0, $_role_2, $_role_3]),
    'no'      => 11,
    'name'    => 'Kasir',
    'slug'    => $_kasir,
    'url'     => $_kasir,
    'icon'    => 'fas fa-address-card',
    'submenu' => FALSE,
  ],
);

?>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-primary">

        <?php
        foreach ($mainMenu as $mm) :
          // kelas ACTIVE untuk indikator menu yg aktif 
          if ($mm['hasAccess'] === 1) :
        ?>
            <li class="nav-item <?php if ($menuActive == $mm['slug']) {
                                  echo 'active';
                                } ?>">
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
                <?php // kelas SHOW untuk membuka seluruh submenu ketika submenu ada yg aktif 
                ?>
                <div class="collapse <?php if ($menuActive == $mm['slug']) {
                                        echo 'show';
                                      } ?>" id="<?= $mm['url'] ?>">
                  <ul class="nav nav-collapse">
                    <?php // kelas ACTIVE menjadi indikator submenu mana yg sedang aktif 
                    ?>
                    <?php
                    foreach ($mm['submenu'] as $sm) :
                      if ($sm['hasAccess'] === 1) :
                    ?>
                        <li class="<?php if ($submenuActive == $sm['slug']) {
                                      echo 'active';
                                    } ?>">
                          <a href=<?= base_url("{$sm['url']}") ?>>
                            <span class="sub-item"><?= $sm['name'] ?></span>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>

      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->

<!-- Start Content page -->
<div class="main-panel">