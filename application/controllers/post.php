<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->library(array('pagination','ion_auth','category'));

    }

    /**
     * Display all post from db to index view
     * @param void
     * @return void
     */
    public function index()
    {
        $data['title'] = ucfirst('home'); // Capitalize the first letter
        $data['description'] = 'BE also know as Blog Engine built on Codeigniter Framework and used for micro-blogging website.';
        //config pagination
        $config = array();
        $config['base_url'] = base_url() . '/p/index';
        $config['total_rows'] = $this->post_model->count();
        $config['per_page'] = 4;
       // $config["uri_segment"] = 2;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['posts'] = $this->post_model->get_all_posts($config["per_page"], $page);
        $data['links'] = $this->pagination->create_links();
        $data['display_nome'] = FALSE; //choose if to display name or no

        $this->load->view('templates/_parts/header', $data);
        $this->load->view('templates/_parts/nav');
        $this->load->view('index', $data);
        $this->load->view('templates/_parts/footer');

    }
    /**
     * Display a single post from db to single view
     * @param string $slug slug of post
     */
    public function single($slug)
    {
        $data['post_item'] = $this->post_model->get_by_slug($slug);
        $data['title'] = $data['post_item']['post_title'];

        if (empty($data['post_item'])) { // If the post doesn't exit...
            show_404();
             }

        $this->load->view('templates/_parts/header',$data);
        $this->load->view('templates/_parts/nav');
        $this->load->view('post/single', $data);
        $this->load->view('templates/_parts/footer');
    }

    /**
     * Display a view of page
     * @param string $page
     */
    public function view($page = 'home')
    {
        if ( ! file_exists(APPPATH.'/views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/_parts/header', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/_parts/footer', $data);
    }

}
/* End of file post.php */
/* Location: ./application/controllers/post.php */