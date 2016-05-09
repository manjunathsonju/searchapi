<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    /**
     * This is the action to handle the form posted values and gives geocodelocation.
     */
    public function gecodetweets(){

        $address = $_POST['address'];
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;

        $connection = new TwitterOAuth('CE80DPv2XTWpATjhmUTskOhOB', 'oxT2gOo0uPuS8DVfv9xr4r2l8Ecri6d51ripYMxNAPYv6jwsn5', '60834234-8cfGZ29yDSx103bnywyibOZQoPGcDq9jt8rbqogm2', '5Ra1N2ppzZI2lOnx6MajodBeSfvMGlYYnMJHbGZnhgyo7');
        $tweets = $connection->get("geo/search", ['query'=>$address, 'geocode'=>$latitude.','.$longitude.',1mi'])->result;
        
        $arrays = array();
        $ar = array();
        $i=0;
        foreach($tweets->places as $tweet){
            $arrays[$i]['position'] = $tweet->centroid;
            $arrays[$i]['id'] = $tweet->id;
            $i++;
        }

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
            'arrays'=>$arrays,
            'latitude'=>$latitude,
            'longitude'=>$longitude
        );

        $this->load->view('templates/main/template', $data);
    }
    
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function index(){
        $breadcrumb = array(
            array('url' => 'welcome', 'name' => 'Geocode', 'active' => TRUE),
        );
        $data = array(
            'main_content' => 'index',
            'page' => 'Index',
            'breadcrumb' => $breadcrumb,
            'pagetitle' => 'Dashboard',
            'content_title' => 'Home',
            'removeheader' => true,
            //'arrays'=>$arrays
        );

        $this->load->view('templates/main/template', $data);    
    }
}