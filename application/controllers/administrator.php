<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller{
	public function Administrator(){
		parent::__construct();

		//Check if the user is logged-in and is an administrator
		if($this->session->userdata('loggedIn') && $this->session->userdata('userType') != 'A'){
			redirect('home');
		}

		$this->load->model("administrator_model");
	}

	public function index(){
		$data['title'] = 'Administrator Home - ICS Library System';
		$this->load->view('administrator_home_view', $data);
	}

	public function view_accounts(){
		$data['title'] = 'View Accounts - ICS Library System';
		$this->load->library('pagination');
		
		//Gets the value of the hidden input tags if not NULL
		$searchText = $this->input->post('hidden_search_text');
		$searchCategory = str_replace(' ', '_', $this->input->post('hidden_category'));
		
		//Checks if the user selected a particular sort order
		$sortCategory = $this->input->post('sort_category') ? $this->input->post('sort_category') : 'last_name';
		
		//Sets the item per page
		$itemsPerPage = 10;
		
		//Gets the offset
		$offset = $this->uri->segment(3) < 1 ? 0 : (($this->uri->segment(3)-1)*$itemsPerPage);

		//Checks if the user specified specific search text and category
		//Gets data depending on the user input
		if($searchText && $searchCategory){
			$accounts = $this->administrator_model->get_limited_search_accounts($searchCategory, $searchText, $sortCategory, $itemsPerPage, $offset);
			$accountCount = $this->administrator_model->get_search_accounts_count($searchCategory, $searchText);
		}else{
			$accounts = $this->administrator_model->get_all_limited_accounts($sortCategory, $itemsPerPage, $offset);
			$accountCount = $this->administrator_model->get_total_accounts();
		}

		if($accountCount > 0) $data['accounts'] = $accounts->result();

		//Configures pagination if the output count is greater than the items per page
		if($accountCount > $itemsPerPage){
			$config['base_url'] = base_url().'index.php/administrator/view_accounts';
			$config['per_page'] = $itemsPerPage;
			
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			
			$config['prev_link'] = '&lt; &lt; Previous';
			$config['next_link'] = 'Next &gt; &gt;';

			$config['total_rows'] = $accountCount;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = ceil($accountCount/$itemsPerPage);

			$this->pagination->initialize($config);
		}

		$data['accountCount'] = $accountCount;
		$data['offset'] = $offset;
		$data['searchText'] = $searchText;
		$data['searchCategory'] = str_replace('_', ' ', $searchCategory);
		$data['sortCategory'] = $sortCategory;
		
		$this->load->view('view_accounts_view', $data);		
	}
	
	/**
	 * Controller to get selected user/s to be deleted
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function delete_accounts(){
		//Gets the post value of the 'users' checkbox
		//$users contains the array of users that has been checked to be deleted
		$users = $this->input->post('users');
		
		//Checks if $users has a value. If true, accesses from the administrator_model the delete_accounts function, with $users as parameter
		if($users){			
			$this->administrator_model->delete_accounts($users);	
		}
		
		//After deleting account/s, it redirects to view_accounts() method.
		redirect('administrator/view_accounts');
	}

	public function search_accounts(){
		if( ! $this->input->post('submit')) redirect('administrator/view_accounts');
		
		$data['title'] = 'Search Accounts Result - ICS Library System';
		$this->load->library('pagination');
		
		//Gets the user input from the form
		$searchText = $this->input->post('search_text');
		$searchCategory = $this->input->post('category');
		
		//Sets default sort order
		$orderBasis = 'last_name';

		//Sets the item per page
		$itemsPerPage = 10;

		//Gets the offset
		$offset = $this->uri->segment(3) < 1 ? 0 : (($this->uri->segment(3)-1)*$itemsPerPage);

		$accountCount = $this->administrator_model->get_search_accounts_count($searchCategory, $searchText);
		
		if($accountCount > 0) $data['accounts'] = $this->administrator_model->get_limited_search_accounts($searchCategory, $searchText, $orderBasis, $itemsPerPage, $offset)->result();

		//Configures pagination if the output count is greater than the items per page
		if($accountCount > $itemsPerPage){
			$config['base_url'] = base_url().'index.php/administrator/search_accounts';
			$config['per_page'] = $itemsPerPage;
			
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			
			$config['prev_link'] = '&lt; &lt; Previous';
			$config['next_link'] = 'Next &gt; &gt;';
			
			$config['total_rows'] = $accountCount;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = ceil($accountCount/$itemsPerPage);

			$this->pagination->initialize($config);
		}

		$data['accountCount'] = $accountCount;
		$data['offset'] = $offset;
		$data['searchText'] = $searchText;
		$data['searchCategory'] = str_replace('_', ' ', $searchCategory);
		$data['sortCategory'] = $orderBasis;
		
		$this->load->view('view_accounts_view', $data);
	}
	
	
	/*
		create_account(): student, employee, librarian, admin
		
	*/
	
	//Janet Ordillano
	public function create_account(){	
	
		//if it is a student
		if($_POST['user_type'] == 'S'){
			$studnum = $_POST['student_number'];
			$uname = $_POST['username'];

			$studentQuery = $this->user_model->student_exists($studnum);
			$usernameQuery = $this->user_model->username_exists($uname);

			if($studentQuery == TRUE || $usernameQuery == TRUE){
				$this->load->view('home_view');
					echo "Account already exists.";
			}else {	
				$this->load->model('user_model');
				$this->user_model->insert_account('users', $_POST);	//user_model used
				
				echo "Account succesfully created.";
				$this->load->view('home_view');
			}
		}
		//if User is a faculty, librarian or admin
		else {
			$enum = $_POST['employee_number'];
			$uname = $_POST['username'];

			$facultyQuery = $this->user_model->staff_exists($enum);
			$usernameQuery = $this->user_model->username_exists($uname);

			if($facultyQuery == TRUE || $usernameQuery == TRUE){
				$this->load->view('home_view');
				echo "Account already exists.";
			}else {
				$this->load->model('user_model');
				$this->user_model->insert_account('users', $_POST);	//user_model used
				
				echo "Account succesfully created.";
				$this->load->view('home_view');
			}
		}
	}
	
	/**
	 * function for viewing a user profile
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function edit_account(){
		$data["title"]	= "Edit Account - ICS Library System";

		//Retrieves id of account to be edited through the URI
		$id = $this->uri->segment(3);
		
		$data['account'] = $this->administrator_model->get_existing_account($id);

		$this->load->view("edit_accounts_view", $data);
		
	}
	
	/**
	 * function for viewing a user profile
	 *
	 * @access	public
	 * @param	int (id of user)
	 * @return	none
	 */	
	public function view_user_profile($id){
		//****MODIFIED CODE: Used ID instead of USERNAME
		
		//return true if user exists
		if($this->administrator_model->user_exists($id)){
			$data['results']=$this->administrator_model->get_profile($id); //creates a data array that accepts the return value of getProfile
			
			//load the user_profile view																	// function of administrator model
			$this->load->view('user_profile_view',$data); 
		}
		//if not found/does not exists
		else{										
			$this->load->view('not_found_view.html');
		}
	}
	
	/**
	 * function for viewing a user profile
	 *
	 * @access	public
	 * @param	int (id of user)
	 * @return	none
	 */	
	public function save_account_changes(){
		$last_name = $_POST["last_name"];
		$first_name = $_POST["first_name"];
		$middle_name = $_POST["middle_name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$college_address = $_POST["college_address"];
		$email_address = $_POST["email_address"];
		$contact_number = $_POST["contact_number"];
		$college = $_POST["college"];
		$degree = $_POST["degree"];

		if($this->input->post('stud_no')){
			$student_number = $this->input->post('stud_no');
			$employee_number = NULL;
		}
		else if($this->input->post('employee_number')){
			$employee_number = $this->input->post('employee_number');
			$student_number = NULL;
		}
		$this->load->model('administrator_model');
		
		$this->administrator_model->save_changes("UPDATE users 
				SET employee_number = '$employee_number', student_number = '$student_number', last_name = '$last_name', first_name = '$first_name', 
				middle_name = '$middle_name', username = '$username', password = '$password', 
				college_address = '$college_address', email_address = '$email_address', contact_number = '$contact_number',
				college = '$college', degree = '$degree'
				WHERE username = '$username'");

		$this->load->view("redirect_edit_account_view");
	}
	
}

?>