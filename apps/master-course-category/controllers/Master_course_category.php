<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Master_course_category extends SITE_Controller
{
    private $page_curr = "";
    function __construct()
    {
        parent::__construct();
        $this->fragment['site']['module'] = "master-course-category";
        $this->page_curr = "master-course-category";
        $this->load->model("master_course_category_model", "mod");
    }
    function index()
    {
        if ( !$this->hasLogin() )redirect("auth/signin");
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/master/courseCategory").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']             = $this->mod->render();
        $this->fragment['page_nav']         = "master::master-course-category";
        $this->fragment['page_title']       = "Data Course Category";
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
        $name       = $this->input->post("name", TRUE);
    
        $query_sel = "";
        if ( empty($id) == FALSE ){
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
        }
        
        if ( mempty($name) ){$this->response['response'] = "Masukkan nama kategori.";echo json_encode($this->response);exit;}
        if ( strlen($name) > 50 ){$this->response['response'] = "Maksimal panjang nama kategori adalah 50 karakter.";echo json_encode($this->response);exit;}
        
        $data = [
            "namaCategory"  => $name
        ];
        if ( $isnew ){
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by'] = $this->user->getId();
        }
        ($isnew) ? $this->sitemodel->insert("course_category", $data) : $this->sitemodel->update("course_category", $data, ["id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data Course Category", $last_query);
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
        $this->sitemodel->update("course_category", $data, ["id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data Course Category", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}