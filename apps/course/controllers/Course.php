<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps - Restaurant
* @Type         : Controller
* @Date Create	: 17 May 2021
*
***/
class Course extends SITE_Controller
{
    private $page_curr = "";
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "course";
        $this->page_curr = "course";
        $this->load->model("course_model", "mod");
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
            base_url("assets/js/course/course").",".ENVIRONMENT.",1.3",
            base_url("assets/js/default").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']         = $this->mod->render();
        $this->fragment['page_nav']     = "course";
        $this->fragment['page_title']   = "Course - Management";
        $this->fragment['page_curr']    = $this->page_curr;
        $this->fragment['pagename']     = "index";
        $this->load->view("main-site", $this->fragment);
    }
    function forms()
    {
        if ( !$this->hasLogin() )redirect("auth/signin");
        $id = "";
        if ( $_GET )
        {
            $id = $this->input->get("id");
            $cek = $this->mod->render($id);
            if ( !$cek ) redirect($this->page_curr);
            $this->fragment['data']                          = $cek;
            $this->fragment['data_course_detail_part_satu']  = $this->mod->render_course_detail_part_satu($id);
            $this->fragment['data_course_detail_part_dua']   = $this->mod->render_course_detail_part_dua($id);
            $this->fragment['data_course_detail_part_tiga']  = $this->mod->render_course_detail_part_tiga($id);
            // $this->fragment['data_certificate'] = $this->mod->render_certificate($id);
            // echo $cek;
        }
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
            "text/css,stylesheet,".base_url("assets/plugins/select2/select2.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/plugins/select2/select2").",min,1.0.0",
            base_url("assets/plugins/jQuery-Plugin-For-Number-Input-Formatting-Mask-Number/dist/jquery.masknumber").",".ENVIRONMENT.",1.1",
            base_url("assets/js/course/course-form").",".ENVIRONMENT.",1.1",
            base_url("assets/js/view_image").",".ENVIRONMENT.",1.1",
            // base_url("assets/plugins/ckeditor/ckeditor").",".ENVIRONMENT.",1.1",
        ];
        $this->fragment['data_course']              = $this->mod->render();
        $this->fragment['data_course_category']     = $this->mod->render_course_category();
        $this->fragment['data_course_detail']       = $this->mod->render_course_detail();
        $this->fragment['data_course_part']         = $this->mod->render_course_part();
        $this->fragment['data_course_part_satu']    = $this->mod->render_course_part_satu();
        $this->fragment['data_course_part_dua']     = $this->mod->render_course_part_dua();
        $this->fragment['data_course_part_tiga']    = $this->mod->render_course_part_tiga();
        // $this->fragment['page_nav']     = "maps::news";
        $this->fragment['page_title']           = "Course - Forms";
        $this->fragment['page_curr']            = $this->page_curr;
        $this->fragment['pagename']             = "forms";
        $this->load->view("main-site", $this->fragment);
    }
    function forms_save()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $isnew              = TRUE;
        $userid             = $this->user->getId();
        $query_sel          = "";
        $id                 = $this->input->post("id");
        $course_category    = $this->input->post("course_category"); #REQUIRED
        $course_title       = $this->input->post("course_title"); #REQUIRED
        $price              = str_replace('.','',$this->input->post("price")); #REQUIRED
        $duration           = $this->input->post("duration"); #REQUIRED
        $course_desc        = $this->input->post("course_desc"); #REQUIRED
        $author_name        = $this->input->post("author_name");

        // print_r(var_dump((int)$price));die();
        //COURSE CONTENT 
        $course_part_id_satu             = $this->input->post("course_part_satu");
        $content_link_title_content_satu = $this->input->post("content_link_title_name_satu");
        $course_link_content_satu        = $this->input->post("content_link_name_satu");

        $course_part_id_dua             = $this->input->post("course_part_dua");
        $content_link_title_content_dua = $this->input->post("content_link_title_name_dua");
        $course_link_content_dua        = $this->input->post("content_link_name_dua");

        $course_part_id_tiga             = $this->input->post("course_part_tiga");
        $content_link_title_content_tiga = $this->input->post("content_link_title_name_tiga");
        $course_link_content_tiga        = $this->input->post("content_link_name_tiga");

        // print_r($this->input->post());die();
        // $desc       = preg_replace('!\s+!', ' ', $desc);

        $filenameCourse   = "";
        $old_fnameCourse  = "";
        $filenameAuthor   = "";
        $old_fnameAuthor  = "";
        $allowed_ext= ["jpg", "jpeg"];
        
        if ( mempty($id) == FALSE )
        {
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
            $old_fnameCourse = $cek[0]->imgUrl;
            $old_fnameAuthor = $cek[0]->authorImg;
        }
        if ( mempty($course_title) ){$this->response['response'] = "Masukkan Judul.";echo json_encode($this->response);exit;}
        // if ( strlen($title) > 75 ){$this->response['response'] = "Maksimal panjang judul adalah 75 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($course_desc) ){$this->response['response'] = "Masukkan deskripsi.";echo json_encode($this->response);exit;}
        // if ( strlen($desc) > 200 ){$this->response['response'] = "Maksimal panjang deskripsi adalah 200 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($address) ){$this->response['response'] = "Masukkan alamat.";echo json_encode($this->response);exit;}
        // if ( strlen($address) > 200) {$this->response['response'] = "Maksimal panjang alamat adalah 200 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($duration) ){$this->response['response'] = "Masukkan jam operasional.";echo json_encode($this->response);exit;}
        // if ( strlen($duration) > 20) {$this->response['response'] = "Maksimal panjang jam operasional adalah 20 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($website) == FALSE ){if (strlen($website) > 100){$this->response['response'] = "Maksimal panjang nama website adalah 100 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($phone1) == FALSE ){if (strlen($phone1) > 20){$this->response['response'] = "Maksimal panjang Telepon 1 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($phone2) == FALSE ){if (strlen($phone2) > 20){$this->response['response'] = "Maksimal panjang Telepon 2 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($latitude) ){$this->response['response'] = "Masukkan latitude";echo json_encode($this->response);exit;}
        // if ( strlen($latitude) > 100 ){$this->response['response'] = "Maksimal panjang latitude adalah 100 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($longitude) ){$this->response['response'] = "Masukkan longitude";echo json_encode($this->response);exit;}
        // if ( strlen($longitude) > 100 ){$this->response['response'] = "Maksimal panjang longitude adalah 100 karakter.";echo json_encode($this->response);exit;}

        #NANTI RUBAH LOKASI PATH
        if ( isset($_FILES['course_photo']['name']) and empty($_FILES['course_photo']['name']) == FALSE ):
            $target_dir_course = "./../assets_agro/course";
            $target_file_course = $target_dir_course . "/" . basename($_FILES["course_photo"]["name"]);
            $imageFileTypeCourse = strtolower(pathinfo($target_file_course,PATHINFO_EXTENSION));
            if ( !is_dir($target_dir_course) )
                mkdir($target_dir_course, 0777, true);
            else
                chmod($target_dir_course, 0777);
            if ( $_FILES['course_photo']['size'] > (200*1024) ){$this->response['response'] = "Maksimal file size adalah 200 Kb.";echo json_encode($this->response);exit;}
            if ( !in_array($imageFileTypeCourse, $allowed_ext) ){$this->response['type'] = 'gagal'; $this->response['response'] = "Hanya menerima file dengan ekstensi ".implode(", ", $allowed_ext).".";echo json_encode($this->response);exit;}
            
            $temp_name_course = strtolower( preg_replace("/(\W)+/", "-", $course_title) ).'-'.strtolower( preg_replace("/(\W)+/", "-", basename($_FILES["course_photo"]["name"], ".".$imageFileTypeCourse) ) ).'-'.time();
            $filenameCourse = $temp_name_course . "." . $imageFileTypeCourse;
            $fileuploadCourse = $target_dir_course."/".$filenameCourse;
            if ( file_exists($fileuploadCourse) ){$this->response['response'] = "Nama file sudah ada.";echo json_encode($this->response);exit;}
            move_uploaded_file($_FILES['course_photo']['tmp_name'], $fileuploadCourse);
            chmod($target_dir_course, 0755);
        endif;

         #NANTI RUBAH LOKASI PATH
         if ( isset($_FILES['author_photo']['name']) and empty($_FILES['author_photo']['name']) == FALSE ):
            $target_dir_author = "./../assets_agro/author";
            $target_file_author = $target_dir_author . "/" . basename($_FILES["author_photo"]["name"]);
            $imageFileTypeAuthor = strtolower(pathinfo($target_file_author,PATHINFO_EXTENSION));
            if ( !is_dir($target_dir_author) )
                mkdir($target_dir_author, 0777, true);
            else
                chmod($target_dir_author, 0777);
            if ( $_FILES['author_photo']['size'] > (200*1024) ){$this->response['response'] = "Maksimal file size adalah 200 Kb.";echo json_encode($this->response);exit;}
            if ( !in_array($imageFileTypeAuthor, $allowed_ext) ){$this->response['type'] = 'gagal'; $this->response['response'] = "Hanya menerima file dengan ekstensi ".implode(", ", $allowed_ext).".";echo json_encode($this->response);exit;}
            
            $temp_name_author = strtolower( preg_replace("/(\W)+/", "-", $author_name) ).'-'.strtolower( preg_replace("/(\W)+/", "-", basename($_FILES["author_photo"]["name"], ".".$imageFileTypeAuthor) ) ).'-'.time();
            $filenameAuthor = $temp_name_author . "." . $imageFileTypeAuthor;
            $fileuploadAuthor = $target_dir_author."/".$filenameAuthor;
            if ( file_exists($fileuploadAuthor) ){$this->response['response'] = "Nama file sudah ada.";echo json_encode($this->response);exit;}
            move_uploaded_file($_FILES['author_photo']['tmp_name'], $fileuploadAuthor);
            chmod($target_dir_author, 0755);
        endif;

        $data = [
            "idCategory"        => $course_category,
            "authorName"        => $author_name,
            "authorCourses"     => "",
            "price"             => (int)$price,
            "courseTitle"       => $course_title,
            "courseDesc"        => $course_desc,
            "duration"          => $duration,
            "created_at"        => date("Y-m-d H:i:s"),
            "created_by"       => $this->user->getId(),
        ];
        if ( mempty($filenameCourse) == FALSE OR mempty($filenameAuthor))
        {
            $data['imgUrl']      = $filenameCourse;
            $data['authorImg']   = $filenameAuthor;
        }
        
        if ( $isnew )
        {
            $data['created_at']  = date("Y-m-d H:i:s");
            $data['created_by'] = $this->user->getId();
            // print_r($data);die();
            $id = $this->sitemodel->insertid("course", $data);
        }
        else
        {
            // $data['updated_at'] = date("Y-m-d H:i:s");
            $this->sitemodel->update("course", $data, ["id"=>$id]);
        }

        #Delete Certificate Data based on Map ID and recreate the data based on Input
        $this->sitemodel->delete("course_detail", ["course_id" => $id]);
        if ( empty($content_link_title_content_satu) == FALSE )
        {
            for($i = 0; $i < count($content_link_title_content_satu); $i++):
            
                #If Empty then get data from old data (case of edit)

                if ( mempty($content_link_title_content_satu[$i]) == FALSE):
                    for($a = 0; $a < count($course_part_id_satu); $a++):
                        $data_course = [
                            "course_id"             => $id,
                            "course_part_id"        => (int)$course_part_id_satu[$a],
                            "course_title_content"  => $content_link_title_content_satu[$i],
                            "course_link_content"   => $course_link_content_satu[$i],
                            "created_by"            => $userid,
                            "created_at"            => date("Y-m-d H:i:s")
                        ];
                        $this->sitemodel->insert("course_detail", $data_course);
                    endfor;
                    
                    // var_dump($data_course);die();
                endif;

            endfor;

            for($i = 0; $i < count($content_link_title_content_dua); $i++):
            
                #If Empty then get data from old data (case of edit)

                if ( mempty($content_link_title_content_dua[$i]) == FALSE):
                    for($b = 0; $b < count($course_part_id_dua); $b++):
                        $data_course = [
                            "course_id"             => $id,
                            "course_part_id"        => (int)$course_part_id_dua[$b],
                            "course_title_content"  => $content_link_title_content_dua[$i],
                            "course_link_content"   => $course_link_content_dua[$i],
                            "created_by"            => $userid,
                            "created_at"            => date("Y-m-d H:i:s")
                        ];
                        // var_dump($data_course);die();
                        $this->sitemodel->insert("course_detail", $data_course);
                    endfor;
                endif;

            endfor;

            for($i = 0; $i < count($content_link_title_content_tiga); $i++):
            
                #If Empty then get data from old data (case of edit)

                if ( mempty($content_link_title_content_tiga[$i]) == FALSE):
                    for($b = 0; $b < count($course_part_id_tiga); $b++):
                        $data_course = [
                            "course_id"             => $id,
                            "course_part_id"        => (int)$course_part_id_tiga[$b],
                            "course_title_content"  => $content_link_title_content_tiga[$i],
                            "course_link_content"   => $course_link_content_tiga[$i],
                            "created_by"            => $userid,
                            "created_at"            => date("Y-m-d H:i:s")
                        ];
                        // var_dump($data_course);die();
                        $this->sitemodel->insert("course_detail", $data_course);
                    endfor;
                endif;

            endfor;
        }

        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();

        $this->response['type'] = 'done';
        $this->response['response'] = ($isnew) ? "Berhasil menambahkan data." : "Berhasil merubah data.";
        $this->response['uri'] = base_url($this->page_curr);
        echo json_encode($this->response);
        exit;
    }

    function view_detail()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        
        $id                         = $this->input->post("id");
        $id                         = empty($id) ? "0" : $id;
        $cek                        = $this->mod->render($id);


        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $this->response['type']                   = 'done';
        $this->response['data_news']               = $cek;
        echo json_encode($this->response);
        exit;
    }

    function remove()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        
        $id         = $this->input->post("id");
        $id         = empty($id) ? "0" : $id;
        $query_sel  = "";
        $cek        = $this->mod->render($id);

        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
       
        $arr_cek    = json_encode($cek);
        $query_sel  = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;

        $data = [
            "status"     => "1"
        ];

        $this->sitemodel->update("course", $data, ["id"=>$id]);
        #Save to Logger
        $last_query  = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();

        $this->logger->setLogger("input", "Data Course", $last_query);
        $this->response['type']     = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}