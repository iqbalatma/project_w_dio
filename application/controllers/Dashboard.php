<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Dashboard extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['is_logged'] !== 'TRUE') {
            redirect('Auth');
        }
    }
    public function index()
    {
        // $this->load->view('template_dashboard/template_header.php');
        // $this->load->view('template_dashboard/template_mainheader.php');
        // $this->load->view('template_dashboard/template_sidebar.php');
        // $this->load->view('v_dashboard');
        // $this->load->view('template_dashboard/template_footer.php');

        $data = [
            'title'     => 'Dashboard',
            'content'   => 'v_dashboard.php'
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
