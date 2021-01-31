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
        must_not_login();

        $data = [
            'title'     => 'Login',
            'content'   => 'auth/v_login.php'
        ];

        $this->load->view('template_dashboard/template_wrapper_login.php', $data);
    }


    public function login()
    {
        must_not_login();

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            // jika syarat form belum terpenuhi (tombol login belum ditekan)
            // $this->load->view('template_dashboard/template_wrapper_login.php', $data);
            $this->index();
            // echo validation_errors();
            // echo 'error';
        } else {
            // echo 'valid';
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
                        'id'         => $data_user->id,
                        'username'   => $data_user->username,
                        'email'      => $data_user->email,
                        'first_name' => $data_user->first_name,
                        'last_name'  => $data_user->last_name,
                        'phone'      => $data_user->phone,
                        'role_id'    => $data_user->role_id,
                        'avatar'     => $data_user->avatar,
                        'isLogin'    => 1,
                        'store_id'   => $data_user->store_id
                    ];
                    // pprintd($session_array);
                    $this->session->set_userdata($session_array);

                    switch ($session_array['role_id']) {
                        case '3':
                            redirect('kasir');
                            break;
                        
                        default:
                            redirect('dashboard');
                            break;
                    }
                } else { //else ketika password salah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Username or Password is incorrect</div>');
                    redirect(base_url('auth/login'));
                    // echo 'error';
                }
            } else { //else ketika username tidak ada atau tidak valid

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username or Password is incorrect</div>');
                // echo 'error 2';
                redirect(base_url('auth/login'));
            }
        }
    }




    private function registration()
    {
        $store_data = $this->Store_model->getAll();
        $role_data = $this->Role_model->getAll();
        $data = [
            'title'     => 'Registration',
            'content'   => 'auth/v_registration.php',

            'menuActive'    => '', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive' => '', // harus selalu ada, buat indikator sidebar menu yg aktif
            'store_data'    => $store_data,
            'role_data'     => $role_data,
        ];

        // $this->load->view('template_dashboard/template_wrapper_login.php', $data);
        // $this->load->view('template_dashboard/template_wrapper', $data);


        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|min_length[5]|max_length[50]|alpha_dash|is_unique[employee.username]',
            array(
                'min_length'    => 'Username must contain at least 5 characters',
                'max_length'     => 'Username must contain at max 50 characters',
                'alpha_dash'     => 'Only alphabet, number, underscores and dashes allowed',
                'is_unique'     => 'Username already registered.',
            )
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[5]|max_length[250]',
            array(
                'min_length'     => 'Password must contain at least 5 characters',
                'max_length'     => 'Password must contain at max 250 characters',
            )
        );

        $this->form_validation->set_rules(
            'email',
            'E-Mail',
            'trim|required|valid_email|max_length[50]|is_unique[employee.email]',
            array(
                'is_unique'     => 'E-mail already registered.',
                'max_length'     => 'E-mail must contain at max 50 characters',
            )
        );

        $this->form_validation->set_rules(
            'firstname',
            'First Name',
            'trim|required|min_length[2]|max_length[50]',
            array(
                'min_length'     => 'Firstname must contain at least 2 characters',
                'max_length'     => 'Firstname must contain at max 50 characters',
            )
        );

        $this->form_validation->set_rules(
            'lastname',
            'Last Name',
            'trim|min_length[2]|max_length[50]',
            array(
                'min_length'     => 'Lastname must contain at least 2 characters',
                'max_length'     => 'Lastname must contain at max 50 characters',
            )
        );

        $this->form_validation->set_rules(
            'phone',
            'Phone Number',
            'trim|required|min_length[10]|max_length[15]|numeric|is_unique[employee.phone]',
            array(
                'min_length'     => 'Phone number must contain at least 10 characters',
                'max_length'     => 'Phone number must contain at max 15 characters',
                'numeric'         => 'Phone number must contain only numbers.',
                'is_unique'     => 'Phone number already registered.',
            )
        );

        $this->form_validation->set_rules(
            'address',
            'Address',
            'trim|min_length[2]',
            array(
                'min_length'     => 'Lastname must contain at least 2 characters',
            )
        );


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template_dashboard/template_wrapper', $data);
        } else {

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
            $register = $this->Users_model->save($data);

            if ($register == 1) {
                // $this->session->set_flashdata('success_message', 1);
                // $this->session->set_flashdata('title', 'Registration complete !');
                // $this->session->set_flashdata('text', 'Please activate your account via email');
                // redirect(base_url('login'));
                echo 'berhasil';
            } else {
                // $this->session->set_flashdata('failed_message', 1);
                // $this->session->set_flashdata('title', 'Registration failed !');
                // $this->session->set_flashdata('text', 'Please check again your information');
                // redirect(base_url('register'));
                echo 'gagal';
            }
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }



    // END
}
