<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        must_login('auth/login');
    }
    public function index()
    {
        // $this->load->view('template_dashboard/template_header.php');
        // $this->load->view('template_dashboard/template_mainheader.php');
        // $this->load->view('template_dashboard/template_sidebar.php');
        // $this->load->view('v_dashboard');
        // $this->load->view('template_dashboard/template_footer.php');

        $data = [
            'title'             => 'Dashboard',
            'content'           => 'v_dashboard.php',
            'menuActive'        => 'dashboard',
            'submenuActive'     => 'dashboard',
            // untuk demo dashboard
            'chartjs'           => 1,
            'sparkline'         => 1,
            'chartcircle'       => 1,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
