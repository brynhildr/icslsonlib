<?=$this->load->view("includes/header")?>

	<script src=<?php echo base_url("js/vendor/jquery-1.10.1.js"); ?>></script>
		<script type="text/javascript">	
			window.onload = function(){
					createForm.password.onblur = validatePassword;
					createForm.repass.onblur = validateRePass;
					
					$("#stdno").hide();
					$("#student_number").hide();
					$("#degree").hide();
					$("#college").hide();
					$("#collegeDropdown").hide();
					$("#degreeDropdown").hide();
					$("#enum").hide();
					$("#employee_number").hide();
					
					$("#employee_number").attr("disabled", "disabled");
					$("#student_number").attr("disabled", "disabled");
			}
			
			function validatePassword(){
				msg = "Invalid input!  ";
				str = createForm.password.value;
				
				if(str == "") msg+="Password is required. ";
				if(str.match(/^[a-z]$/)) msg="Strength: Weak";
				else if(str.match(/^[0-9]+$/)) msg="Strength: Weak";
				else if(str.match(/^[a-z0-9]+$/)) msg="Strength: Medium";
				else if(str.match(/^[a-zA-Z0-9]+$/)) msg="Strength: Strong";
				
				if(msg == "Invalid input!  ") msg="";
				document.getElementsByName("helppass")[0].innerHTML=msg;
				
			}
				
			function validateRePass(){
				msg = "Invalid input!  ";
				str = createForm.repass.value;
				
				if(str != createForm.password.value) msg+="Password does not match. ";
				else msg="Passwords match.";
				
				if(msg == "Invalid input!  ") msg="";
				document.getElementsByName("helprepass")[0].innerHTML=msg;
				if(msg == "") return true;
				
			}	
		</script>

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
            <td align="right"><button class="btn btn-primary"><input value="title" type="checkbox" name="projection[]" checked="true">Title:</button></td>
            <td align="right"><input type="text" class="form-control" name="title" size = "30" value="<?php if(isset($temparray) && in_array('title',$temparray)) echo $temparrayvalues[array_search('title', $temparray)]?>"><br/></td></tr>
          <tr>
          	<td align="right"><button class="btn btn-primary"><input value="author" type="checkbox" name="projection[]">Author:</button></td>
          	<td align="right"><input type="text" name="author" size = "30" class="form-control"value="<?php if(isset($temparray) && in_array('author',$temparray)) echo $temparrayvalues[array_search('author', $temparray)]?>"><br/></td></tr>
          <tr>
          	<td align="right"><button class="btn btn-primary"><input value="year_published" type="checkbox" name="projection[]">Year Published:</button></td>
          	<td align="right"><input type="text" name="year_published" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('year_published',$temparray)) echo $temparrayvalues[array_search('year_published', $temparray)]?>"><br/></td></tr>
          <tr>
          	  <td align="right"><button class="btn btn-primary"><input value="publisher" type="checkbox" name="projection[]">Publisher:</button></td>
          	<td align="right"><input type="text" name="publisher" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('publisher',$temparray)) echo $temparrayvalues[array_search('publisher', $temparray)]?>"><br/></td></tr>
          <tr>
          	  <td align="right"><button class="btn btn-primary"><input value="course_code" type="checkbox" name="projection[]" >Subject:</button></td>
          
          	<td><input type="text" name="course_code"class="form-control" size = "30" value="<?php if(isset($temparray) && in_array('course_code',$temparray)) echo $temparrayvalues[array_search('course_code', $temparray)]?>"><br/></td></tr>    <tr>
          <tr>
          	  <td align="right"><button class="btn btn-primary">Category:</button></td>
            <td align="right">
              <select class="form-control" >
                <option value="B">Book</option>
                <option value="J">Journal</option>
                <option value="T">Thesis</option>
                <option value="D">CD</option>
                <option value="C">Catalog</option>
              </select><br/>
            </td>
          </tr>
            <tr>
            <td align="left"><input type="radio" name="sort" value="sortalpha"checked="true" />Sort from A to Z</td>
            <td align="left"><input type="radio" name="sort" value="sortbeta" />Sort from Z to A</td>
          </tr> 
          <tr>
            <td align="left"><input type="radio" name="sort" value="sortyear" />Sort by year</td>
            <td align="left"><input type="radio" name="sort" value="sortauthor" />Sort by author(A-Z)</td>
          </tr> 
        </table>
        
       

              <div class="modal-footer">
                <input  class="btn btn-primary"type="submit" value="Advanced Search" />
                 </form> 
              </div> <!-- modal footer -->
            </div>
          </div>
        </div>
    </div> 
	<div id="content">
		<div id="left1">
			<div id="carou1">
			<!--  Carousel -->
			<!--  consult Bootstrap docs at 
            http://twitter.github.com/bootstrap/javascript.html#carousel -->
				<div id="this-carousel-id" class="carousel slide">
					<div class="carousel-inner" id="img-car1">
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
	
			<div class="link-gr1">
				<a href="" target="_blank" class="link-pic" id="uplb1">
					<div class="title-link">UPLB</div>
				</a>
				<a href="" target="_blank" class="link-pic" id="ics1">
					<div class="title-link">ICS</div>
				</a>
				<a href="" target="_blank" class="link-pic" id="add1">
					<div class="title-link">Mordor</div>
				</a>
			</div>
		</div>
	
		<div id="right1">
			<div class="container" id="signin">
				<form action="<?=base_url().'index.php/login'?>" class="form-signin" role="form" method='post'>
					<input type="text" name='username' class="form-control" placeholder="Username" required>
					<input type="password" name='password' class="form-control" placeholder="Password" required>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				
				</form>
				<button class="btn btn-sm btn-success btn-block" href="#createAccount" data-toggle="modal" data-target=".bs-modal-lg">Create Account</button>
	<!-- Create Account Modal -->
	<div class="modal fade bs-modal-lg" tabindex="-1" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="createAccountLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg"> 
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title">Create Account</h4>
	        </div>
	        <div class="modal-body">
	          <form method="post" action="<?=base_url('index.php/administrator/create_account')?>" role="form" accept-charset="utf-8" name="createForm"> <!-- FORM -->
	          	<!--div class="form-group"-->
	          		<label> Name </label></br>
	          		<div class="row">
	          			<div class="form-inline">
							<div class="form-group">
								<input type="text" class="form-control" id="first_name" name = "first_name" pattern = "[A-Za-z]+" placeholder="First Name" required>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-6">
									<input type="text" class="form-control" id="middle_name" name = "middle_name" placeholder="Middle Name" required>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="last_name" name = "last_name" pattern = "[A-Za-z]+" placeholder="Last Name" required> 
							</div>
						</div>
					</div><br/>

					<table class="form-group table">
						<tr>
							<td align="right" class="col-md-4"><label> Username</label> </td>
							<td><input type="text" class="form-control col-md-6" id="username" name = "username" pattern = "[A-Za-z_.0-9]+" required></td>
						</tr>						
						<tr>
							<td align="right" class="col-md-4"><label> Password</label> </td>
							<td><input type="password" class="form-control" id="password" name="password" required>
							<span name="helppass" id="helppass"></span></td>
						</tr>						
						<tr>
							<td align="right" class="col-md-4"><label> Re-type Password</label> </td>
							<td><input type="password" class="form-control" id="repass" name = "repass" required/>
							<span name="helprepass" id="helprepass"></span></br></td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> Contact Number</label> </td>
							<td><input type="text" class="form-control" id="contact" name = "contact_number" pattern = "[0-9]{11}" placeholder="09XXXXXXXXX" required></td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> E-mail Address</label> </td>
							<td><input type="text" class="form-control" id="email_address" name = "email_address" pattern = "^([a-z0-9._]{2,}@[a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,})(\.[a-zA-Z])*$" placeholder="icsrecario@gmail.com" required/></td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> College Address</label> </td>
							<td><textarea class="form-control" id="college_address" name = "college_address" required></textarea></td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"></br>
								<select name="user_type" class="form-control typeDropdown">
									<option value="">Select User Type</option>
									<option value="A"> Administrator </option>
									<option value="L"> Librarian </option>
									<option value="S"> Student </option>
									<option value="F"> Faculty </option>
								</select> 
							</td>
							<td>
							</td>
						</tr>
			<script type="text/javascript">
				$(".typeDropdown").change(function() {
					var type=$(this).val();
					if(type == 'S'){
						$("#stdno").show();
						$("#student_number").show();
						$("#degree").show();
						$("#college").show();
						$("#degreeDropdown").show();
						$("#collegeDropdown").show();
						
						$("#enum").hide();
						$("#employee_number").hide();
						
						$("#student_number").removeAttr("disabled");
					} else if(type == 'F'){
						$("#employee_number").attr("disabled", "disabled");
						$("#student_number").attr("disabled", "disabled");
						
						$("#stdno").hide();
						$("#degree").hide();
						$("#college").hide();
						$("#student_number").hide();
						$("#degreeDropdown").hide();
						$("#collegeDropdown").hide();
						
						$("#enum").show();
						$("#employee_number").show();
						
						$("#employee_number").removeAttr("disabled");
					} else {
						$("#employee_number").attr("disabled", "disabled");
						$("#student_number").attr("disabled", "disabled");
						
						$("#enum").show();
						$("#employee_number").show();
						$("#employee_number").removeAttr("disabled");
					}
				});
			</script>
						<tr id="student_number">
							<td align="right" class="col-md-4" id="stdno"><label> Student No.</label> </td>
							<td><input type="text" class="form-control"  id="student_number" name="student_number" pattern = "^[0-9]{4}[-]{1}[0-9]{5}$"/></br></td>
						</tr>
						<tr id="employee_number">
							<td align="right" class="col-md-4" id="enum"><label> Employee No.</label> </td>
							<td><input type="text" class="form-control" id="employee_number" name="employee_number" pattern="[0-9]{9}"/></td>
						</tr>
						<tr class="collegeSet">
							<td align="right" class="col-md-4" id="college"><label>College</label> </td>
							<td>
								<select name="college" class="form-control collegeDropdown" id="collegeDropdown">
									<option value="">Select College</option>
									<option value="CA"> College of Agriculture </option>
									<option value="CAS"> College of Arts and Sciences </option>
									<option value="CA-CAS"> College of Agriculture - College of Arts and Sciences</option>
									<option value="CDC"> College of Development Communication </option>
									<option value="CEM"> College of Economics and Management </option>
									<option value="CEAT"> College of Engineering and Agro-industrial Technology </option>
									<option value="CFNR"> College of Forestry and Natural Resources </option>
									<option value="CHE"> College of Human Ecology </option>
									<option value="CVM"> College of Veterenary Medicine </option>
									<option value="GS"> Graduate School </option>
								</select>
							</td>
						</tr>
						<tr class="degreeSet">
							<td align="right" class="col-md-4" id="degree"><label>Degree</label> </td>
							<td>
								<select name="degree" class="form-control degreeDropdown" id="degreeDropdown">
									<option value="">Select Degree</option>
								</select>
							</td>
						</tr>
		<script type="text/javascript">
			<!--
				$("#collegeDropdown").change(function() {
					var col=$(this).val();
											 
					function fillDegreeDropdown(colDegOption) {
						$.each(colDegOption, function(val, text) {
							$('#degreeDropdown').append($('<option></option>').val(val).html(text));
						});
					}
														
					function clearDegreeDropdown() {
						$('#degreeDropdown option:gt(0)').remove();
					}

					if(col == 'CA') {
						clearDegreeDropdown();
															
						var CaOption={
							BSA:'BS Agriculture',
							BSABT: 'BS Agricultural Biotechnology',
							BSFT: 'BS Food Technology'
						};
					fillDegreeDropdown(CaOption);
					} else if(col == 'CAS'){
						clearDegreeDropdown();
															
						var CasOption={
							BACA:'BA Communication Arts',
							BAS: 'BA Sociology',
							BAP: 'BA Philosophy',
							BSAM: 'BS Applied Mathematics',
							BSAP: 'BS Applied Physics',
							BSB: 'BS Biology',
							BSC: 'BS Chemistry',
							BSCS: 'BS Computer Science',
							BSM: 'BS Mathematics',
							BSMST: 'BS Mathematics and Science Teaching',
							BSS: 'BS Statistics'
						};
					fillDegreeDropdown(CasOption);
					} else if(col == 'CA-CAS'){
						clearDegreeDropdown();
															
						var CaCasOption={
							BSAC: 'BS Agricultural Chemistry'
						};
					fillDegreeDropdown(CaCasOption);
					} else if(col == 'CDC'){
						clearDegreeDropdown();
															
						var CdcOption={
							BSDC: 'BS Development Communication'
						};
					fillDegreeDropdown(CdcOption);
					} else if(col == 'CEAT'){
						clearDegreeDropdown();
															
						var CeatOption={
							BSAeng: 'BS Agricultural and Biosystems Engineering',
							BSChE: 'BS Chemical Engineering',
							BSCE: 'BS Civil Engineering',
							BSEE: 'BS Electrical Engineering',
							BSIE: 'BS Industrial Engineering'
						};
					fillDegreeDropdown(CeatOption);
					} else if(col == 'CEM'){
						clearDegreeDropdown();
															
						var CemOption={
							BSAE: 'BS Agricultural Economics',
							BSABM: 'BS Agribusiness Management',
							BSE: 'BS Economics'
						};
					fillDegreeDropdown(CemOption);
					} else if(col == 'CFNR'){
						clearDegreeDropdown();
															
						var CfnrOption={
							BSF: 'BS Forestry'
						};
					fillDegreeDropdown(CfnrOption);
					} else if(col == 'CHE'){
						clearDegreeDropdown();
															
						var CheOption={
							BSHE: 'BS Human Ecology',
							BSN: 'BS Nutrition'
						};
					fillDegreeDropdown(CheOption);
					} else if(col == 'CVM'){
						clearDegreeDropdown();
															
						var CvmOption={
							DVM: 'Doctor of Veterenary Medicine'
						};
					fillDegreeDropdown(CvmOption);
					} else if(col == 'GS'){
						clearDegreeDropdown();
															
						var GsOption={
							MSAC: 'MS Agricultural Chemistry',
							MSAE: 'MS Agricultural Economics',
							MSAEd: 'MS Agricultural Education',
							MSAg: 'MS Agrometeorology',
							MSAgr: 'MS Agronomy',
							MSAS: 'MS Animal Science',
							MSAN: 'MS Applied Nutrition',
							MSBC: 'MS Biochemistry',
							MSB: 'MS Botany',
							MSCE: 'MS Chemical Engineering',
							MSC: 'MS Chemistry',
							MSCS: 'MS Computer Science',
							MSCo: 'MS Community',
							MSD: 'MS Development',
							MSDC: 'MS Development Communication',
							MSDMG: 'MS Development Management and Governance',
							MSE: 'MS Economics',
							MSEn: 'MS Entomology',
							MSES: 'MS Environmental Science',
							MSExE: 'MS Extension Education',
							MSFRM: 'MS Family Resource Management',
							MSFS: 'MS Food Science',
							MSFBS: 'MS Forestry: Forest Biological Sciences',
							MSFRM: 'MS Forestry: Forest Resources Management',
							MSFSFI: 'MS Forestry: Silviculture and Forest Influences',
							MSFSF: 'MS Forestry: Social Forestry',
							MSGH: 'MS Genetics Horticulture',
							MSM: 'MS Mathematics',
							MSMB: 'MS Microbiology',
							MSMBB: 'MS Molecular Biology and Biotechnology',
							MSNRC: 'MS Natural Resources Conservation',
							MSPB: 'MS Plant Breeding',
							MSPGRC: 'MS Plant Genetics Resources Conservation and Management',
							MSPP: 'MS Plant Pathology',
							MSRS: 'MS Rural Sociology',
							MSSS: 'MS Social Science',
							MSS: 'MS Statistics',
							MSVM: 'MS Veterenary Medicine',
							MSWS: 'MS Wildlife Studies',
							MSZ: 'MS Zoology',
							MF: 'Master of Forestry',
							MIT: 'Master of Information Technology',
							MACA: 'MA Communication Arts',
							MAS: 'MA Sociology',
							MAg: 'Master of Agriculture',
							MMAbm: 'Master of Management - Agribusiness Management and Entrepreneurship',
							MMBM: 'Master of Management - Business Management',
							MMCM: 'Master of Management - Cooperative Management',
							PAC: 'PhD Agricultural Chemistry',
							PAE: 'PhD Agricultural Economics',
							PAEd: 'PhD Agricultural Education',
							PAEng: 'PhD Agricultural Engineering',
							PAgr: 'PhD Agronomy',
							PAS: 'PhD Animal Science',
							PBC: 'PhD Biochemistry',
							PSB: 'PhD Botany',
							PCS: 'PhD Computer Science',
							PCD: 'PhD Community Development',
							PDC: 'PhD Development Communication',
							PDS: 'PhD Development Studies',
							PEn: 'PhD Entomology',
							PES: 'PhD Environmental Science',
							PExE: 'PhD Extension Education',
							PFS: 'PhD Food Science',
							PFBS: 'PhD Forestry: Forest Biological Sciences',
							PFRM: 'PhD Forestry: Forest Resources Management',
							PFSFI: 'PhD Forestry: Silviculture and Forest Influences',
							PSFWT: 'PhD Forestry: Wood Science and Technology',
							PGH: 'PhD Genetics Horticulture',
							PHN: 'PhD Human Nutrition',
							PMB: 'PhD Microbiology',
							PMBB: 'PhD Molecular Biology and Biotechnology',
							PPB: 'PhD Plant Breeding',
							PPP: 'PhD Plant Pathology',
							PSS: 'PhD Social Science',
							PSS: 'PhD Statistics',
						};
					fillDegreeDropdown(GsOption);
					}
				});
			-->
			</script>
					</table>
			
				   <!--/div-->				
			   
	        </div>
		        <div class="modal-footer">
		          <input class="btn btn-primary" type="submit" name="submit"/>
		        </div>
	        </form> <!-- END OF FORM -->
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
		  
				<table class="table table-bordered" id="announ1">
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
<?=$this->load->view("includes/footer")?>	

 

  