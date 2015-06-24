<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('upload_model');
        $this->load->helper(array('form', 'url'));
        $config['upload_path'] = realpath(APPPATH . '../upload');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '204800';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
    }

    public function index()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('/admin/display_media', array('error' => ' '));
        $this->load->view('templates/admin/footer');
    }

    public function do_upload()
    {
        $uploadpath = base_url() . 'upload/';
        // we retrieve the number of files that were uploaded
        $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
        // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
        $files = $_FILES['uploadedimages'];
        $uploaded = array();
        // now, taking into account that there can be more than one file, for each file we will have to do the upload
        for ($i = 0; $i < $number_of_files; $i++) {
            $_FILES['uploadedimage']['name'] = $files['name'][$i];
            $_FILES['uploadedimage']['type'] = $files['type'][$i];
            $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['uploadedimage']['error'] = $files['error'][$i];
            $_FILES['uploadedimage']['size'] = $files['size'][$i];

            if ($this->upload->do_upload('uploadedimage')) {
                $uploaded[$i] = $this->upload->data();

                $image = $uploaded[$i]['client_name'];
                $name = $uploaded[$i]['raw_name'];
                $this->upload_model->insert($image, $name);
                //echo "<h4 style='color:green'>Image uploaded Succesfully</h4>";
                echo "<input type='text' class='' id='id_image' name='id_image'
                                         value='$uploadpath.$image'   readonly>
                                         <span class='pull-right'><b>Nome file:</b> $image</span> <br>";
            } else {
                $error = array('error' => $this->upload->display_errors());
                foreach ($error as $item => $value) {
                    echo '<ol class="alert alert-danger"><li>' . $value . '</li></ol>';
                }

            }
        }
    }

    public function fillGallery()
    {
        $uploadpath = base_url() . 'upload/';
        $rs = $this->upload_model->get_image_from_db();
        $html ="<div class='grid-sizer'></div>";
        foreach ($rs as $row) {
            $src = $uploadpath.$row['path'];
            $alt = $row['name'];
            $date = $row['data'];
            $id_foto = $row['id'];
            $html = $html."<div class='grid-item'>
            <img id='$id_foto' src='$src' alt='$alt' data-toggle='modal' data-target='#imageModal' data-whatever='$id_foto'>
            <p class='name'>$alt</p>
            <p class='date'>$date</p>
            </div>";

        }
        echo $html;
    }

    public function deleteimg()
    {
        $uploadpath = realpath(APPPATH . '../upload');
        $id = $this->input->post('id');
        //select path from db
        $path = $this->upload_model->get_path($id);
        $src = $uploadpath . '/' . $path;
        unlink($src);
        //also delete it from the database
        $this->upload_model->delete($id);
        echo '<h4 style="color:green">This image deleted successfully</h4>';

    }

    public function get_info(){
        $uploadpath = base_url() . 'upload/';
        $id = $this->input->post('id');
        $image = $this->upload_model->get_info_by_id($id);
        $src = $uploadpath.$image->path;
        $alt = $image->name;
     echo  "<div class='container-fluid'>
          <div class='row'>
            <div class='col-md-4'><img src='$src' alt='$alt' style='height: 150px; width: 150px'></div>
            <div class='col-md-8'>
            <span>Nome file: $image->path</span><br>
            <span>Titolo: $image->name</span><br>
            <span>Url: </span><input type='text' class='' id='id_image' name='id_image' value='$src' readonly><br>
            <a href='$src'> Visualizza immagine</a> <span class='deleteimage' style='color: red'> Cancella definitivamente</span>
            </div>
            </div>
          </div>";
    }
}
