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
    $now = now();
    $createdAt = unix_to_human($now, true, 'europe');
    
    // kas_code format string build
    $code  = ($data['add-type'] == 'kredit') ? 'K' : 'D'; // K= Kredit ; D = Debet
    $code .= mdate('/%y/%m/', $now); // kode untuk tahun dan bulan

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
		  "description"     => $data['add-ketetrangan'],
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
   * Update product that already registered and still active (not deleted).
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param array $data [8 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_update_by_id($id, $data)
  {
    if (($data['edit-tipeupdate'] !== '+') && ($data['edit-tipeupdate'] !== '-'))
    {
      return FALSE;
    }
    $createdAt = unix_to_human(now(), true, 'europe');
    // ('+' or '-') and (total stok to be inputted)
    $operand  = $data['edit-tipeupdate'];
    $total    = $data['edit-updatestok'];
    $data = [
		  "updated_at"    => $createdAt,
      "updated_by"    => $data['edit-username'],
    ];
    // pprint($total);
    // pprintd($operand);
    // set data to table `quantity`
    $this->db->set("quantity", "quantity {$operand} {$total}", FALSE);
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);



    // $this->db->trans_start();
    // $this->db->trans_complete();

    // if ($this->db->trans_status() === FALSE)
    // {
    //   // flashdata untuk sweetalert
    //   $this->session->set_flashdata('failed_message', 1);
    //   $this->session->set_flashdata('title', "Input gagal!");
    //   $this->session->set_flashdata('text', 'Data gagal diproses! Hubungi administrator segera.');
    //   redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
    // }
    // else
    // {
    //   return 1;
    // }

  }
  
  /**
   * 
   * Delete employee that already registered, but not the actual row data deletion,
   * this is just updating "is_deleted" fields in the table from 0 to 1.
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_by_id($id)
  {
    // echo '<pre>'; print_r($id); die;
    $data = array(
		  "is_deleted"   => 1,
    );
    $this->db->where('id', $id);
		return $this->db->update($this->table, $data);
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
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by("pi.id", 'ASC');
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
  
  /**
   * 
   * Get one role by the role unique id
   * 
   * @param string $id 
   * Set the $id from the role id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_role_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_role, "{$this->tb_role}.id={$this->table}.role_id");
    $this->db->where("{$this->table}.id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }
  
  /**
   * 
   * Get one store by the store unique id
   * 
   * @param string $id 
   * Set the $id from the store id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_store_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_store, "{$this->tb_store}.id={$this->table}.store_id");
    $this->db->where("{$this->table}.id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }
    
  // get 1 product_composition berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  /**
   * 
   * Get all Product Composition that is belong to
   * the corresponding Product by joining some tables on its id.
   * 
   * @param string $id 
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_composition_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_product_composition, "{$this->table}.id={$this->tb_product_composition}.product_id");
    $this->db->join($this->tb_material, "{$this->tb_product_composition}.material_id={$this->tb_material}.id");
    $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }



}
