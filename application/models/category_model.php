<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Insert new category in the table Category
     * @param $name of category
     * @return bool
     */
    public function insert($name, $desc = NULL){
        $data = array(
            'name_category'=>$name,
            'description_category' =>$desc
        );
        $this->db->insert('Category',$data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE ;

    }

    public function delete($id){
        $tables = array('Category', 'Post_to_Category');
        $this->db->where('id_category', $id);
        $this->db->delete($tables);
    }

    /**
     * Get all category from table Category
     * @return mixed array with id & category name
     */
    public function get_categories(){
        $this->db->select('*')->from('Category');
        $query=$this->db->get();
        return $query->result_array();
    }

    /**
     * Get category by id
     * @param $category_id
     * @return name of category
     */
    public function get_category_by_id($category_id){
        $this->db->select('name_category')->from('Category')->where('id_category',$category_id);
        $query = $this->db->get();
        $row = $query->row();
        return $row->name_category;
    }

    /**
     * Get Category most used
     * @return mixed array with id & category name
     */
    public function get_most_used(){
        $this->db->select('id_category,category_name, COUNT(*) AS mostused')->from('Post_to_Category')
            ->group_by('id_category')->order_by('mostused','desc')->limit('2');
        $query=$this->db->get();
        return $query->result_array();
    }

    /**
     * Insert a row into table Post_to_Category
     * each row is a category of single post
     * @param $post_id
     * @param $category_id
     */
    public function insert_post_category($post_id,$category_id){
        $category_name = $this->get_category_by_id($category_id);

        $data = array(
            'post_id' => $post_id,
            'id_category'=> $category_id,
            'category_name' => $category_name
        );
        $this->db->insert('Post_to_Category',$data);
    }

    /**
     * Get all categories of a post
     * @param $post_id
     * @return mixed
     */
    public function get_category_post($post_id){
        $this->db->select('category_name')->from('Post_to_Category')->where('post_id',$post_id);
        $query=$this->db->get();
        return $query->result_array();
    }
}