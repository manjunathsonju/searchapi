<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('get_user_role'))
{
	function get_user_role($userid = '')
	{
		$CI =& get_instance();
                $CI->db->select('roleID');
                $CI->db->where('userID',$userid);
		$q = $CI->db->get('tbl_user_role');
                $fin = array();
                if($q->num_rows() > 0){
                    foreach($q->result() as $result){
                        $fin[] = $result->roleID;
                    }
                }
		return $fin;
	}
}