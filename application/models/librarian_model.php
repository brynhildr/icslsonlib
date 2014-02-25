<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model for Librarian-specific modules
 *
 * 
 * @author Mark Carlo Dela Torre, Angela Roscel Almoro, Jason Faustino, Jay-ar Hernaez
 * @version 1.0
*/
class Librarian_model extends CI_Model{
	/**
	 * Constructor for the model Librarian_model
	 *
	 * 
	*/
	function __construct(){
		parent::__construct();
	}

	/**
	 * 
	*/
	public function get_all_references(){
		return $this->db->get('reference_materials');
	}

	/**
	 * Retrieves ALL references starting within offset ending with per_page
	 *
	 * @access 	public
	 * @return 	
	*/
	public function get_all_references_part($offset, $per_page){
		return $this->db->get('reference_materials', $per_page, $offset);
	}//end of function get_all_references

	/**
	 * Returns the number of rows affected by the user's search input
	 *
	 * @access 	public
	 * @param 	array 	$query_array
	 * @return 	int
	*/
	public function get_number_of_rows($query_array){
		$categoryArray = array('title', 'author', 'isbn', 'course_code', 'publisher');
		$sortCategoryArray = array('title', 'author', 'category', 'course_code', 'times_borrowed', 'total_stock');
		if(! in_array($query_array['category'], $categoryArray))
			redirect('librarian/search_reference_index');
		if(! in_array($query_array['sortCategory'], $sortCategoryArray))
			redirect('librarian/search_reference_index');

		if($query_array['text'] == '')
			redirect('librarian/search_reference_index');

		//Match or Like
		if($query_array['match'] == 'like')
			$this->db->like($query_array['category'], $query_array['text']);
		elseif($query_array['match'] == 'match')
			$this->db->where($query_array['category'], $query_array['text']);
		else
			redirect('librarian/search_reference_index');

		//Display references ONLY for a specific type of people
		if($query_array['accessType'] != 'N')
			$this->db->where('access_type', $query_array['accessType']);

		//Display references to be deleted
		if($query_array['deletion'] != 'N')
			$this->db->where('for_deletion', $query_array['deletion']);

		$result = $this->db->get('reference_materials');

		return $result->num_rows();
	}//end of function get_number_of_rows

	/**
	 * Gets the results of the user's query limited by a range from the user
	 *
	 * @access 	public
	 * @param 	array 	$query_array,
	 * @param 	int 	$start
	 * @return 	object
	*/
	public function get_search_reference($query_array, $start){
		$categoryArray = array('title', 'author', 'isbn', 'course_code', 'publisher');
		$sortCategoryArray = array('title', 'author', 'category', 'course_code', 'times_borrowed', 'total_stock');
		if(! in_array($query_array['category'], $categoryArray))
			redirect('librarian/search_reference_index');
		if(! in_array($query_array['sortCategory'], $sortCategoryArray))
			redirect('librarian/search_reference_index');
		
		
		if($query_array['text'] == '')
			redirect('librarian/search_reference_index');

		//Match or Like
		if($query_array['match'] == 'like')
			$this->db->like($query_array['category'], $query_array['text']);
		elseif($query_array['match'] == 'match')
			$this->db->where($query_array['category'], $query_array['text']);

		//Display references ONLY for a specific type of people
		if($query_array['accessType'] != 'N')
			$this->db->where('access_type', $query_array['accessType']);

		//Display references to be deleted
		if($query_array['deletion'] != 'N')
			$this->db->where('for_deletion', $query_array['deletion']);

		//Order
		$this->db->order_by($query_array['sortCategory'], $query_array['orderBy']);

		$this->db->limit($query_array['row'], $start);
		
		return $this->db->get('reference_materials');
	}//end of function get_search_reference

	/**
	 * Removes a reference, specified by its row ID, in the database
	 *
	 * @access 	public
	 * @param 	int 	$book_id
	 * @return 	int
	*/
    public function delete_references($book_id){
		
		$this->db->where('id', $book_id);
		$query = $this->db->get('reference_materials');
		foreach($query->result() as $row):
			//Check books if complete
			if($row->total_available === $row->total_stock){
				$this->load->database();
				$this->db->delete('reference_materials', array('id' => $book_id)); 
				return -1;
			}
			else{
				if($row->for_deletion === 'F')
					return $book_id;
			}	
		endforeach;
		
    }//end of function delete_reference
	
	/**
	 * Get references ready for deletion (references with for_deletion = 'T' and complete stock)
	 *
	 * @access 	public
	 * @return 	object
	*/
	function get_ready_for_deletion(){
		$sql = "SELECT id, title, author FROM reference_materials WHERE total_available = total_stock AND for_deletion = 'T'";
		$query = $this->db->query($sql);
		return $query;
		
	}//end of function get_ready_for_deletion
	
	//get the remaining books
	function get_other_books($idready){
		if(!empty($idready)){
			$this->db->where_not_in('id',$idready);
			return $this->db->get('reference_materials');
		}else{
			return $this->db->get('reference_materials');
		}
	}
	
	//Given array of selected books retrieve info
	function get_selected_books($selected){
		$info = array();
		foreach($selected as $id):
			$this->db->where('id',$id);
			$info[] = $this->db->get('reference_materials');
		endforeach;
		
		return $info;
	}
	
	//Update the for_deletion attribute
	function update_for_deletion($book_id){ //Changes 'For Deletion' attribute of the reference to  'T'
		$this->db->where('id', $book_id);
		$this->db->update('reference_materials', array('for_deletion' => 'T')); 
	}

