<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/header') ?>
<body class="bg">
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <a href="#">
                <img class="img-responsive margin" src="<?php echo base_url().'assets/img/logo.png';?>">
            </a>
            <div class="form-content">
                <?php echo $this->session->flashdata('message');?>
                <?php echo form_open('',array('id'=>'login_form'));?>
                <div class="form-group">
                    <?php echo form_label('Username','identity');?>
                    <?php echo form_error('identity');?>
                    <?php $data = array(
                        'name'        => 'identity',
                        'placeholder' => 'Username',
                        'class' => 'form-control'
                    );?>
                    <?php echo form_input($data,'');?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Password','password');?>
                    <?php echo form_error('password');?>
                    <?php $data = array(
                        'name'        => 'password',
                        'placeholder' => 'Passowrd',
                        'class' => 'form-control'
                    );?>
                    <?php echo form_password($data,'');?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo form_checkbox('remember','1',FALSE);?> Remember me
                    </label>
                </div>
                <? $data = array(
                'class' => 'btn-lg btn-block',
                'type' => 'submit',
                'content' => 'LOGIN'
                );
                echo form_button($data); ?>
                <?php echo form_close();?>
            </div>
            <!-- /form-content -->
            <div class="footer2">
                <a href="<? echo site_url('/'); ?>"><i class="fa fa-arrow-left"></i> Back to your website</a>
                <br>
                <br>
                <br>
                <p>Copyleft &copy; 2015 - Developed by <a href="http://www.gianlucabarranca.it">Gianluca Barranca</a></p>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
</script>

<script src="<?php echo base_url().'assets/js/vendor/bootstrap.min.js';?>"></script>

<script src="<?php echo base_url().'assets/js/main.js';?>"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
</body>

</html>