<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Master_course_part_model extends CI_Model
{
    function render($id=0)
    {
        $this->db->select("course_part_id,course_part_title,part_into");
        $this->db->where("status", "0");
        if ( empty($id) == FALSE )
            $this->db->Where("course_part_id", $id);
            $this->db->order_by("course_part_id", "DESC");
        $q = $this->db->get("course_part");
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
}