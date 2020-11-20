<?php

/**
 *
 */
class File_management_model extends CI_Model
{

  // Import file excel ke database
  /**
   * Method untuk upload file excel ke database (import)
   * 
   * @param  string $table  [Nama tabel]
   * @param  array $data    [Data key dan value]
   * @return bool           [success / not]
   * 
   */
  public function import_excel_to_table($table = NULL, $data = NULL){
    if ($table == NULL OR $data == NULL) {
      echo "Nama tabel harus terisi dan data harus terisi";
      header( "Refresh:3; url=".base_url(), true, 303);
      exit();
    }
    return $this->db->insert($table, $data);
  }



}

 ?>
