<?php

/**
 * 
 * @dioilham
 * 
 */
class Kas_model extends CI_Model
{

  var $table          = 'kas';

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
    
    // kas_code format string build
    $code  = ($data['add-type'] == 'kredit') ? 'K' : 'D'; // K= Kredit ; D = Debet
    $code .= mdate('/%y/%m/', $now); // kode untuk tahun dan bulan

    // pprint($code);
    // pprintd($data);
    // get last kas_code form table row
    $last_row          = $this->db->select('kas_code, final_balance')->order_by('id',"desc")->limit(1)->get($this->table);
    $lastKasCode       = $last_row->row()->kas_code;
    $lastFinalBalance  = $last_row->row()->final_balance;
    // jika belum ada sama sekali data di db
    if ($last_row->num_rows() > 0) $lastCode = $lastKasCode;
    else $lastCode = $code.'0000';

    // dari kas_code terakhir di db, ambil hanya angka urutan di setelah "/" terakhir
    // tambah 1, tambah 0 di depannya dan sesuaikan total angka yaitu 4
    // kemudian masukan kembali ke string $code
    $lastCode  = explode('/', $lastCode);
    $codeNum   = end($lastCode) + 1; // kode nomor urut
    $codeMonth = prev($lastCode); // kode bulan
    $currMonth = mdate('%m', $now);

    // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 0001
    $codeNum   = ($codeMonth !== $currMonth) ? '0001' : $codeNum;
    $code     .= str_pad($codeNum, 4, "0", STR_PAD_LEFT);

    // set final_balance yg baru
    if ($data['add-type'] == 'kredit') $newFinalBalance = $lastFinalBalance - (int)$data['add-nominal'];
    else $newFinalBalance = $lastFinalBalance + (int)$data['add-nominal'];
    // $newFinalBalance  = $lastFinalBalance - (int)$data['add-nominal'];

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
   * Get total rows from certain table
   * 
   * @param string $keyName 
   * Default value is NULL, but you can input some string to get array
   * with $keyName as a key and the total row as a value.
   * 
   */
  public function get_total($keyName = NULL)
  {
    $total = $this->db->count_all_results($this->table);

    if ($keyName !== NULL)
    {
      if ($keyName === '') $keyName = 'key';
      $total = [$keyName => $total];
    }
    return $total;
  }

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
  
  /**
   * 
   * Get one row from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_by_id($id, $select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where('pi.id', $id);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by("pi.id", 'ASC');
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }



}
