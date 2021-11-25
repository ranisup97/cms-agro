<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Master_course_category_model extends CI_Model
{
    function render($id=0)
    {
        $this->db->select("id,namaCategory");
        $this->db->where("status", "0");
        if ( empty($id) == FALSE )
            $this->db->Where("id", $id);
            $this->db->order_by("id", "DESC");
        $q = $this->db->get("course_category");
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
}