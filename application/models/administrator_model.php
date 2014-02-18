<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Administrator Model
 *
 * @package	icsls
 * @category Model	
 * @author	CMSC 128 AB-5L Team 1
 */

class Administrator_model extends CI_Model{

	/**
	 * Counts the total number of existing accounts
	 *
	 * @access	public
	 * @param	none
	 * @return	integer
	 */
	public function get_total_accounts()
	{
		return $this->db->count_all('users');
	}

	/**
	 * Gets limited number of accounts sorted based on a specific criteria, limit and offset
	 *
	 * @access	public
	 * @param	string, integer, integer
	 * @return	array
	 */
	public function get_all_limited_accounts($orderBasis, $limit, $offset)
	{
		$this->db->select(array('id', 'employee_number', 'student_number', 'username', 'last_name', 
				 		 		'first_name', 'middle_name', 'user_type')
						 )
				 ->from('users')
				 ->order_by($orderBasis, 'asc')
				 ->limit($limit, $offset);
		
		return $this->db->get();
	}

	/**
	 * Counts the number of accounts matching the search criteria
	 *
	 * @access	public
	 * @param	string, string
	 * @return	array
	 */
	public function get_search_accounts_count($searchCategory, $searchText)
	{
		$this->db->select('username')
				 ->from('users')
				 ->where($searchCategory, $searchText);

		return $this->db->get()->num_rows();
	}

	/**
	 * Gets limited number of accounts matching the search criteria based on search criteria and offset
	 *
	 * @access	public
	 * @param	string, string, string, integer, integer
	 * @return	array
	 */
	public function get_limited_search_accounts($searchCategory, $searchText, $orderBasis, $limit, $offset)
	{
		$this->db->select(array('id','employee_number', 'student_number', 'username', 'last_name', 
				 		 		'first_name', 'middle_name', 'user_type')
						 )
				 ->from('users')
				 ->where($searchCategory, $searchText)
				 ->order_by($orderBasis, 'asc')
				 ->limit($limit, $offset);
		
		return $this->db->get();
	}
	
	/**
	 * Deletes selected account/s
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function delete_accounts($users){
		foreach($users as $value)
        {
			$this->db->delete('users', array('id' => $value));
        }
	}	
	
	/**
	 * Inserts a tuple in the users table based on the data provided by the user given
	 * that the username OR email address is not yet used in any of the existing accounts
	 *
	 * @access 	public
	 * @param 	int 	$idNumber
	 *			String 	$last_name
	 *			String 	$first_name
	 *			String 	$middle_name
	 *			char 	$user_type
	 *			String 	$username
	 *			String 	$password
	 *			String 	$college_address
	 *			String 	$email_address
	 *			int 	$contact
	 *			String 	$college
	 *			String 	$degree
	 * @return Boolean 	
	 * @author Erika Kimhoko, January 29, 2014
	 * @since February 17, 2014
	*/
	public function insert_account($idNumber, $last_name, $first_name, $middle_name,
		$user_type, $username, $password, $college_address, $email_address, $contact, $college, $degree){
	
		//check if there is already an account with the same username or email address to prevent complications in logging in or emailing an account
		$name =  $this->db->query("SELECT username FROM users WHERE username = '$username' OR email_address = '$email_address'");
		
		if($name->num_rows() == 0){
			//Check user type before executing query
			if($user_type == 'F'){
				$this->db->query("INSERT INTO users 
				(employee_number, student_number, last_name, first_name, middle_name, user_type , username, password, college_address, email_address, contact_number, college, degree) 
				VALUES 
				('$idNumber', NULL, '$last_name', '$first_name', '$middle_name', '$user_type', '$username', '$password', '$college_address', '$email_address', '$contact', NULL, NULL)");				
			}
			else{
				$this->db->query("INSERT INTO users 
				(employee_number, student_number, last_name, first_name, middle_name, user_type , username, password, college_address, email_address, contact_number, college, degree) 
				VALUES 
				(NULL, '$idNumber', '$last_name', '$first_name', '$middle_name', '$user_type', '$username', '$password', '$college_address', '$email_address','$contact', '$college', '$degree')");
			}
			//Set default values
			$this->db->query("UPDATE users 
				SET borrow_limit = 3, waitlist_limit = 5
				WHERE username = '$username'");
			return 1;
			
		}
		else{
			return FALSE;
		}
	}
	
	/**
	 * returns the data from database of a certain account
	 *
	 * @access	public
	 * @param	none
	 * @return	row on a database
	 */	
	public function get_profile($id){ //returns the profile of the chosen user
		//****MODIFIED CODE: Used ID instead of USERNAME
		$query=$this->db->query("SELECT * FROM users WHERE id='$id'");
		return $query->result();
	}
	
	/**
	 * returns the data from database of a certain account
	 *
	 * @access	public
	 * @param	id - id of username to be edited
	 * @return	array
	 */	
	public function get_existing_account($id){ 
		 $userInfo = $this->db->query("SELECT * FROM users WHERE id = '$id'");

		 foreach ($userInfo->result() as $item){
		 	//Store in array data all existing user info
		 	$data[] = $item;
		 }
		 return $data;
	}
	
	/**
	 * returns the data from database of a certain account
	 *
	 * @access	public
	 * @param	input - user input in the username text field
	 * @return	
	 */	
	public function get_username($input){
		return $this->db->query("SELECT username FROM users WHERE username = '$input'")->result();
	}
	
	/**
	 * returns the data from database of a certain account
	 *
	 * @access	public
	 * @param	query - query to update/edit user info
	 * @return	none
	 */	
	public function save_changes($query){
		$this->db->query($query);
	}
	
	/* Parameters:
		a. $username - value of username entered
		Description: Checks if the user is registered
		Return value: Boolean value if the user exists or not
	*/
	public function user_exists($id){
		//****MODIFIED CODE: Used ID instead of USERNAME
		$userCount = $this->db->query("SELECT * FROM users WHERE id='$id'")->num_rows();

		return ($userCount == 1 ? true : false);
	}
}

?>