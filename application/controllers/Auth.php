<?php

defined('BASEPATH') or exit('No direct script access allowed');




class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Users_model");
        $this->load->model("Store_model");
        $this->load->model("Role_model");

        // Ketika user sudah melakukan login maka akan redirect ke dashboard
    }
    public function index()
    {
        if (isset($_SESSION['is_logged'])) {
            redirect('Dashboard');
        }
        $data = [
            'title' => 'Login',
            'content' => 'v_login.php'
        ];

        $this->load->view('template_dashboard/template_wrapper_login.php', $data);
    }


    public function login()
    {
        $data = [];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Cek apakah username yang di inputkan ada pada database dengan melakukan search by username
        $is_username_valid = $this->Users_model->getByUsername($username);


        // Cek Username valid atau tidak
        if ($is_username_valid) {
            $data_user = $is_username_valid;
            // password dari database masih berupa hash
            $password_on_db = $is_username_valid->password;
            // verifikasi password dari hash
            $is_password_valid = password_verify($password, $password_on_db);
            if ($is_password_valid) {
                $session_array = [
                    'is_logged' => 'TRUE',
                    'id'    => $data_user->id,
                    'username' => $data_user->username,
                    'email' => $data_user->email,
                    'first_name' => $data_user->first_name,
                    'last_name' => $data_user->last_name,
                    'phone' => $data_user->phone,
                    'role_id' => $data_user->role_id,
                ];
                $this->session->set_userdata($session_array);
                redirect('Dashboard');
            } else { //else ketika password salah

            }
        } else { //else ketika username tidak ada atau tidak valid

        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth');
    }

    public function registration()
    {
        $store_data = $this->Store_model->getAll();
        $role_data = $this->Role_model->getAll();
        $data = [
            'title' => 'Registration',
            'content' => 'v_registration.php',
            'store_data' => $store_data,
            'role_data' => $role_data,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function registration_progress()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = $this->input->post('email');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $roleuser = $this->input->post('roleuser');
        $store = $this->input->post('store');
        $data = [
            'id' => '',
            'is_deleted' => 0,
            'password' => $password,
            'username' => $username,
            'email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $phone,
            'address' => $address,
            'role_id' => $roleuser,
            'store_id' => $store
        ];
        $this->Users_model->save($data);
    }
}