	/**
	 * Adds a reference in the database
	 *
	 * @access 	public
	 * @param 	array 	$data
	*/
	function add_data($data){      
        $this->db->insert('reference_materials', $data);
    }//end of function add_data

    /**
     * Adds multiple references from the uploaded file to the database
     *
     * @access 	public
     * @param 	array 	$data,
     * 			int 	$count
    */
    public function add_multipleData($data, $count){
        for($i = 0; $i < $count; $i++) {
            $this->db->insert('reference_materials', $data[$i]);
        }

        /*find a more efficient way to do this */
        $this->db->set('isbn',NULL);
        $this->db->where('isbn','');
        $this->db->update('reference_materials');

        $this->db->set('description',NULL);
        $this->db->where('description','');
        $this->db->update('reference_materials');

        $this->db->set('publisher',NULL);
        $this->db->where('publisher','');
        $this->db->update('reference_materials');

        $this->db->set('publication_year',NULL);
        $this->db->where('publication_year','');
        $this->db->update('reference_materials');
    }//end of function add_multipleData

    /**
     * Updates a reference's data in the database with the user's input
     *
     * @access 	public
     * @param 	array 	$query_array
    */
    public function edit_reference($query_array){
      	$this->db->query("UPDATE reference_materials SET 
      			title = '{$query_array['title']}', 
      			author = '{$query_array['author']}', 
      			isbn = '{$query_array['isbn']}', 
      			category = '{$query_array['category']}', 
      			publisher = '{$query_array['publisher']}', 
      			publication_year = '{$query_array['publication_year']}', 
      			access_type = '{$query_array['access_type']}', 
      			course_code = '{$query_array['course_code']}', 
      			description = '{$query_array['description']}', 
      			total_stock = '{$query_array['total_stock']}' 
      		WHERE id = {$query_array['id']}"
      	);
    }//end of function edit_reference

    /**
     * Returns a reference specified by its row ID
     *
     * @param 	int 	$referenceId
     * @return 	array
    */
    public function get_reference($referenceId){
        $this->db->where('id', $referenceId);
        return $this->db->get('reference_materials');
    }//end of function get_reference

    /**
	*	Function gets the exact transactions based from type of report (Daily, Weekly or Monthly)
	*	@param $type (string)
	*	@return rows from db || null
	*/
	public function get_data($type){
		$day = date('D');

		/*returns rows of data from selected columns of the transaction log based on current date*/
		if (strcmp($type,'daily') == 0) {//reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned
			return $this->db->query("SELECT * FROM transactions WHERE date_borrowed LIKE CURDATE()");
		} 
		/*returns rows of data from selected columns of the transasction log based on the whole week
		* can only be accessed on Fridays
		*/
		else if (strcmp($type,'weekly')==0 && $day=='Fri') {//reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned
			return $this->db->query("SELECT * FROM transactions WHERE DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed");	
		} 
		/*returns rows of data from selected columns of the transaction log based on the whole month*/
		else if (strcmp($type,'monthly')==0) {//reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned
			return $this->db->query("SELECT * FROM transactions WHERE MONTHNAME(date_borrowed) LIKE MONTHNAME(CURDATE())");
		}
	}


	/**
	*	Function gets the most borrowed reference material
	*	@return rows from db || null
	*/
	public function get_popular(){
		return $this->db->query("SELECT * FROM reference_materials WHERE times_borrowed = (SELECT max(times_borrowed) FROM reference_materials)");
	}

	/**
	 *
	 *
	 * @access 	public
	 * @param 	int 	$referenceId
	 *			int 	$userId
	 *			char 	$flag
	*/
	public function claim_return_reference($referenceId, $userId, $flag){
		$updateStatus = FALSE; 
		
		//Get stock ad stock within library
		$stockData = $this->db->query("SELECT total_stock, total_available FROM reference_materials WHERE id = '{$referenceId}'")->result();
		foreach($stockData as $data){
			$newValue = $data->total_available;
			$ceilingValue = $data->total_stock;
		}
		//Borrow a reference material
		if($flag === 'C' && $newValue > 0){
			$dateBorrowed = date('Y-m-d');
		 	$dateParts = explode('-', $dateBorrowed);
		 	$borrowDue = date('Y-m-d', mktime(0,0,0, $dateParts[1], $dateParts[2] + 3, $dateParts[0]));

			$this->db->query("UPDATE transactions 
				SET date_borrowed = '{$dateBorrowed}', borrow_due_date = '{$borrowDue}'
				WHERE reference_material_id = '{$referenceId}'
				AND borrower_id = '{$userId}'");
		}
			
		//Return a reference material
		elseif ($flag === 'R' && $newValue < $ceilingValue){
			$newValue++;
			$this->db->query("UPDATE reference_materials SET total_available = '{$newValue}' WHERE id = '{$referenceId}'");
			$this->db->query("UPDATE transactions SET date_returned = date('Y-m-d')
				WHERE reference_material_id = '{$referenceId}'
				AND borrower_id = '{$userId}'");
		}
			
			//
	}//end of function claim_return_reference

	public function get_transactions($referenceId){
		$this->db->select('u.first_name, u.middle_name, u.last_name, u.user_type,
			t.reference_material_id, t.waitlist_rank, t.date_waitlisted, t.date_reserved,
			t.reservation_due_date, t.date_borrowed, t.borrow_due_date, t.date_returned')
			->from('users u, transactions t')
			->where('t.borrower_id = u.id');
			//->where('t.date_returned = NULL);

		return $this->db->get();
	}//end of function get_transactions

}//end of Librarian_model

?>