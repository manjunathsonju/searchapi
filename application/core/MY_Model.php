<?php

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = '';
    protected $_primary_filter = 'varchar';
    protected $_order_by = '';
    protected $_asc_desc = '';
    protected $_timestamps = FALSE;

    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param int $id
     * @param bool $single
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function get($id = NULL, $single = FALSE, $limit = '', $offset = '', $select = '') {

        if ($id != null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by, $this->_asc_desc);
        }

        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }

        if (!empty($select)) {
            $this->db->select($select);
        }

        return $this->db->get($this->_table_name)->$method();
    }

    /**
     *
     * @param array $where
     * @param bool $single
     * @return array
     */
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(null, $single);
    }

    public function get_select($select =''){
        $this->get(null,false,'','',$select);
    }

    /**
     *
     * @param array $data
     * @param int $id
     * @return id
     */
    public function save($data, $id = null) {

        //set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }
       
        //Insert
        if ($id == NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;

            $this->db->set($data)->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        //update
        else {
            $filter = $this->_primary_filter;
            $this->id = $filter($id);
            $this->db->set($data)->where($this->_primary_key, $id)->update($this->_table_name);
        }
        return $id;
    }
    
     public function save_non_integer_primary_field($data, $id = null) {

        //set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        //Insert
        if ($id == NULL) {
            //!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            //debug($data);
            $this->db->set($data)->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        //update
        else {
            $filter = $this->_primary_filter;
            $this->id = $filter($id);
            $this->db->set($data)->where($this->_primary_key, $id)->update($this->_table_name);
        }
        return $id;
    }

    /**
     *
     * @param array $fields
     * @return array
     */
    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    /**
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);
        if (!$id) {
            return false;
        }
        return $this->db->where($this->_primary_key, $id)->limit(1)->delete($this->_table_name);
    }

    /**
     *
     * @param array|int $id
     * @param string $imgpath
     * @return boolean
     */
    public function delete_images($id = 0, $imgpath = NULL) {
        if (!$id) {
            return FALSE;
        }

        //to make sure id is array
        $ids = is_array($id) ? $id : array($id);
        // for displaying number of successful deleted items
        $deleted_count = 0;
        $filter = $this->_primary_filter;
        if (!empty($ids)):
            foreach ($ids as $id):
                $id = $filter($id);
                $result = $this->get($id, TRUE);

                if ($result) {
                 //   dump_exit($imgpath . $result->image);
                    @unlink($imgpath . $result->image);
                    @unlink($imgpath . 'thumb_' . $result->image);
                    if ($this->delete($id)) {
                        ++$deleted_count;
                    }
                }
            endforeach;
        endif;
        return $deleted_count;
    }

    /**
     *
     * @param array $where
     * @return type
     */
    public function getnum_rows(Array $where = null) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $result = $this->db->from($this->_table_name)->count_all_results();
        return !empty($result) ? $result : FALSE;
    }

    /**
     *
     * @param array|int $id
     * @param bool $status
     * @return type
     */
    public function changeStatus($id, $status) {
        if (is_array($id)) {

            return $this->db->where_in($this->_primary_key, $id)->update($this->_table_name, array('status' => $status));

        } else {
            $this->db->where($this->_primary_key, $id);
            return $this->db->update($this->_table_name, array('status' => $status));
        }
    }

}