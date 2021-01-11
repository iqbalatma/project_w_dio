<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Invoice <?= unix_to_human(now(), true, 'europe') ?></title>

  <style>
    @page {
      margin-top: 0cm;
      margin-bottom: 0cm;
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
        <td colspan="7">
          <table>
            <tr>
              <td class="title" width="25%">
                <img src="<?= $logo ?>" style="width: 100%; max-width: 150px;" />
              </td>
              <td style="text-align:left; font-size:8px;" width="45%">
                &nbsp; <br>
                CV. ALPHI JAYA CHEMICAL <br>
                Jl. Neglasari Blok F7, Ujungberung, Bandung <br>
                Telp: 086273716678
              </td>
              <td style="text-align:right;" width="30%">
                <span style="font-size:16px;"><strong><u>INVOICE</u></strong></span><br />
                <span style="font-size:14px;">NO : <?= $noInvoice ?></span>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="7">
          <table>
            <tr>
              <td style="font-size:12px;">
                Kepada Yth.: <?= $custName ?><br />
                <?= $custLocation ?>
              </td>
              <td style="font-size:12px; text-align:right;">
                Tanggal: <?= $date ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td width="5%" style="font-size:10px;"> NO </td>
        <td width="25%" style="font-size:10px;"> NAMA BARANG </td>
        <td width="15%" style="font-size:10px;"> KEMASAN Ltr </td>
        <td width="10%" style="font-size:10px;"> JUMLAH </td>
        <td width="15%" style="font-size:10px;"> KET. LITER </td>
        <td width="15%" style="font-size:10px;"> HARGA </td>
        <td width="15%" style="font-size:10px;"> TOTAL </td>
      </tr>
      <?php
      $i = 1;
      $total_harga = 0;
      $selling_price = 0;
      foreach ($rows as $row) : ?>
        <tr class="item">
          <td style="font-size:10px;"> <?= $i++ ?></td>
          <td style="font-size:10px;"> <?= $row['full_name'] ?></td>
          <td style="font-size:10px;"> <?= $row['unit'] ?></td>
          <td style="font-size:10px;"> <?= number_format($row['quantity'], 0, ',', '.') ?></td>
          <td style="font-size:10px;"> <?= $row['totLiterItem'] ?></td>\
          <?php if ($custName == 'Toko Cicalengka' || $custName == 'Toko Ujung Berung') {
            $selling_price = ($row['selling_price']);
          } else {
            $selling_price = ($row['selling_price']);
          }; ?>
          <td style="font-size:10px;"> <?= price_format($selling_price) ?></td>
          <td style="font-size:10px;"> <?= price_format($row['item_price']) ?></td>
        </tr>
      <?php
        $total_harga += $row['item_price'];
      endforeach; ?>

      <tr class="total" style="background: #eee;">
        <td></td>
        <td></td>
        <td colspan="2" style="font-size:10px;"><strong>JUMLAH 5LTR&nbsp;&nbsp;&nbsp;<?= $tot5Liter ?> pcs</strong></td>
        <td style="font-size:10px;"><strong><?= $totLiter ?> Ltr</strong></td>
        <td colspan="2" style="font-size:10px; margin-top:10px; text-align:right;">
          <strong>Total: <?= price_format($total_harga) ?></strong>
        </td>
      </tr>

      <tr class="total" style="background: #eee;">
        <td></td>
        <td></td>
        <td colspan="2" style="font-size:10px;"><strong>JUMLAH 1LTR&nbsp;&nbsp;&nbsp;<?= $tot1Liter ?> pcs</strong></td>
        <td colspan="3">
        </td>
      </tr>
    </table>
  </div>
</body>

</html>

<?php //die; 
?>