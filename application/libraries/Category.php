<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category {

    public function __construct(){
        $this->be =& get_instance();
        $this->be->load->model('category_model');
    }

    public function insert($name, $desc){
        $result = $this->be->category_model->insert($name, $desc);
        return $result;
    }

    public function delete($id){
        $this->be->category_model->delete($id);
    }

    public function insert_category($post_id,$category_id){
        $this->be->category_model->insert_post_category($post_id,$category_id);
    }

    public function get_category(){
        $categories = $this->be->category_model->get_categories();
        return $categories;
    }

    public function get_most_used(){
        $categories = $this->be->category_model->get_most_used();
        return $categories;
    }

    public function get_category_post($post_id){
        $categories = $this->be->category_model->get_category_post($post_id);
        return $categories;
    }
}

/* End of file libraries/Category.php */