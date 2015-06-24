<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class upload_model extends CI_Model
{

    public function insert($image, $name)
    {

        $date = new DateTime('now');
        $date = date_format($date, 'Y-m-d H:i:s');

        $data = array(
            'name' => $name,
            'path' => $image,
            'data' => $date
        );
        $this->db->insert('gallery', $data);
    }

    public function delete($id)
    {
        $this->db->delete('gallery', array('id' => $id));
    }

    public function get_path($id)
    {
        $this->db->select('path');
        $query = $this->db->get_where('gallery', array('id' => $id));
        $row = $query->row();
        return $row->path;
    }

    public function get_image_from_db()
    {
        $this->db->select("*")->from('gallery');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_info_by_id($id){
        $this->db->select("*");
        $query = $this->db->get_where('gallery', array('id' => $id));
        return $row = $query->row();
    }

}
