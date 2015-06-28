<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('cookie');
    }

    /**
     *
     * @param $title (String) title of post
     * @param $content (String) content of post
     * @return bool
     */
    public function insert_post($title, $content)
    {

        $post_author = $this->session->userdata('user_id');

        $date = new DateTime('now');
        $date = date_format($date, 'Y-m-d H:i:s');

        $slug = strtolower($title);
        $slug = str_ireplace(array("'", '?', '!', " "), '-', $slug);

        $data = array(
            'post_date' => $date,
            'post_title' => $title,
            'post_slug' => $slug,
            'post_content' => $content,
            'post_author' => $post_author
        );
        $this->db->insert('Posts', $data);

        if ($this->db->affected_rows() > 0) {
            $post_id = $this->db->insert_id();
        }
        return $post_id;
    }

    /**
     * @param $post_id
     * @param $post_title
     * @param $post_content
     * @return bool return true if the post was updated successfully
     */
    public function update_post($array)
    {
        //Recreate the slug and update
        $slug = strtolower($array['title']);
        $slug = str_ireplace(array("'", '?', '!', " "), '-', $slug);

        $data = array(
            'post_title' => $array['title'],
            'post_slug' => $slug,
            'post_content' => $array['content']
        );

        $this->db->where('post_id', $array['id']);
        $this->db->update('Posts', $data);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    /**
     * Update the author by setting it to 1 = admin
     * @param $post_id of the post you want to update
     */
    public function update_author($post_id)
    {

        $data = array(
            'post_author' => 1
        );

        $this->db->where('post_id', $post_id);
        $this->db->update('Posts', $data);
    }

    /**
     * @param $id of post to delete
     */
    public function delete_post($id)
    {
        $tables = array('Posts', 'Post_to_Category');
        $this->db->where('post_id', $id);
        $this->db->delete($tables);
    }

    /**
     * @param $limit number of post display for page
     * @param $start number
     * @param bool $display_name this is a var which i have used for choice if display or no the name of author's post
     * @return mixed list of all posts present on table Posts of database
     */
    public function get_all_posts($limit = FALSE, $start = FALSE, $display_name = FALSE)
    {
        if ($display_name) {
            $this->db->select("*,DATE_FORMAT(post_date, '%b %d %Y') as date", FALSE)->from('Posts')
                ->join('users', 'Posts.post_author = users.id')->order_by("post_date", "desc")->limit($limit, $start);
        } else {
            $this->db->select("*,DATE_FORMAT(post_date, '%b %d %Y') as date", FALSE)->from('Posts')
                ->order_by("post_date", "desc")->limit($limit, $start);

        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * @param $id id of post
     * @return mixed returns an array with title & content
     * of the post that matches with the id
     */
    public function  get_by_id($id)
    {
        $this->db->select('post_id,post_title,post_content,post_slug');
        $query = $this->db->get_where('Posts', array('post_id' => $id));
        //$query = $this->db->get();
        return $query->row_array();
    }

    /**
     * @param $slug (String) slug of post
     * @return mixed returns the post that matches the slug
     */
    public function get_by_slug($slug)
    {
        $this->db->select("*,DATE_FORMAT(post_date, '%b %d %Y') as date", FALSE)
            ->join('users', 'Posts.post_author = users.id');
        $query = $this->db->get_where('Posts', array('post_slug' => $slug));
        return $query->row_array();
    }

    /**
     * @param $id of author of post
     * @return mixed array with id of posts created by author with id = $id
     */
    public function get_by_author($id)
    {
        $this->db->select("post_id");
        $query = $this->db->get_where("Posts", array("post_author" => $id));
        return $query->row_array();
    }

    /**
     * @return (int) get numbers of post
     */
    public function count()
    {
        return $this->db->count_all("Posts");
    }

}
/* End of file post_model.php */
/* Location: ./application/models/post_model.php */