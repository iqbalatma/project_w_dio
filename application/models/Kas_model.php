<?php

/**
 * 
 * @dioilham
 * 
 */
class Kas_model extends CI_Model
{

  var $table = 'kas';

//  ===============================================SETTER===============================================
  /**
   * 
   * Insert new row to the database.
   * 
   * @param array $data [10 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_new_kas($data)
  {
    $now        = now();
    $createdAt  = unix_to_human($now, true, 'europe');
    
    // kas_code format, string build
    $code  = ($data['add-type'] == 'kredit') ? 'K' : 'D'; // K= Kredit ; D = Debet
    $code .= mdate('/%y/%m/', $now); // kode untuk tahun dan bulan

    // get last kas_code from table row
    $lastRow           = $this->db->select('kas_code, final_balance')->order_by('id',"desc")->limit(1)->get($this->table);
    $lastKasCode       = $lastRow->row()->kas_code;
    $lastFinalBalance  = $lastRow->row()->final_balance;
    // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
    if ($lastRow->num_rows() > 0) $lastCode = $lastKasCode;
    else $lastCode = $code.'0000';

    // $lastCode dari db, ambil hanya nomor urut di setelah "/" terakhir
    // increment 1
    // ambil kode bulan di sebelum "/" terakhir
    // siapkan string bulan ini dari timestamp sekarang
    $lastCode  = explode('/', $lastCode);
    $codeNum   = end($lastCode) + 1; // kode nomor urut
    $codeMonth = prev($lastCode); // kode bulan
    $currMonth = mdate('%m', $now);

    // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 0001
    // jika tidak, maka gunakan angka yg sudah diincrement 1, yaitu $codeNum
    // append 0 di depan dan sesuaikan total panjang angka yaitu 4
    // kemudian masukan kembali ke string $code, dan kas_code selesai
    $codeNum   = ($codeMonth !== $currMonth) ? '0001' : $codeNum;
    $code     .= str_pad($codeNum, 4, "0", STR_PAD_LEFT);

    // set final_balance yg baru
    if ($data['add-type'] == 'kredit') $newFinalBalance = $lastFinalBalance - (int)$data['add-nominal'];
    else $newFinalBalance = $lastFinalBalance + (int)$data['add-nominal'];

    // set value untuk debet dan kredit
    if ($data['add-type'] == 'kredit')
    {
      $debet  = 0;
      $kredit = $data['add-nominal'];
    }
    else
    {
      $debet  = $data['add-nominal'];
      $kredit = 0;
    }

    $data = array(
		  "kas_code"        => $code,
		  "title"           => $data['add-perihal'],
		  "description"     => ($data['add-keterangan'] !== '') ? $data['add-keterangan'] : NULL,
		  "date"            => $data['add-date'],
		  "debet"           => $debet,
		  "kredit"          => $kredit,
		  "final_balance"   => $newFinalBalance,
		  "type"            => $data['add-type'],
		  "created_at"      => $createdAt,
		  "created_by"      => $data['created_by'],
    );
		return $this->db->insert($this->table, $data);
  }
  
  /**
   * 
   * Delete kas dara row, entirely
   * 
   * @param array $id
   * Set the $id from the kas id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_by_id($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete($this->table);
  }



//  ===============================================GETTER===============================================
  /**
   * 
   * Get all rows from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all($select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->table}");
    $this->db->order_by("id", 'DESC');
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }


}
