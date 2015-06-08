<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}else{
$categories = $this->category->get_category();
$categories_most_used = $this->category->get_most_used();
?>
<script type="text/javascript" src="<? echo base_url('/');?>assets/js/vendor/ckeditor/ckeditor.js"></script>
<div class="container">
    <div class="row">
        <?php echo form_open('dashboard/editpost', array('id' => 'post_form','class' => '')); ?>
        <div class="col-sm-6 col-sm-offset-2">
            <div class="form-box">
                <?php echo $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="id_post" class="label_form">ID</label>
                            <input type="text" class="form-control border-form-control" id="id_post" name="id_post"
                                   value="<?php echo set_value('id_post', $post['post_id']); ?>"   readonly>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="title" class="label_form">Title</label>
                            <?php echo form_error('title');?>
                            <input type="text" class="form-control border-form-control" id="title" name="title"
                                   value="<?php echo set_value('title', $post['post_title']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_error('content'); ?>
                    <textarea class="form-control" id="content" name="content"><?php echo $post['post_content']; ?></textarea>
                </div>

                <a class="btn" href="<? echo base_url().'dashboard/post';?>"><i class="fa fa-angle-left"></i> Back </a>
                <a class="btn delete" onclick="resetForm()"><i class="fa fa-trash-o"></i> Canc</a>
                <button type="submit" class="btn pull-right save"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="label_form">Category</label>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#allcategories">All Categories</a></li>
                        <li><a data-toggle="tab" href="#mostused">Most used</a></li>
                    </ul>
                    <!-- nav tabs -->
                    <div class="tab-content category-checkbox">
                        <div id="allcategories" class="tab-pane fade in active checkbox ">
                            <? foreach ($categories as $cat) : ?>
                                <label>
                                    <input name="checkbox[]" type="checkbox" value="<? echo $cat['id_category'];?>">
                                    <? echo $cat['name_category']; ?>
                                </label><br>
                            <? endforeach; ?>
                        </div>
                        <div id="mostused" class="tab-pane fade checkbox ">
                            <? foreach ($categories_most_used as $most_used) : ?>
                                <label>
                                    <input name="checkbox[]" type="checkbox" value="<? echo $most_used['id_category']; ?>">
                                    <? echo $most_used['category_name']; ?>
                                </label>
                                <br>
                            <? endforeach ?>
                        </div>
                    </div>   <!-- content tabs -->
                </div>
            </div>
        </div>  <!-- seconda colonna -->
        <script type="text/javascript">
            CKEDITOR.replace('content');
        </script>
        <?php echo form_close(); ?>
        <? } ?>
        <!-- /form-content -->
    </div>
</div>