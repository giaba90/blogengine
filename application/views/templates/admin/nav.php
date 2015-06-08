<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<header>
    <a href="#">
        <img class="img-responsive my_img" src="<?php echo base_url().'assets/img/logo.png';?>">
    </a>
    <button data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content=" Menu " class="open_menu"><i class="fa fa-bars"></i>
    </button>
    <button class="close_menu"><i class="fa fa-times"></i>
    </button>
</header>

<div class="menu">
    <ul>
        <a href="<?php echo base_url('/'); ?>">
            <li><i class="fa fa-home"></i> HOME</li>
        </a>
        <a href="#">
            <li><i class="fa fa-users"></i> USERS</li>
        </a>
        <a href="#">
            <li><i class="fa fa-info"></i> INFO</li>
        </a>
            <a href="<?php echo base_url('/').'logout'; ?>">
                <li><i class="fa fa-sign-out"></i> LOGOUT</li>
            </a>
    </ul>
</div>