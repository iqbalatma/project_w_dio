
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title><?= $filename ?></title>

  <style>
    @page {
      margin-top: .5cm;
      margin-bottom: 0.5cm;
      margin-left: 0.5cm;
      margin-right: 0.5cm;
    }

    .invoice-box {
      /* max-width: 800px; */
      margin: 0;
      /* padding: 30px; */
      /* border: 1px solid #eee; */
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
      font-size: 10px;
      line-height: 18px;
      font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
      color: #555;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(7) {
      text-align: right;
    }

    /* .invoice-box table tr.top table td {
        padding-bottom: 5px;
      } */

    .invoice-box table tr.top table td.title {
      font-size: 10px;
      line-height: 24px;
      color: #333;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 10px;
    }

    .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
    }

    .invoice-box table tr.details td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
      border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    /* .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      } */

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }

      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="<?= count($data['columns']) + 1 ?>">
          <table>
            <tr>
              <td class="title" style="text-align:center;" width="50%">
                <span style="font-size:28px;"><strong><u><?= $data['name'] ?></u></strong></span><br />
                <span style="font-size:12px;"><?= "Dibuat pada: {$created_at} | Oleh: {$created_by}" ?></span>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>

      <tr class="heading">
          <td style="font-size:12px;"> No </td>
        <?php foreach ($data['columns'] as $row) : ?>
          <td style="font-size:12px;"> <?= $row ?> </td>
          <!-- <td style="font-size:12px;"> Kode Produk </td>
          <td style="font-size:12px;"> Nama Produk </td>
          <td style="font-size:12px;"> Volume/Unit </td>
          <td style="font-size:12px;"> HPP </td>
          <td style="font-size:12px;"> Harga Jual </td>
          <td style="font-size:12px;"> Dibuat Pada </td> -->
        <?php endforeach; ?>
      </tr>
      
      <?php
      $no = 1;
      foreach ($data['db_res'] as $row) : ?>
        <tr class="item">
          <td style="font-size:11px;"> <?= $no++ ?></td>
          <?php foreach ($row as $r) : ?>
            <td style="font-size:11px;"> <?= $r ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
      
    </table>

    <table style="margin-top:20px;">
      <tr>
        <td width="40%" style="font-size:10px; text-align:right;">
          Digenerate secara otomatis oleh sistem: 
          <br>
          <?php
            $root  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $root .= $_SERVER['HTTP_HOST'];
          ?>
          <a href="#"><?= $root ?></a>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>

<?php
// die;
?>