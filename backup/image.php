<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('upload_model');
        $this->load->helper(array('form','url'));
        $config['upload_path'] = realpath(APPPATH.'../upload');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']	= '204800';
        $config['overwrite'] = FALSE;


        $this->load->library('upload', $config);
    }

    public function index(){
        $this->load->view('templates/admin/header');
        $this->load->view('/admin/upload_form',array('error' => ' ' ));
        $this->load->view('templates/admin/footer');
    }

    public function do_upload(){

        if ( ! $this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            foreach ($error as $item => $value){
                echo'<ol class="alert alert-danger"><li>'.$value.'</ol></li>';
            }
            exit;
        }
        else {
            $upload_data = array('upload_data' => $this->upload->data());
            foreach ($upload_data as $key=> $value){

                $image =  $value['file_name'];
                $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['file_name']);
                $data = array(
                    'path' => $image,
                    'name'=>$name
                );
                $this->db->insert('gallery', $data);
            }

            echo'<h4 style="color:green">Image uploaded Succesfully</h4>';
            // exit;

        }

    }

    public function fillGallery(){
        $uploadpath = base_url().'upload/';
        $rs = $this->db->get('gallery');
        foreach ($rs->result() as $row) {
            $src= $uploadpath.$row->path;
            $alt = $row->name;
            $lid = $row->id.'g';
            echo "<li class='thumbnail' id='$lid'>
                            <span id='$row->id' class='btn btn-info btn-block btn-delete'><i class='glyphicon glyphicon-remove'></i>&nbsp;&nbsp;&nbsp;Delete</span>
                            <img src='$src' alt='$alt' style='height: 150px; width: 150px'>
                                <span class='btn btn-warning btn-block'>$alt</span></li>";

        }
    }

    public function deleteimg(){
        $id = $this->input->post('id');
        //select path from db
        $this->db->select('path');
        $query = $this->db->get_where('gallery',array('id'=>$id));
        $row = $query->row();
        $uploadpath = realpath(APPPATH.'../upload');
        $src = $uploadpath.'/'.$row->path;
        unlink($src);
        //also delete it from the database
        $this->db->where('id', $id);
        $this->db->delete('gallery');

        echo'<h4 style="color:green">This image deleted successfully</h4>';
        //    exit;

    }

}
