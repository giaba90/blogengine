<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation','category'));
        $this->load->helper(array('form','url'));
        $this->load->model('post_model');
    }

    public function index()
    {
        $data['title'] = 'Welcome to the Dashboard'; // Capitalize the first letter
        $this->load->view('templates/_parts/header', $data);
        $this->load->view('templates/admin/nav', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/_parts/footer', $data);
    }

    public function display_post(){
        $data['posts'] = $this->post_model->get_all_posts($this->post_model->count(),0);
        $this->view('display_post',$data);

    }

    public function display_category(){
        $data['categories'] = $this->category->get_category();
        $this->view('display_category',$data);
    }

    public function create_post(){
        //set validation rule
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[200]');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

        if($this->form_validation->run() == TRUE){ // validation has been passed
            //insert into database
            $post_id =  $this->post_model->insert_post($this->input->post('title'),$this->input->post('content'));
          if( isset($post_id) ){
             //if new post inserted successfully
             // add a category for the post
              $checkbox = $this->input->post('checkbox'); //take all categories checked
              if($checkbox){ //if user check category box
                  foreach($checkbox as $cat){ //insert category into table
                      $this->category->insert_category($post_id,$cat);
                  }
              }//else do nothing because the user has chosen not to enter the category
              unset($checkbox);//flush var
              $this->session->set_flashdata('message','Post inserted successfully');
              redirect('dashboard/post/new_post', 'refresh');

          }else{
            //If there was an error when you tried to insert a new post
            //set the flash data error message if there is one
              $this->session->set_flashdata('message', 'Error inserting post');
              redirect('dashboard/post/new_post', 'refresh');
          }

        }else{ // validation has not been passed refresh the view
           $this->view('new_post','');

        }

    }

    public function edit_post($id){
        $data['post'] = $this->post_model->get_by_id($id);
        $this->view('edit_post', $data);
    }

    public function update_post()
    {
        //set validation rule
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[200]');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

        if ($this->form_validation->run() == TRUE) { // validation has been passed
            //update the table
            $data_input = array(
                "id" => $this->input->post('id_post'),
                "title" =>  $this->input->post('title'),
                "content" => $this->input->post('content')
            ); //return true if it's all ok
            $success = $this->post_model->update_post($data_input);
            if ($success) {
                //redirect to a view of single post
                $data['post'] = $this->post_model->get_by_id($data_input['id']);
                redirect('/'.$data['post']['post_slug'],'refresh');
            } else {
                //If there was an error when you tried to update post
                //set the flash data error message if there is one
                $this->session->set_flashdata('message', 'Errore aggiornamento post');
                redirect('dashboard/editpost/'.$this->input->post('id_post'), 'refresh');
            }
        } else { // validation has not been passed, refresh the view
            $data['post'] = array(
                'post_id' => $this->input->post('id_post'),
                'post_title' => $this->input->post('title'),
                'post_content' => $this->input->post('content')
            );
            $this->view('edit_post', $data);
        }
    }

    public function delete_post($id){
        $this->post_model->delete_post($id);
        $this->display_post();
    }

    public function create_category(){
        //set validation rule
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[200]');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE) { // validation has been passed
            //insert category in the table
            $name = $this->input->post('title');
            $desc = $this->input->post('description');
            $success = $this->category->insert($name,$desc);
            if($success){
                $this->display_category();
            }
            else{//insert failed, display an error message
                $this->session->set_flashdata('message', 'Errore inserimento categoria');
                $this->display_category();
            }
        }
        else{// validation has not been passed, refresh the view
            $this->display_category();
        }
    }

    public function delete_category($id){
        $this->category->delete($id);
        $this->display_category();
    }

    /**
     * Display a single view of Dashboard
     * @param $view name of view to display
     * return 404 page if the view does not exit
     */
    public function view($view,$data=NULL)
    {
        if ( ! file_exists(APPPATH.'/views/admin/'.$view.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = 'Dashboard'; // Capitalize the first letter

        $this->load->view('templates/admin/header', $data);
        $this->load->view('/admin/'.$view, $data);
        $this->load->view('templates/admin/footer');
    }
}
/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */