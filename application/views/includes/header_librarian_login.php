<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url();?>'css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
  
        <link rel="stylesheet" type='text/css' href="<?php echo base_url('css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" type='text/css'href="<?php echo base_url('css/bootstrap.css');?>">
       <link rel="stylesheet" type='text/css'href="<?php echo base_url('css/main_login.css');?>">
        <link rel="stylesheet" type='text/css'href="<?php echo base_url('css/template.css');?>">

       <script src="<?php echo base_url('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>
        
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experiensce.</p>
        <![endif]-->
    <div class="navbar-fixed-top" id="test2">
      <div class="container">
        <div class="navbar-header" id="nav-bar">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="<?php echo base_url('logo.png');?>" width="150" height="45" id="logo"></a>
		  
		 <!---start>
		  <!-- Collect the nav links, forms, and other content for toggling -->
			<div id="nav-in">
        
          <div class="navbar-collapse collapse">
            <ul class="nav nav-pills">
              <li class="active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> name_of_librarian <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">View Profile</a></li>
                  <li><a href="#">View Student/Faculty</a></li>
                   <li><a href="<?=base_url().'index.php/librarian/search_reference_index'?>">Search References</a></li>
                    <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Add Reference</a>
                    <ul class="dropdown-menu">
                     <li> <a tabindex="-1" href="<?= site_url('librarian/add_reference') ?>">Fill Up Add Reference Form</a></li>
                     <li><a tabindex="-1" href="<?= site_url('librarian/file_upload') ?>">File Upload</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=base_url().'index.php/librarian/view_report_index'?>">Generate Report</a></li>
                  <li><a href="<?=base_url().'index.php/logout'?>">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>     
      </div>
		
        </div>
      </div>
    </div>





<!--
<html>
	<head>
		<title><?=$title?></title>
		
	</head>
	<body>

	<div>
		<?php if($this->session->userdata('loggedIn')){ ?>
			Hi <?=$this->session->userdata('username')?>!
			<br/>
			<a href="<?=base_url().'index.php/logout'?>">
				<button>Logout</button>
			</a>
		<?php }else{ ?>
			<form action="<?=base_url().'index.php/login'?>" method='post'>
				Username: <input type='text' name='username' required/>
				Password: <input type='password' name='password' required/>
				<input type='submit' name='submit' value='submit'/>
			</form>
		<?php } ?>
	</div>

-->
