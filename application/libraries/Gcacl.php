<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gcacl {

    public $perms = array();        //Array : Stores the permissions for the user
    public $userID = 0;            //Integer : Stores the ID of the current user
    public $userRoles = array();    //Array : Stores the roles of the current user

    public function __construct($params = array()) {
        $userID = '';

        $CI = & get_instance();
        if (isset($params['userID']))
            $userID = $params['userID'];

        if ($userID != '') {
            $this->userID = floatval($userID);
        } else {
            $admin_userdata = $CI->session->userdata(APP_PFIX . 'admin');
            $this->userID = $admin_userdata['adminid'];
        }
        $this->userRoles = $this->getUserRoles('ids');

        $this->buildACL();
    }

    public function getUserRoles() {
        $CI = & get_instance();
        $CI->db->where('userID', floatval($this->userID));
        $CI->db->order_by('addDate', 'ASC');
        $q = $CI->db->get('tbl_user_role');


        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $resp[] = $row['roleID'];
            }
            return $resp;

            $q->free_result();
        }
    }

    public function getAllRoles($format = 'ids') {
        $format = strtolower($format);

        $CI = & get_instance();
        $CI->db->order_by('roleName', 'ASC');
        $q = $CI->db->get('tbl_role');

        if ($q->num_rows() > 0) {
            $resp = array(); // responsibility
            foreach ($q->result() as $row) {
                if ($format == 'full') {
                    $resp[] = array("ID" => $row->ID, "Name" => $row->roleName);
                } else {
                    $resp[] = $row->ID;
                }
            }

            return $resp;

            $q->free_result();
        }
    }

    public function buildACL() {
        if (count($this->userRoles) > 0) {
            $this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
        }

        //then, get the individual user permissions
        $this->perms = array_merge($this->perms, $this->getUserPerms($this->userID));
    }

    public function getPermKeyFromID($permID) {
        $CI = & get_instance();
        $CI->db->select('permKey')->from('tbl_permission')->where('ID', floatval($permID))->limit(1);
        $q = $CI->db->get();

        if ($q->num_rows > 0) {
            $row = $q->row();
            return $row->permKey;
        }

        $q->free_result();
    }

    public function getPermNameFromID($permID) {
        $CI = & get_instance();
        $CI->db->select('permName')->from('tbl_permission')->where('ID', floatval($permID))->limit(1);
        $q = $CI->db->get();

        if ($q->num_rows > 0) {
            return $q->row()->permName;
        }

        $q->free_result();
    }

    public function getRoleNameFromID($roleID) {
        $CI = & get_instance();
        $CI->db->select('roleName')->from('tbl_role')->where('ID', floatval($roleID))->limit(1);
        $q = $CI->db->get();

        if ($q->num_rows > 0)
            return $q->row()->roleName;

        $q->free_result();
    }

    public function getUsername($userID) {
        $CI = & get_instance();
        $CI->db->select('username')->from('tbl_user')->where('user_id', floatval($userID))->limit(1);
        $q = $CI->db->get();

        if ($q->num_rows > 0)
            return $q->row()->username;

        $q->free_result();
    }

    public function getRolePerms($role) {
        //gc_debug($role);
        $CI = & get_instance();
        if (is_array($role)) {
            $CI->db->where_in('roleID', implode(",", $role));
            $CI->db->order_by('ID', 'ASC');
        } else {
            $CI->db->where('roleID', $role);
            $CI->db->order_by('ID', 'ASC');
        }
        $q = $CI->db->get('tbl_role_perms');
        //echo $CI->db->last_query();
        if ($q->num_rows() > 0) {
            $perms = array();
            foreach ($q->result() as $row) {
                $pK = strtolower($this->getPermKeyFromID($row->permID));
                if ($pK == '') {
                    continue;
                }
                if ($row->value === '1') {
                    $hP = true;
                } else {
                    $hP = false;
                }
                $perms[$pK] = array('perm' => $pK, 'inheritted' => true, 'value' => $hP, 'Name' => $this->getPermNameFromID($row->permID), 'ID' => $row->permID);
            }
            return $perms;
        } else {
            return array();
        }

        $q->free_result();
    }

    public function getUserPerms($userID) {
        $CI = & get_instance();
        $CI->db->where('userID', floatval($userID));
        $CI->db->order_by('addDate', 'ASC');
        $q = $CI->db->get('tbl_user_perm');

        $perms = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $pK = strtolower($this->getPermKeyFromID($row['permID']));
                if ($pK == '') {
                    continue;
                }
                if ($row['value'] == '1') {
                    $hP = true;
                } else {
                    $hP = false;
                }
                $perms[$pK] = array('perm' => $pK, 'inheritted' => false, 'value' => $hP, 'Name' => $this->getPermNameFromID($row['permID']), 'ID' => $row['permID']);
            }
        }

        return $perms;
    }

    public function getAllPerms($format = 'ids') {
        $format = strtolower($format);

        $CI = & get_instance();
        $CI->db->order_by('permName', 'ASC');
        $q = $CI->db->get('tbl_permission');

        $resp = array();
        if ($q->num_rows > 0) {
            foreach ($q->result() as $row) {
                if ($format == 'full') {
                    $resp[$row->permKey] = array('ID' => $row->ID, 'Name' => $row->permName, 'Key' => $row->permKey);
                } else {
                    $resp[] = $row->ID;
                }
            }
        }
        return $resp;
    }

    public function userHasRole($roleID) {
        
        if (isset($this->userRoles)) {
            foreach ($this->userRoles as $k => $v) {
                if (floatval($v) === floatval($roleID)) {
                    return true;
                }
            }
            return false;
        }
    }

    public function hasPermission($permKey) {
        //gc_debug($this->perms);
        //echo array_key_exists($permKey, $this->perms);
        //echo '<pre>'; print_r($this->perms); exit;
        $permKey = strtolower($permKey);
        if (array_key_exists($permKey, $this->perms)) {
            if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPermKeyFromURI() {
        $CI = & get_instance();
        return strtolower($CI->router->class . '_' . $CI->router->method);
    }

}
