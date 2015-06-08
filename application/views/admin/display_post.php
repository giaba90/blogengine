<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}else{ ?>
    <div id="container">
        <h1>Welcome to the Post management!</h1>
<br>
        <a class="btn" href="<? echo base_url().'dashboard';?>"><i class="fa fa-angle-left"></i> Back </a>
        <a class="btn save" href="<? echo base_url().'dashboard/post/new_post';?>"><i class="fa fa-plus"></i> New Post </a>
<br>
        <?php echo $this->session->flashdata('message'); ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
    <?php foreach ($posts as $post) : ?>
            <tr>
                <td><a class="btn" href="<? echo base_url().'dashboard/editpost/'.$post['post_id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
                <td><?php echo $post['post_id']; ?></td>
                <td><?php echo $post['post_title']; ?></td>
                <td><a class="btn delete" href="<? echo base_url().'dashboard/deletepost/'.$post['post_id'];?>"><i class="fa fa-trash-o"></i></a></td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<? } ?>