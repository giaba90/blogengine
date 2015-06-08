<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}else{ ?>
<div id="container">
<div class="row">
    <div class="col-sm-6">
        <? echo form_open('dashboard/createcategory', array('id' => 'post_form','class' => '')); ?>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="form-group">
            <?php echo form_label('Title','title',array('class' => ''));?>
            <?php echo form_error('title');?>
            <input type="text" id="title" name="title" class="form-control " value="<? echo set_value('title'); ?>">
        </div>
        <div class="form-group">
            <?php echo form_label('Description','description',array('class' => ''));?>
            <?php echo form_error('description'); ?><br>
            <textarea id="description" name="description"></textarea>
        </div>
        <a class="btn" href="<? echo base_url().'dashboard';?>"><i class="fa fa-angle-left"></i> Back </a>
        <button type="submit" class="btn save"><i class="fa fa-floppy-o"></i> Save</button>
        <? echo form_close(); ?>
    </div>
    <div class="col-sm-6">
        <ul class="list-group">
    <? foreach ($categories as $cat) : ?>
            <li class="list-group-item"><? echo $cat['name_category']; ?><a href="<? echo base_url().'dashboard/deletecategory/'.$cat['id_category'];?>"> <span class="badge">X</span></a></li>
        <? endforeach ?>
        </ul>
    </div>
</div>
</div>
<? } ?>