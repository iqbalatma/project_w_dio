<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Kasir_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // protected $table      = '';
    // protected $table2      = 'test';
    // protected $primaryKey = 'material_code';
    protected $returnType     = 'array';


    public function insert_invoice($data)
    {
        return $this->db->insert('invoice', $data);
    }

    public function insert_transaction($data)
    {
        return $this->db->insert('transaction', $data);
    }
    public function insert_invoice_item($data)
    {
        return $this->db->insert('invoice_item', $data);
    }

    public function get_row_terbaru()
    {
        $query = $this->db->query("SELECT id FROM transaction ORDER BY id DESC LIMIT 1");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;

        // if (isset($row)) {
        //     echo $row['title'];
        //     echo $row['name'];
        //     echo $row['body'];
        // }
    }

    public function update_total_price($data)
    {
        $this->db->set('price_total', $data['price_total'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('transaction'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
    }

    public function insert_product_mutation($data)
    {
        return $this->db->insert('product_mutation', $data);
    }

    public function update_quantity_inventory_product($data)
    {
        $id = $data['id'];
        $store_id = $data['store_id'];
        $quantity_input = $data['quantity'];
        $query = $this->db->query("SELECT * FROM product_inventory WHERE product_id=$id AND store_id=$store_id");

        $row = $query->row_array();
        $quantity_db = $row['quantity'];
        // $row = $query->last_row();





        $final_quantity = $quantity_db - $quantity_input;
        $this->db->set('quantity', $final_quantity, FALSE);
        $this->db->where('product_id', $id);
        $this->db->update('product_inventory');
    }

    public function get_customer($data)
    {
        $customer_id = $data;
        $query = $this->db->query("SELECT cust_type FROM customer WHERE id=$customer_id");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;
    }

    public function cek_number_invoice($data)
    {
        $tanggal = $data;

        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where("created_at", $tanggal);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        }
        return true;
    }

    public function cek_invoice_terakhir($data)
    {
        $tanggal = $data;

        $query = $this->db->query("SELECT * FROM invoice WHERE created_at='$tanggal' ORDER BY id DESC LIMIT 1 ");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;
    }
}
