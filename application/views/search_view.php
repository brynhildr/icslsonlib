<?= $this->load->view('includes/header') ?>
		<h1>Search</h1>
		<br/>
		<div id = "search-whole">
			<!-- Search Form -->
			<div id = "search-shown">
				<form action="<?php echo base_url('index.php/search/search_rm'); ?>" method="get" accept-charset="utf-8">
				
					<input type="text" name="keyword" size = "50" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword']; ?>"/>
					<input type="submit" name="search1" value="Search"/>
				</form>
				<a href="#advanceSearch" class = "modal"><input type="submit" name="aSearch" class="btn btn-primary"  value="Advanced Search"/></a>
			</div>
			<!-- Advance Search Form -->
			<div class = "search-hidden">
				

				 <div id="advanceSearch" class="modal fade in" role="dialog">  
<div class="modal-dialog">  
          <div class="modal-content">
            <div class="modal-header">  
              <a class="close" data-dismiss="modal">&times;</a>
            <h4>Advanced Search</h4>  
            </div><!--modal header-->
            <div class="modal-body">
                <form action="<?php echo base_url('index.php/search/advanced_search_reference'); ?>" method="get" accept-charset="utf-8">
				<table>
					<tr>
						<td><input value="title" type="checkbox" name="projection[]" checked="true">Title:</td>
						<td><input type="text" name="title" size = "30" value="<?php if(isset($temparray) && in_array('title',$temparray)) echo $temparrayvalues[array_search('title', $temparray)]?>"><br/></td></tr>
					<tr><td><input value="author" type="checkbox" name="projection[]">Author:</td><td><input type="text" name="author" size = "30" value="<?php if(isset($temparray) && in_array('author',$temparray)) echo $temparrayvalues[array_search('author', $temparray)]?>"><br/></td></tr>
					<tr><td><input value="year_published" type="checkbox" name="projection[]">Year Published:</td><td><input type="text" name="year_published" size = "30" value="<?php if(isset($temparray) && in_array('year_published',$temparray)) echo $temparrayvalues[array_search('year_published', $temparray)]?>"><br/></td></tr>
					<tr><td><input value="publisher" type="checkbox" name="projection[]">Publisher:</td><td><input type="text" name="publisher" size = "30" value="<?php if(isset($temparray) && in_array('publisher',$temparray)) echo $temparrayvalues[array_search('publisher', $temparray)]?>"><br/></td></tr>
					<tr><td><input value="course_code" type="checkbox" name="projection[]">Subject:</td><td><input type="text" name="course_code" size = "30" value="<?php if(isset($temparray) && in_array('course_code',$temparray)) echo $temparrayvalues[array_search('course_code', $temparray)]?>"><br/></td></tr>		<tr>
					<tr><td>Category:</td>
						<td>
							<select>
								<option value="B">Book</option>
								<option value="J">Journal</option>
								<option value="T">Thesis</option>
								<option value="D">CD</option>
								<option value="C">Catalog</option>
							</select><br/>
						</td>
					</tr>
						<tr>
						<td><input type="radio" name="sort" value="sortalpha"checked="true" />Sort from A to Z</td>
						<td><input type="radio" name="sort" value="sortbeta" />Sort from Z to A</td>
					</tr>	
					<tr>
						<td><input type="radio" name="sort" value="sortyear" />Sort by year</td>
						<td><input type="radio" name="sort" value="sortauthor" />Sort by author(A-Z)</td>
					</tr>	
				</table>
				<input type="submit" value="Advanced Search" />	
				</form>	

              <div class="modal-footer">
                <button class="btn btn-primary" name="search">Search</button>
              </div> <!-- modal footer -->
            </div>
          </div>
        </div>
    </div>	
			</div>
		</div>

	<script type="text/javascript">
	//javascript for hiding/showing the advance search form
		$(document).ready( function(){
			var i = 0;
			$('.search-hidden').hide();
			$('.search-toggle').click(function() {
			    $('.search-hidden').slideToggle();
			    if(i == 0){
					$('.search-toggle').html('Hide Advanced Search');
					i = 1;
				}else{
					 $('.search-toggle').html('Advanced Search');
					 i = 0;
				}
			});
		});
	</script>		
	</body>
</html>
	
<?=$this->load->view("includes/footer")?>