<?php

/**
 *
 */
class Meta_model extends CI_Model
{

  var $tb_meta = 'basic_info_meta';

//  ===============================================SETTER===============================================
  // insert meta info baru
  /**
   * setter untuk membuat meta info baru
   * yang hanya bisa diakses oleh superadmin
   * @param array $data [berisi 8 data]
   */
  public function set_new_meta($data){
    $createdAt = unix_to_human(now(), true, 'europe');
    $data = array(
		  "fullname"    => $data['add-nama-perusahaan'],
		  "address"     => $data['add-alamat-perusahaan'],
		  "contact_1"   => $data['add-kontak-1'],
		  "contact_2"   => $data['add-kontak-2'],
		  "email"       => $data['add-email'],
		  "website"     => $data['add-website'],
		  // "logo"     => $data['add-logo'],
		  "created_at"  => $createdAt,
    );
		return $this->db->insert($this->tb_meta, $data);
  }

  // update meta by id
  public function set_update_meta_by_id($id, $data){
    $updatedAt = unix_to_human(now(), true, 'europe');
    $data = array(
		  "fullname"    => $data['edit-nama-perusahaan'],
		  "address"     => $data['edit-alamat-perusahaan'],
		  "contact_1"   => $data['edit-kontak-1'],
		  "contact_2"   => $data['edit-kontak-2'],
		  "email"       => $data['edit-email'],
		  "website"     => $data['edit-website'],
		  // "logo"     => $data['edit-logo'],
      "updated_at"  => $updatedAt,
      "updated_by"  => $data['username'],
    );
    $this->db->where('id', $id);
		return $this->db->update($this->tb_meta, $data);
  }



//  ===============================================GETTER===============================================
//  echo "<pre>";print_r();die();
  // get total
  public function get_total(){
    // get from $tb_meta
    $this->db->select('count(id) AS total');
    $this->db->from($this->tb_meta);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  // get all kelas
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  public function get_all($select = '*'){
    // get from tb_meta
    $this->db->select($select);
    $this->db->from($this->tb_meta);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result();
    }
    return FALSE;
  }

  // get 1 kelas berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  public function get_meta_by_id($id, $select = '*'){
    // get from tb_meta
    $this->db->select($select);
    $this->db->from($this->tb_meta);
    $this->db->where('id', $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

}

// $this->db->trans_start();
// $this->db->query('AN SQL QUERY...');
// $this->db->query('ANOTHER QUERY...');
// $this->db->trans_complete();
//
// if ($this->db->trans_status() === FALSE)
// {
//         // generate an error... or use the log_message() function to log your error
// }

?>
