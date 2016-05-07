<?php

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('file');
    }

    public function index(){

    	$breadcrumb = array(
            array('url' => 'welcome', 'name' => 'Home', 'active' => TRUE),
        );

    	$data = array(
            'main_content' => 'dashboard',
            'page' => 'dashboard',
            'breadcrumb' => $breadcrumb,
            'pagetitle' => 'Dashboard',
            'content_title' => 'Home',
            'removeheader' => true,
        );

        $this->load->view('templates/main/template', $data);
    }
}