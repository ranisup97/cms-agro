<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Master_course_part extends SITE_Controller
{
    private $page_curr = "";
    function __construct()
    {
        parent::__construct();
        $this->fragment['site']['module'] = "master-course-part";
        $this->page_curr = "master-course-part";
        $this->load->model("master_course_part_model", "mod");
    }
    function index()
    {
        // print_r('aaaaaaaaaaaa');die();
        if ( !$this->hasLogin() )redirect("auth/signin");
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/master/coursePartContent").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']             = $this->mod->render();
        $this->fragment['page_nav']         = "master::master-course-part";
        $this->fragment['page_title']       = "Data Course Part Content";
        $this->fragment['page_curr']        = $this->page_curr;
        $this->fragment['pagename']         = "index";
        $this->load->view("main-site", $this->fragment);
    }

    function save()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $isnew      = TRUE;
        $id         = $this->input->post("id");
        $part_into  = $this->input->post("part_into");
        $name       = $this->input->post("name", TRUE);
        
        // print_r($this->input->post()); die;
        $query_sel = "";
        if ( empty($id) == FALSE ){
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
        }
        
        if ( mempty($name) ){$this->response['response'] = "Masukkan nama part konten.";echo json_encode($this->response);exit;}
        if ( strlen($name) > 50 ){$this->response['response'] = "Maksimal panjang nama part konten adalah 50 karakter.";echo json_encode($this->response);exit;}
        
        $data = [
            "part_into"          => $part_into,
            "course_part_title"  => $name
        ];
        if ( $isnew ){
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by'] = $this->user->getId();
        }
        ($isnew) ? $this->sitemodel->insert("course_part", $data) : $this->sitemodel->update("course_part", $data, ["course_part_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data Course Part", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = ($isnew) ? "Berhasil menambahkan data." : "Berhasil merubah data.";
        echo json_encode($this->response);
        exit;
    }

    function edit()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $id = $this->input->post("id");
        $id = empty($id) ? "0" : $id;
        $cek = $this->mod->render($id);
        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $this->response['type'] = 'done';
        $this->response['response'] = $cek;
        echo json_encode($this->response);
        exit;
    }

    function remove()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $id = $this->input->post("id");
        $id = empty($id) ? "0" : $id;
        $query_sel = "";
        $cek = $this->mod->render($id);
        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $arr_cek = json_encode($cek);
        $query_sel = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;
        $data = [
            "status"    => "1"
        ];
        $this->sitemodel->update("course_part", $data, ["course_part_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data Course Part", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}