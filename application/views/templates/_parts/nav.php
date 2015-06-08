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
        <?php if(!$this->ion_auth->logged_in()){?>
        <a href="#">
            <li><i class="fa fa-home"></i> HOME</li>
        </a>
        <?php
        }else{ ?>
            <a href="dashboard">
                <li><i class="fa fa-tachometer"></i> DASHBOARD</li>
            </a>
        <?php } ?>
        <a href="#">
            <li><i class="fa fa-book"></i> FAQ</li>
        </a>
        <a href="#">
            <li><i class="fa fa-github"></i> GITHUB</li>
        </a>
        <?php if(!$this->ion_auth->logged_in()){?>
        <a href="login">
            <li><i class="fa fa-sign-in"></i> LOGIN</li>
        </a>
        <?php
        }else{ ?>
        <a href="logout">
            <li><i class="fa fa-sign-out"></i> LOGOUT</li>
        </a>
<?php } ?>
    </ul>
</div>