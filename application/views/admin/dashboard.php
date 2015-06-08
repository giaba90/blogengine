<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}else{ ?>
<div class="container">
    <h1>Welcome to the Dashboard!</h1>
    <div class="row">
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('');?>'" class="" >Home</button>
        </div> <!-- col sx -->
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('dashboard');?>/post';" class="" >Post</button>
        </div> <!-- col dx -->
    </div> <!-- first row -->
    <div class="row">
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('dashboard');?>/category';" class="" >Category</button>
        </div> <!-- col sx -->
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('dashboard');?>/users';" class="" >Users</button>
        </div> <!-- col dx -->
    </div> <!-- second row -->
    <div class="row">
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('dashboard');?>/media'" class="" >Media</button>
        </div> <!-- col sx -->
        <div class="col-md-6">
            <button onclick="location.href = '<? echo base_url('logout');?>'" id="myButton" class="" >Logout</button>
        </div> <!-- col dx -->
    </div> <!-- third row -->

</div>
<? } ?>