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

		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
		<style>
			body {
				padding-top: 50px;
				padding-bottom: 20px;
			}
		</style>
		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap-theme.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('css/template.css'); ?>">

		<script src="<?php echo base_url('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
	</head>
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
				<a class="navbar-brand" href="#">
					<img src="<?php echo base_url('logo.png'); ?>" width="150" height="45" id="logo">
				</a>

			<!-- Collect the nav links, forms, and other content for toggling -->
        <?php if($this->session->userdata('userType') == 'L') { ?>
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
		                            <li> <a href="<?= site_url('librarian/add_reference') ?>">Add Reference</a></li>
		                            <li><a href="<?= site_url('librarian/file_upload') ?>">File Upload</a></li>
		                        </ul>
		                    </li>
		                  	<li><a href="<?=base_url().'index.php/librarian/add_reference_index'?>">Add Reference</a></li>
		                  	<li><a href="<?=base_url().'index.php/librarian/view_report_index'?>">Generate Report</a></li>
		                  	<li><a href="<?=base_url().'index.php/logout'?>">Logout</a></li>
		                </ul>
	                </li>
	            </ul>
            </div>     
        </div>
        <?php }else if($this->session->userdata('userType') == 'S' || $this->session->userdata('userType') == 'F') { ?>
        <div id="nav-in">
            <div class="navbar-collapse collapse">
	            <ul class="nav nav-pills">
	              <li class="active">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->session->userdata('username')?><b class="caret"></b></a>
	                <ul class="dropdown-menu">
	                  <li><a href="<?=base_url().'index.php/borrower/view_borrower_profile_index'?>">View Profile</a></li>
	                  <li><a href="#">Search References</a></li>
	                  <li><a href="#">View Cart</a></li>
	                  <li><a href="<?=base_url().'index.php/logout'?>">Logout</a></li>
	                </ul>
	              </li>
	            </ul>
            </div>     
        </div>
        <?php }else{ ?>
		 	<div id="nav-in">
					<form class="navbar-form navbar-left nav-in-search" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
						<a href="#advanceSearch1"data-toggle="modal">
							<input type="submit" name="aSearch" class="btn btn-primary" value="Advanced Search"/>
						</a>
					</form>
					<div id="advanceSearch1" class="modal fade in" role="dialog">  
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">  
									<a class="close" data-dismiss="modal">&times;</a>
									<h4>Advanced Search</h4>  
								</div>
								<div class="modal-body">
									<form name="aSearch" method='post' class = 'form-horizontal' style = 'margin-bottom: 0px;'>
										<div class="row">
											<div class="col-lg-10">
												<div class="input-group">
													<div class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Category<span class="caret"></span></button>
														<ul class="dropdown-menu">
															<li><a href="#">Course Code</a></li>
															<li><a href="#">Title</a></li>
															<li><a href="#">Author</a></li>
															<li><a href="#">Publisher</a></li>
														</ul>
													</div><!-- /btn-group -->
													<input type="text" class="form-control">
												</div><!-- /input-group -->
											</div><!-- /.col-lg-10 -->
											<br/><br/>
											<div class="col-lg-10">
												<div class="input-group">
													<div class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Category<span class="caret"></span></button>
														<ul class="dropdown-menu">
															<li><a href="#">Course Code</a></li>
															<li><a href="#">Title</a></li>
															<li><a href="#">Author</a></li>
															<li><a href="#">Publisher</a></li>
														</ul>
													</div><!-- /btn-group -->
													<input type="text" class="form-control">
												</div><!-- /input-group -->
											</div><!-- /.col-lg-10 -->
											<br/><br/>
											<div class="col-lg-10">
												<div class="input-group">
													<div class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Category<span class="caret"></span></button>
														<ul class="dropdown-menu">
															<li><a href="#">Course Code</a></li>
															<li><a href="#">Title</a></li>
															<li><a href="#">Author</a></li>
															<li><a href="#">Publisher</a></li>
														</ul>
													</div><!-- /btn-group -->
													<input type="text" class="form-control">
												</div><!-- /input-group -->
											</div><!-- /.col-lg-10 -->
											<br/><br/>
											<div class="col-lg-10">
												<div class="input-group">
													<span class="input-group-addon">Exact Match</span>
													<input type="text" class="form-control">
												</div>  
											</div>
											<br/></br/>
											<div class="col-lg-10">
												<div class="input-group">
													<span class="input-group-addon">Search Expression</span>
													<input type="text" class="form-control">
												</div>  
											</div>
										</div>
									</form>
									<div class="modal-footer">
										<button class="btn btn-primary" name="search">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
        <?php } ?>
			</div>
		</div>
	</div><!--navbar-fixed-top-->
	
	<div id="content">
		<div id="left">
			<div id="carou">
			<!--  Carousel -->
			<!--  consult Bootstrap docs at 
            http://twitter.github.com/bootstrap/javascript.html#carousel -->
				<div id="this-carousel-id" class="carousel slide">
					<div class="carousel-inner" id="img-car">
						<div class = "item active">;
							<a href = ""><img src = "<?php echo base_url('img/5.jpg'); ?>" alt="Image 1" /></a>;
							<div class = "carousel-caption">
								<p></p>
								<p><a href = "">&raquo;</a></p>
							</div>
						</div>
						<?php for($i = 6; $i < 9; $i++){ ?>
							<div class="item">
								<a href=""> <img src="<?php echo base_url("img/". $i .".jpg") ?>" alt="Image 1" /></a>
								<div class="carousel-caption">
									<p></p>;
									<p><a href="">&raquo;</a></p>;
								</div>;
							</div>;
						<?php } ?>
					</div><!-- .carousel-inner -->
				<!--  next and previous controls here
				href values must reference the id for this carousel -->
					<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
				</div><!-- .carousel -->
			</div>
			<!-- end carousel -->
	
			<div class="link-gr">
				<a href="" target="_blank" class="link-pic" id="uplb">
					<div class="title-link">UPLB</div>
				</a>
				<a href="" target="_blank" class="link-pic" id="ics">
					<div class="title-link">ICS</div>
				</a>
				<a href="" target="_blank" class="link-pic" id="add">
					<div class="title-link">Mordor</div>
				</a>
			</div>
		</div>
	
		<div id="right">
			<div class="container" id="signin">
				<form action="<?=base_url().'index.php/login'?>" class="form-signin" role="form" method='post'>
					<input type="text" name='username' class="form-control" placeholder="Username">
					<input type="password" name='password' class="form-control" placeholder="Password">
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					<button class="btn btn-sm btn-success btn-block" type="submit">Create Account</button>
				</form>
		  
				<table class="table table-bordered" id="announ">
					<th>Announcements</th>
					<th>Date</th>
					<tr>
						<td>ITEM1</td>
						<td>00/00/00</td>
					</tr>
					<tr>
						<td>ITEM2</td>
						<td>00/00/00</td>
					</tr>
					<tr>
						<td>ITEM3</td>
						<td>00/00/00</td>
					</tr>
					<tr>
						<td>ITEM4</td>
						<td>00/00/00</td>
					</tr>
					<tr>
						<td>ITEM4</td>
						<td>00/00/00</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<!--footer-->
	<div class="navbar-fixed-bottom" id="test">
		<div class="text-center"> ICS Library 2014. 
			<p class="pull-right"><u><a href="http://www.portnine.com" target="_blank">ABOUT US<u></a></p>
			<p class="pull-right1"><u><a href="http://www.portnine.com" target="_blank">FAQ<u></a></p> 
		</div>
	</div>

 

    <!-- Main jumbotron for a primary marketing message or call to action -->
    
      
            


     <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url("js/vendor/jquery-1.10.1.js") ?>"><\/script>')</script>

        <script src="<?php echo base_url('js/vendor/bootstrap.min.js'); ?>"></script>

        <script src="<?php echo base_url('js/main.js'); ?>"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
