<?=$this->load->view("includes/header")?>
<div id="content">
	<div id="left">
	<div id="carou">
      <!--  Carousel -->
      <!--  consult Bootstrap docs at 
            http://twitter.github.com/bootstrap/javascript.html#carousel -->
		<div id="this-carousel-id" class="carousel slide">
	        <div class="carousel-inner" id="img-car">
				
					<div class="item active">
			            <a href=""> <img src="img/5.jpg" alt="Image 1" />
			            <div class="carousel-caption">
						<p></p>
						<a href=""> &raquo;</a></p>
			            </div>
					</div>
				<?php
					for($i=6;$i<9; $i++){
					echo '<div class="item">';
			            echo '<a href=""> <img src="img/'.$i.'.jpg" alt="Image 1" /></a>';
			            echo '<div class="carousel-caption">';
						echo '<p></p>';
						echo '<p><a href=""> &raquo;</a></p>';
			            echo '</div>';
					echo '</div>';
				}
				?>  
	        </div><!-- .carousel-inner -->
        <!--  next and previous controls here
              href values must reference the id for this carousel -->
			<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
		</div><!-- .carousel -->
	</div>
	    <!-- end carousel -->
	
	<div class="link-gr">
			<a href="" target="_blank" class="link-pic" id="uplb"><div class="title-link">UPLB</div></a>
			<a href="" target="_blank" class="link-pic" id="ics"><div class="title-link">ICS</div></a>
			<a href="" target="_blank" class="link-pic" id="add"><div class="title-link">Mordor</div></a>
	</div>
	</div>

	<!-- Insert contents here -->
	<div id="right">
	<div class="container" id="signin">
	<!-- <?=$loginMessage?>-->
	<form action="<?=base_url().'index.php/login'?>" method='post'>
		Username: <input type='text' name='username'class="form-control" placeholder="Username" required autofocus/>
		Password: <input type='password' class="form-control" placeholder="Password"name='password' required/>
		<br>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	    <button class="btn btn-sm btn-success btn-block" type="submit">Create Account</button>
		
	</form>

	<!--
		<form class="form-signin" role="form">
	        <input type="text" class="form-control" placeholder="Username" required autofocus>
	        <input type="password" class="form-control" placeholder="Password" required>
	        <br>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	        <button class="btn btn-sm btn-success btn-block" type="submit">Create Account</button>
		</form>
	  -->
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
	
<?=$this->load->view("includes/footer")?>