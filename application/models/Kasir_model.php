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
        // $this->db->set('price_total', $data['price_total'], FALSE);
        // $this->db->where('id', $data['id']);
        // $this->db->update('transaction');
        $price_total = $data['price_total'];
        $id = $data['id'];
        $nama_tabel = "transaction";
        $query = $this->db->query("UPDATE $nama_tabel SET price_total = $price_total WHERE id = $id");
        // gives UPDATE mytable SET field = field+1 WHERE id = 2
        return 1;
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
        return 1;
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
        $tanggal = explode("-", $tanggal);
        $tanggal = $tanggal[1];

        // $this->db->select('*');
        // $this->db->from('invoice');
        // $this->db->where("created_at", $tanggal);

        // $query = $this->db->get();

        $query = $this->db->query("SELECT * FROM invoice  ORDER BY id DESC LIMIT 1 ");
        $row = $query->row_array();
        $row = $row['created_at'];
        $row = explode("-", $row);
        $row = $row[1];



        if ($row == $tanggal) {
            return false;
        }
        return true;
    }

    public function cek_invoice_terakhir($data)
    {
        $tanggal = $data;

        $query = $this->db->query("SELECT * FROM invoice ORDER BY id DESC LIMIT 1 ");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;
    }


    public function cek_id_invoice_terakhir()
    {


        $query = $this->db->query("SELECT * FROM invoice WHERE is_deleted=0 ORDER BY id DESC LIMIT 1 ");

        $row = $query->row_array();


        return $row;
    }

    public function update_left_to_paid($data)
    {
        $id = $data['id'];
        $left_to_paid = $data['left_to_paid'];
        $this->db->set('left_to_paid', $left_to_paid, FALSE);
        $this->db->where('id', $id);
        $this->db->update('invoice');
        return 1;
    }



    public function cek_komposisi($data)
    {
        $id_product = $data;

        $this->db->select('*');
        $this->db->from('product_composition');
        $this->db->where("product_id", $id_product);


        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function update_quantity_material($data)
    {
        $material_id = $data['material_id'];
        $quantity = $data['quantity_material'];
        $store_id = $data['store_id'];
        $query = $this->db->query("UPDATE material_inventory SET quantity = quantity - $quantity WHERE material_id = $material_id");
        return $query;
    }

    public function cek_kuantitas_material($id_product)
    {
        $query = $this->db->query("SELECT * FROM product_composition WHERE product_id = $id_product");

        $row = $query->result_array();


        return $row;
    }

    public function cek_inventory($id_material)
    {
        $query = $this->db->query("SELECT * FROM material_inventory WHERE material_id =$id_material");

        $row = $query->result_array();


        return $row;
    }

    public function insert_material_mutation($data)
    {
        return $this->db->insert('material_mutation', $data);
    }

    public function cek_harga_custom($data)
    {
        $code_product = $data['code_product'];
        $id_customer = $data['id_customer'];

        $query = $this->db->query("SELECT * FROM custom_price WHERE customer_id ='$id_customer' AND product_code = '$code_product'");

        $row = $query->result_array();


        return $row;
    }
    public function get_code_product($id_product)
    {


        $query = $this->db->query("SELECT * FROM product WHERE id =$id_product");

        $row = $query->result_array();


        return $row;
    }

    public function get_ajax()
    {
        $query = $this->db->query("SELECT * FROM product WHERE id =1");

        $row = $query->result_array();


        return json_encode($row);
    }


    public function get_hutang()
    {
        $query = $this->db->query("SELECT invoice.id, invoice.invoice_number,invoice.left_to_paid, invoice.paid_at, invoice.is_deleted, invoice.transaction_id, transaction.customer_id, customer.full_name, customer.address, customer.phone FROM invoice INNER JOIN transaction ON invoice.transaction_id = transaction.id INNER JOIN customer ON transaction.customer_id = customer.id WHERE invoice.status = '0' AND left_to_paid > 0");

        $row = $query->result_array();


        return $row;
    }

    public function edit_invoice($data)
    {
        $id_invoice = $data['id_invoice'];
        $paid_amount = $data['paid_amount'];
        $query = $this->db->query("UPDATE invoice SET status = '1' WHERE id = $id_invoice");
        return $query;
    }



    public function generate_invoice($invoice_id)
    {
        $query = $this->db->query("SELECT invoice.id, invoice.invoice_number,invoice.left_to_paid, invoice.paid_at, invoice.is_deleted, invoice.transaction_id, invoice.created_at, transaction.customer_id, customer.full_name, customer.address, customer.phone FROM invoice INNER JOIN transaction ON invoice.transaction_id = transaction.id INNER JOIN customer ON transaction.customer_id = customer.id WHERE invoice.is_deleted = 0 AND invoice.id=$invoice_id");

        $row = $query->result_array();


        return $row;
    }
    public function generate_invoice_item($invoice_id)
    {
        $query = $this->db->query("SELECT product.full_name, product.unit,invoice_item.quantity, invoice_item.item_price FROM invoice_item INNER JOIN product ON invoice_item.product_id = product.id WHERE invoice_item.invoice_id=$invoice_id");

        $row = $query->result_array();


        return $row;
    }
}
