<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('file');
    }

    public function index(){
        $connection = new TwitterOAuth('CE80DPv2XTWpATjhmUTskOhOB', 'oxT2gOo0uPuS8DVfv9xr4r2l8Ecri6d51ripYMxNAPYv6jwsn5', '60834234-8cfGZ29yDSx103bnywyibOZQoPGcDq9jt8rbqogm2', '5Ra1N2ppzZI2lOnx6MajodBeSfvMGlYYnMJHbGZnhgyo7');
        $content = $connection->get("geo/search", ['query'=>'Toronto']);
        //print_r($content);die();
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