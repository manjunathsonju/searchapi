<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CodeIgniter Mylibrary Library Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Mylibraries
 * @author		colors2web
 * @link
 */
class Mylibrary {

    /**
     * return data from supplied field
     * @params field name, where clause (array), table name
     * @return field data
     */
    function get_field($field, $where, $table) {
        $CI = & get_instance();

        $CI->db->where($where);
        $CI->db->select($field);
        $query = $CI->db->get($table);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$field;
        }

        $query->free_result();
    }

    function get_all_fields($where, $table, $format = 'object') {
        //echo 'sdfs';
        $CI = & get_instance();

        $CI->db->where($where);
        $query = $CI->db->get($table);
        //echo $query->num_rows();
        if ($query->num_rows() > 0) {
            if ($format == 'array') {
                return $row = $query->row_array();
            } else {
                return $row = $query->row();
            }
        }

        $query->free_result();
    }

    function get_table($where = FALSE, $order = FALSE, $table, $num = FALSE, $offset = FALSE) {

        $CI = & get_instance();

        if ($order)
            $CI->db->order_by($order);

        if ($where)
            $CI->db->where($where);

        if ($num || $offset)
            $q = $CI->db->get($table, $num, $offset);
        else
            $q = $CI->db->get($table);

        if ($q->num_rows() > 0)
            return $q->result();

        $q->free_result();
    }

    /**
     * update data 
     * @params field name (array), where clause (array), table name
     */
    function update_fields($data, $where, $table) {

        $CI = & get_instance();

        $CI->db->where($where);
        $CI->db->update($table, $data);
    }

    function delete_field($where, $table) {

        $CI = & get_instance();

        $CI->db->where($where);
        $CI->db->delete($table);
    }

    function site_settings() {

        $CI = & get_instance();

        $q = $CI->db->get('c2w_settings');
        $data = $q->row();
        $q->free_result();
        return $data;
    }

    function getTotalRows($where = FALSE, $table) {

        $CI = & get_instance();

        if ($where)
            $CI->db->where($where);

        $CI->db->from($table);

        return $CI->db->count_all_results();
    }

    function getThumbnailImage($img) {

        $img_arr = explode(".", $img);
        return $img_arr[0] . "_thumb." . $img_arr[1];
    }

    function getSelectedSubCategories($cat_id, $show_label = FALSE, $show_default_option = FALSE, $enable_js = FALSE, $enable_select = FALSE) {

        $CI = & get_instance();

        $subcat = FALSE;

        $CI->db->where('cat_parent_id', $cat_id);
        $CI->db->where('cat_parent_id !=', '0');
        $q = $CI->db->get('categories');

        if ($q->num_rows() > 0) {
            $subcat = $q->result();
        }

        $q->free_result();

        if ($subcat) {

            $return = "";

            if ($show_label) {
                $return .= "<label for=\"sub_cat_id\">Sub Category:</label>";
            }

            $return .= "<select name=\"sub_cat_id\" " . $enable_js . ">";

            if ($show_default_option) {
                $return .= "<option value='0'> Select Sub Category </option>";
            }

            foreach ($subcat as $val) {

                if ($val->cat_ID == $enable_select) {
                    $select = 'selected = "selected"';
                } else {
                    $select = '';
                }

                $return .= "<option value='" . $val->cat_ID . "' " . $select . ">" . $val->cat_name . "</option>";
            }
            $return .= "</select>";

            return $return;
        }
    }

    function getImageSize($attr, $img) {

        $return = array();
        list($width, $height, $type, $attr) = getimagesize($img);

        if ($attr['img_width'])
            $return['img_width'] = $width;

        if ($attr['img_height'])
            $return['img_height'] = $height;

        if ($attr['img_type'])
            $return['img_type'] = $type;

        if ($attr['img_attr'])
            $return['img_attr'] = $attr;

        return $return;
    }

    function getUniqueOrderCode($str) {

        $CI = & get_instance();

        $CI->load->helper('string');
        return random_string('alnum', 5) . $str;
    }

    function get_total_price_order($order_code) {

        $CI = & get_instance();
        $sum = 0;

        $CI->db->where('order_code', $order_code);
        $q = $CI->db->get('cart');
        if ($q->num_rows() > 0) {
            $cart = $q->result();

            foreach ($cart as $lists) {

                $sum += ( $lists->prod_qnty * $lists->prod_price );
            }
        }

        return number_format($sum, 2, '.', '');

        $q->free_result();
    }

    function get_order_status($status) {

        if ($status == '2') {

            return 'processing';
        } else if ($status == '3') {

            return 'delivered';
        } else {

            return 'pending';
        }
    }

    function get_review_status($status) {

        if ($status == '1') {

            return 'approved';
        } else {

            return 'pending';
        }
    }

    function get_user($user_id, $link = FALSE) {

        $user = 'Unkonwn';

        if ($user_id == '0') {

            $user = 'Admin';
        } else {

            if ($this->getTotalRows(array('user_ID' => $user_id), 'signup') > 0) {

                $first_name = $this->get_field('first_name', array('user_ID' => $user_id), 'signup');
                $last_name = $this->get_field('last_name', array('user_ID' => $user_id), 'signup');
                $user = $first_name . " " . $last_name;

                if ($link)
                    $user = '<a href="' . base_url() . 'index.php/admincustomers/edit/' . $user_id . '">' . $user . '</a>';
            }
        }

        return $user;
    }

    function getGroupedCategories($cat_id, $select = FALSE) {

        $return = '';

        $cat_name = $this->get_field('cat_name', array('cat_ID' => $cat_id), 'categories');

        if ($this->getTotalRows(array('cat_parent_id' => $cat_id), 'categories')) {

            $categories = $this->get_table(array('cat_parent_id' => $cat_id), '', 'categories');

            $return .= "<optgroup label='" . $cat_name . "'>";

            foreach ($categories as $cat_lists) {

                if ($select) {

                    if ($cat_id == $select) {
                        $selected = 'selected = "selected"';
                    } else {
                        $selected = '';
                    }
                }

                $return .= "<option value='" . $cat_id . "' " . $selected . ">" . $cat_lists->cat_name . "</option>";
            }

            $return .= "</optgroup>";
        } else {

            if ($select) {

                if ($cat_id == $select) {
                    $selected = 'selected = "selected"';
                } else {
                    $selected = '';
                }
            }

            $return .= "<option value='" . $cat_id . "' " . $selected . ">" . $cat_name . "</option>";
        }

        echo $return;
    }

}

/* End of file Mylibrary.php */