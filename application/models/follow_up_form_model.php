<?php
class Follow_Up_Form_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	public function getFormData() {
		$formdata = $this->input->post ();
		return $formdata;
	}
	
	/*
	 * add all pst data in to separate associative arrays, to insert/update
	 * @param array $arrr: all data submit form form
	 * @param formid $form_id: form ide when update part
	 * @param integer $user_role:1=>admin,2=>aoutreach offcer, 3=>center
	 * @param string $user: username for get insert, update user
	 * @param boolean $edit: true=>update, false=>insert
	 */
	public function addDataToarrays($arrr, $form_id = '', $user_role = '', $user = '', $edit = '') {
		$followup_data = $arrr;
		
		$personal_details = '';
		$custodian_details = '';
		$treatement_progress = '';
		$feedback = '';
		$follow_up_status = '';
		if ($user_role == 2) {
			// Personal Details
			$personal_details = $this->get_array_personal_details ( $followup_data );
			// Details about Custodian
			$custodian_details = $this->get_array_custodian_details ( $followup_data );
			// status: client accept or reject following
			$follow_up_status = $this->get_array_accept_regect_statuse ( $followup_data, $user, $edit );
			if ($edit != '') {
				// Feedback about Follow Ups
				$feedback = $this->get_array_feedback ( $followup_data );
			}
		} elseif ($user_role == 3) {
			// Personal Details
			$personal_details = $this->get_array_personal_details ( $followup_data );
			// Details about Custodian
			$custodian_details = $this->get_array_custodian_details ( $followup_data );
			// status: client accept or reject following
			$follow_up_status = $this->get_array_accept_regect_statuse ( $followup_data, $user, $edit );
			if ($edit != '') {
				// Progress of Treatment
				$treatement_progress = $this->get_array_treatement_progress ( $followup_data );
			}
			// Feedback about Follow Ups
			// $feedback = $this->get_array_feedback ( $followup_data );
		} else {
			// Personal Details
			$personal_details = $this->get_array_personal_details ( $followup_data );
			// Details about Custodian
			$custodian_details = $this->get_array_custodian_details ( $followup_data );
			// status: client accept or reject following
			$follow_up_status = $this->get_array_accept_regect_statuse ( $followup_data, $user );
			// Progress of Treatment
			// $treatement_progress = $this->get_array_treatement_progress ( $followup_data );
			// Feedback about Follow Ups
			// $feedback = $this->get_array_feedback ( $followup_data );
		}
		
		$formdata = array (
				'personal_details' => $personal_details,
				'custodian_details' => $custodian_details,
				'treatement_progress' => $treatement_progress,
				'feedback' => $feedback,
				'followup_status' => $follow_up_status 
		);
		
		return $formdata;
	}
	
	/*
	 * Insert personal details
	 * @param array $personal_details: contain personal details
	 */
	public function addPersonalDetails($personal_details) {
		$this->db->insert ( 'tbl_follow_up_personal_details', $personal_details );
		$last_id = $this->db->insert_id ();
		return $last_id;
	}
	
	/*
	 * insert Details about Custodian
	 *
	 * @param array $custodian_details: contain custodian details
	 * @param integer $id:form id return from above (AI)
	 */
	public function addCustodianDetails($custodian_details, $id) {
		if (! empty ( $custodian_details )) {
			$custodian_details ['form_id'] = $id;
			
			$this->db->insert ( 'tbl_follow_up_custodion_details', $custodian_details );
			$last_id = $this->db->insert_id ();
			return $last_id;
		}
	}
	
	/*
	 * Insert Progress of Treatment
	 * @param array $treatement_progress
	 * @param integer $formid: form id(AI)
	 */
	public function addTreatementProgress($treatement_progress, $formid) {
		if (! empty ( $treatement_progress )) {
			foreach ( $treatement_progress as $one_treatement_progress ) :
				$one_treatement_progress ['form_id'] = $formid;
				$this->db->insert ( 'tbl_follow_up_treatment_progress', $one_treatement_progress );
				/* $last_id = $this->db->insert_id (); */
			endforeach
			;
		}
	}
	/*
	 * Insert Feedback about Follow Ups
	 * @param array $feedback: feedback data
	 * @param integer $formid: form id(AI)
	 */
	public function addFeedback($feedback, $formid) {
		if (! empty ( $feedback )) {
			foreach ( $feedback as $one_feedback ) :
				$one_feedback ['form_id'] = $formid;
				$this->db->insert ( 'tbl_follow_up_feedback', $one_feedback );
				/* $last_id = $this->db->insert_id (); */
			endforeach
			;
		}
	}
	
	/*
	 * add status: user accept or reject followups
	 * @param array $followup_status: details for table tbl_follow_up_status
	 * @param integer $formid: form id(AI)
	 */
	function addStatus($followup_status, $formid, $user) {
		if (! empty ( $followup_status )) {
			$status_array = array (
					'fld_form_id' => $formid,
					'fld_client_accept_reject_followup' => $followup_status ['follow_up_accept_by_client'],
					'fld_client_insert_officer' => $followup_status ['client_insert_officer'],
					'fld_client_update_officer' => $followup_status ['client_update_officer'],
					'fld_client_insert_date' => $followup_status ['insert_date'],
					'fld_assigned_cente' => $followup_status ['center'],
					'fld_client_update_date' => $followup_status ['update_date'],
					'fld_assigned_by' => $followup_status ['fld_assigned_by'] 
			);
			$this->db->insert ( 'tbl_follow_up_status', $status_array );
			// if a client accept followup when filling his details in first time fill this table the date and form id
			if ($followup_status ['follow_up_accept_by_client'] == 1) {
				$accepted_user_data = array (
						'fld_form_id' => $formid,
						'fld_date' => $followup_status ['insert_date'],
						'fld_officer' => $user 
				);
				$this->db->insert ( 'tbl_follow_up_accepted_user', $accepted_user_data );
			}
		}
	}
	
	/*
	 * call all insert function inside this function
	 * @param array $formdata: all form data
	 * @param integer $userlevel: 1=>Admin,2=>outreach officer,3=>center,
	 * @param string $user: user name
	 */
	public function addFormDetails($formdata, $userlevel, $user) {
		$formdata = $this->addDataToarrays ( $formdata, '', $userlevel, $user );
		
		$personal_details = $formdata ['personal_details'];
		$custodian_details = $formdata ['custodian_details'];
		$treatement_progress = $formdata ['treatement_progress'];
		$feedback = $formdata ['feedback'];
		$client_status = $formdata ['followup_status'];
		
		$this->db->trans_start ();
		$pid = $this->addPersonalDetails ( $personal_details );
		$cid = $this->addCustodianDetails ( $custodian_details, $pid );
		$this->addTreatementProgress ( $treatement_progress, $pid );
		$this->addFeedback ( $feedback, $pid );
		$this->addStatus ( $client_status, $pid, $user );
		$this->db->trans_complete ();
		$this->db->trans_off ();
		return array (
				'bool' => true,
				'type' => 'ADD_FOLLOW_SUC' 
		);
	}
	
	// count duration between 2 dates, date1=discharged date, date2=entered date
	function countDuration($date1, $date2) {
		$datetime1 = date_create ( $date1 );
		$datetime2 = date_create ( $date2 );
		$interval = date_diff ( $datetime1, $datetime2 );
		$years = $interval->format ( '%y' );
		$months = $interval->format ( '%m' );
		$days = $interval->format ( '%d' );
		$duration = array (
				'years' => $years,
				'months' => $months,
				'days' => $days 
		);
		return $duration;
	}
	
	// change displaying date type to sql(mm-dd-yyyy to yyyy-mm-dd)
	function changeDateFormat($date) {
		$timestamp = strtotime ( $date );
		$newDate = date ( "Y-m-d", $timestamp );
		return $newDate;
	}
	
	/*
	 * select value from a given column in a given table
	 * $tablename: name of the table, $field name of the column that get data
	 *
	 */
	public function getDropDownlist($table, $field) {
		$this->db->trans_start ();
		$this->db->select ( $field );
		$this->db->from ( $table );
		$query = $this->db->get ();
		$dropdownlist = $query->result ();
		$this->db->trans_complete ();
		$this->db->trans_off ();
		return $dropdownlist;
	}
	/*
	 * public function getClientsDetails($area,$status='') {
	 * $this->db->trans_start ();
	 * $this->db->select ( 'per.form_id, per.fld_client_id,per.fld_gender, per.fld_name,per.fld_address,per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed' );
	 * $this->db->from ( 'tbl_follow_up_personal_details per' );
	 * $this->db->join ( 'tbl_follow_up_status state', 'per.form_id = state.fld_form_id' );
	 * $this->db->join ( 'tbl_users user', 'user.fld_username=state.fld_client_insert_officer' );
	 * $this->db->where ( 'user.fld_location', $area );
	 * if ($status!=''){
	 * $this->db->where ( 'state.fld_client_accept_reject_followup', $status );
	 * }
	 * $query = $this->db->get ();
	 * $clients_data = $query->result ();
	 * $this->db->trans_complete ();
	 * $this->db->trans_off ();
	 * return $clients_data;
	 * }
	 */
	/*
	 *
	 * @param unknown $users
	 * @param unknown $user_center
	 */
	public function getClientsDetails($users, $user_center) {
		$clients_data_My_reject = '';
		$clients_data_My_accept = '';
		$clients_data_others_reject = '';
		$clients_data_others_accept = '';
		$clients_data_others_assigned_to_other = '';
		$clients_data_assigned_to_me = '';
		
		if ($user_center != 1) {
			$clients_data_My_accept = $this->get_client_details ( $users, 1, $user_center );
		} else {
			// 1.get details for client
			// 0
			$clients_data_My_reject = $this->get_client_details ( $users, 0, '' );
			// 1
			$clients_data_My_accept = $this->get_client_details ( $users, 1, '' );
			
			// get client details that assign by center or admin
			$clients_data_assigned_to_me = $this->get_client_details ( $users, 1, '', true );
			// 2.get list of assign officers
			$user_assignet_to_me = $this->get_client_array ( $users );
			
			if (! empty ( $user_assignet_to_me )) {
				// 3.get details of assign officer's clients
				// 0
				$clients_data_others_reject = $this->get_client_details ( $user_assignet_to_me, 0, '' );
				// 1
				$clients_data_others_accept = $this->get_client_details ( $user_assignet_to_me, 1, '' );
				// assigned
				$clients_data_others_assigned_to_other = $this->get_client_details ( $user_assignet_to_me, 1, '', true );
			}
		}
		$client_details = array (
				'clients_data_My_reject' => $clients_data_My_reject,
				'clients_data_My_accept' => $clients_data_My_accept,
				'clients_data_others_reject' => $clients_data_others_reject,
				'clients_data_others_accept' => $clients_data_others_accept,
				'clients_data_others_assigned_to_other' => $clients_data_others_assigned_to_other,
				'clients_data_assigned_to_me' => $clients_data_assigned_to_me 
		);
		return $client_details;
	}
	// get details My-0, My-1, Other-0, Other-1
	/*
	 *
	 * @param string $users: user name or uses ARRAY(officers to assigne to the officer)
	 * @param integer $stat: 0(accepted follw up)/1(reject follow up)
	 * @param integer $center:1=>not assigne center, 1,2,....(other centers)
	 * @param boolean $assigned_to_me: true:for checking assigned clends from center/admin /fale:otherwice
	 */
	function get_client_details($users, $stat, $center = '', $assigned_to_me = '') {
		// 0
		$this->db->select ( 'per.form_id, per.fld_client_id,per.fld_gender, per.fld_name,per.fld_address,per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_free_drug' );
		$this->db->from ( 'tbl_follow_up_personal_details per' );
		$this->db->join ( 'tbl_follow_up_status state', 'per.form_id = state.fld_form_id' );
		// $this->db->where ( 'state.fld_client_insert_officer', $users );
		if ($assigned_to_me == true) {
			// geting details for assigned client(from center/admin)
			$this->db->where_in ( 'state.fld_assigned_by', $users );
		} elseif ($center != 1 && $center != '' && $center !== 0) {
			// if center is given(center user) then, check the center
			$this->db->where ( 'state.fld_assigned_cente', $center );
		} else {
			// to getting clients data OF officers assigned to the officer
			$this->db->where_in ( 'state.fld_client_insert_officer', $users );
		}
		$this->db->where ( 'state.fld_client_accept_reject_followup', $stat );
		$query = $this->db->get ();
		$clients_data_My_reject = $query->result ();
		return $clients_data_My_reject;
	}
	
	/*
	 * get list of client details as a array: array(ashan,neranja,rupasinghe)
	 * especialy need for getting outreach officers details assigned for onother outreach officer
	 *
	 */
	function get_client_array($user) {
		// 2.get list of assign officers
		$this->db->select ( 'fld_username' );
		$this->db->from ( 'tbl_users' );
		$this->db->where ( 'fld_assigned_to', $user );
		$query = $this->db->get ();
		$user_assignet_to_me = $query->result ();
		$array = [ ];
		for($i = 0; $i < count ( $user_assignet_to_me ); $i ++) {
			$array [] = $user_assignet_to_me [$i]->fld_username;
		}
		/*
		 * $user_string = "'";
		 * for($i = 0; $i < count ( $user_assignet_to_me ); $i ++) {
		 * $user_string .= $user_assignet_to_me [$i]->fld_username;
		 * if ($i != count ( $user_assignet_to_me ) - 1) {
		 * $user_string .= ",";
		 * }
		 * }
		 * $user_string .= "'";
		 * return $user_string;
		 */
		return $array;
		// user list as an array,
	}
	/*
	 *
	 * @param integer $id: form Id (Auto Incriment)
	 */
	public function getClientDetails($id) {
		$this->db->trans_start ();
		/*
		 * did not write join query because tables are in good not normal forms
		 */
		/*
		 * $this->db->select ( 'per.*,
		 * cust.fld_name as cust_fld_name,
		 * cust.fld_address as cust_fld_address,
		 * cust.fld_contact_mobile as cust_fld_contact_mobile,
		 * cust.fld_contact_fixed as cust_fld_contact_fixed,
		 * cust.fld_relationship as cust_fld_relationship,
		 * cust.fld_relationship_other as cust_fld_relationship_other
		 *
		 * ' );
		 * $this->db->from ( 'tbl_follow_up_personal_details per' );
		 * $this->db->join ( 'tbl_follow_up_custodion_details cust', 'per.form_id = cust.form_id' );
		 */
		/*
		 * $this->db->join ( 'tbl_follow_up_treatment_progress treat', 'treat.form_id=per.form_id' );
		 * $this->db->join ( 'tbl_follow_up_feedback fd', 'fd.form_id=per.form_id' );
		 */
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_follow_up_personal_details' );
		$this->db->where ( 'form_id', $id );
		$query = $this->db->get ();
		$personal = $query->result ();
		
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_follow_up_custodion_details' );
		$this->db->where ( 'form_id', $id );
		$query = $this->db->get ();
		$custodion = $query->result ();
		
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_follow_up_treatment_progress' );
		$this->db->where ( 'form_id', $id );
		$query = $this->db->get ();
		$treatment_progress = $query->result ();
		
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_follow_up_feedback' );
		$this->db->where ( 'form_id', $id );
		$query = $this->db->get ();
		$feedback = $query->result ();
		
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_follow_up_status' );
		$this->db->where ( 'fld_form_id', $id );
		$query = $this->db->get ();
		$follow_status = $query->result ();
		
		$this->db->trans_complete ();
		$this->db->trans_off ();
		
		/*
		 * $this->db->select ( 'fld_client_accept_reject_followup' );
		 * $this->db->from ( 'tbl_follow_up_status' );
		 * $this->db->where ( 'fld_form_id', $id );
		 * $query = $this->db->get ();
		 * $results = $query->row_array ();
		 * $followup_status= $results ['fld_client_accept_reject_followup'];
		 */
		
		$client = array (
				'personal' => $personal,
				'custodion' => $custodion,
				'treatment_progress' => $treatment_progress,
				'feedback' => $feedback,
				'follow_status' => $follow_status 
		);
		return $client;
	}
	/*
	 * function editFormDetails($formdata, $form_id) {
	 * $formdata = $this->addDataToarrays ( $formdata );
	 *
	 * $personal_details = $formdata ['personal_details'];
	 * $custodian_details = $formdata ['custodian_details'];
	 * $treatement_progress = $formdata ['treatement_progress'];
	 * $feedback = $formdata ['feedback'];
	 *
	 * $this->db->trans_start ();
	 * $this->editPersonalDetails ( $personal_details, $form_id );
	 * $this->editCustodianDetails ( $custodian_details, $form_id );
	 * $this->editTreatementProgress ( $treatement_progress, $form_id );
	 * $this->editFeedback ( $feedback, $form_id );
	 * $this->db->trans_complete ();
	 * $this->db->trans_off ();
	 * return array (
	 * 'bool' => true,
	 * 'type' => 'EDIT_FOLLOW_SUC'
	 * );
	 * }
	 */
	/*
	 * UPDAE A CLIENT: Call form details edit functions for edding client details
	 * @param array $formdata: full set of data
	 * @param integer $userlevel: to identyfy update privilages, for checkin which data contain in the $form data array
	 * @param username $user: user name(for identify update user and update privilages)
	 * @param integer $form_id: form ID (Auto Increment)
	 */
	function editFormDetails($formdata, $userlevel, $user, $form_id) {
		$formdata = $this->addDataToarrays ( $formdata, '', $userlevel, $user, $edit = true );
		
		$personal_details = $formdata ['personal_details'];
		$custodian_details = $formdata ['custodian_details'];
		$treatement_progress = $formdata ['treatement_progress'];
		$feedback = $formdata ['feedback'];
		$client_status = $formdata ['followup_status'];
		print'<pre>';
		print_r($client_status);
		
		
		$this->db->trans_start ();
		$this->editPersonalDetails ( $personal_details, $form_id );
		$this->editCustodianDetails ( $custodian_details, $form_id );
		$this->editTreatementProgress ( $treatement_progress, $form_id );
		$this->editFeedback ( $feedback, $form_id );
		$this->editStatus ( $client_status, $form_id, $user );
		$this->db->trans_complete ();
		$this->db->trans_off ();
		return array (
				'bool' => true,
				'type' => 'EDIT_FOLLOW_SUC' 
		);
	}
	/*
	 * update Table tbl_follow_up_personal_details
	 * @param array $personal_details:contain new values for updating
	 * @param unknown $form_id
	 */
	function editPersonalDetails($personal_details, $form_id) {
		$this->db->where ( 'form_id', $form_id );
		$this->db->update ( 'tbl_follow_up_personal_details', $personal_details );
	}
	/*
	 * update Table tbl_follow_up_custodion_details
	 * @param array $custodian_details:contain new values for updating
	 * @param unknown $form_id
	 */
	function editCustodianDetails($custodian_details, $form_id) {
		array_splice ( $custodian_details, 0, 1 ); // remove fieled id from the array
		if (! empty ( $custodian_details )) {
			$this->db->where ( 'form_id', $form_id );
			$this->db->update ( 'tbl_follow_up_custodion_details', $custodian_details );
		}
	}
	/*
	 * update Table tbl_follow_up_treatment_progress
	 * @param array $treatement_progress: contain new values for updating
	 * @param unknown $form_id: form ID
	 */
	function editTreatementProgress($treatement_progress, $form_id) {
		if (! empty ( $treatement_progress )) {
			$this->db->delete ( 'tbl_follow_up_treatment_progress', array (
					'form_id' => $form_id 
			) );
			
			$this->addTreatementProgress ( $treatement_progress, $form_id );
		}
	}
	/*
	 * update Table tbl_follow_up_feedback
	 * @param array $feedback:contain new values for updating
	 * @param unknown $form_id: form id
	 */
	function editFeedback($feedback, $form_id) {
		if (! empty ( $feedback )) {
			$this->db->delete ( 'tbl_follow_up_feedback', array (
					'form_id' => $form_id 
			) );
			$this->addFeedback ( $feedback, $form_id );
		}
	}
	/*
	 * update Table tbl_follow_up_status
	 * @param array $client_status: contain value for updating
	 * @param unknown $form_id: update form id
	 */
	function editStatus($client_status, $form_id, $user) {
		$array = array (
				'fld_client_accept_reject_followup' => $client_status ['follow_up_accept_by_client'],
				'fld_client_update_officer' => $client_status ['client_update_officer'],
				'fld_client_update_date' => $client_status ['update_date'],
				'fld_assigned_cente' => $client_status ['center'] 
		);
		
		if (isset($client_status ['fld_free_drug']) && !empty($client_status ['fld_free_drug'])){
			//2015-11-18,
			$array['fld_free_drug'] = $client_status ['fld_free_drug'];
		}
		
/* 		print_r($array);
		die(); */
		if (! empty ( $client_status )) {
			$this->db->where ( 'fld_form_id', $form_id );
			$this->db->update ( 'tbl_follow_up_status', $array );
			
			// in the first time of free from drug status check, this part run
			$check_input_where_array = array (
					'fld_form_id' => $form_id 
			);
			
			$available = $this->isAvailable ( 'tbl_drug_free_user', 'fld_form_id', $check_input_where_array );
			if ($client_status ['fld_free_drug'] == 1 && ! $available) {
				$today = date ( "Y-m-d H:i:s" );
				$data = array (
						'fld_form_id' => $form_id,
						'fld_date' => $today,
						'fld_officer' => $user 
				);
				$this->db->insert ( 'tbl_drug_free_user', $data );
			}
			// when a client accept follow ap after a time from first filling his details, this tbl fill those date and form ids
			$available_in_follow_up_accepted_user_table = $this->isAvailable ( 'tbl_follow_up_accepted_user', 'fld_form_id', $check_input_where_array );
			if ($client_status ['follow_up_accept_by_client'] == 1 && ! $available_in_follow_up_accepted_user_table) {
				$accepted_user_data = array (
						'fld_form_id' => $form_id,
						'fld_date' => $client_status ['update_date'],
						'fld_officer' => $user 
				);
				$this->db->insert ( 'tbl_follow_up_accepted_user', $accepted_user_data );
			}
		}
	}
	
	/* **********functions for getting arrays for personal,feedback, custodian,treatment progress */
	/*
	 * preparing array for personal details
	 * @param array $followup_data
	 */
	function get_array_personal_details($followup_data) {
		// Personal Details
		if ($followup_data ['edu-level'] != 'Other') {
			$followup_data ['scl-other'] = '-';
		}
		if ($followup_data ['med2'] == 'No') {
			$followup_data ['med3'] = '-';
		}
		if ($followup_data ['med4'] == 'No') {
			$followup_data ['med5'] = '-';
		}
		
		$formatedBDate = $this->changeDateFormat ( $followup_data ['bday'] );
		
		$personal_details = array (
				'fld_name' => $followup_data ['name'],
				'fld_client_id' => $followup_data ['cliendid'],
				'fld_gender' => $followup_data ['gende'],
				'fld_race' => $followup_data ['race'],
				'fld_religion' => $followup_data ['religion'],
				'fld_id' => $followup_data ['id'],
				'fld_address' => $followup_data ['address'],
				'fld_road_map' => $followup_data ['map'],
				'fld_if_available_link' => $followup_data ['availablelink'],
				'fld_district' => $followup_data ['district'],
				'fld_divisional_secretariats' => $followup_data ['divisional-sec'],
				'fld_birthday' => $formatedBDate,
				'fld_age' => $followup_data ['age'],
				'fld_edu_school_attempted' => $followup_data ['edu'],
				'fld_edu_level' => $followup_data ['edu-level'],
				'fld_edu_level_other' => $followup_data ['scl-other'],
				'fld_contact_mobile' => $followup_data ['mobile'],
				'fld_contact_fixed' => $followup_data ['fixed'],
				'fld_status' => $followup_data ['marrystatus'],
				'fld_no_of_children' => $followup_data ['children'],
				'fld_children_under_18' => $followup_data ['childunder18'],
				'fld_medi_hospitalized_time' => $followup_data ['med1'],
				'fld_medi_chronic_medical' => $followup_data ['med2'],
				'fld_medi_chronic_medical_descript' => $followup_data ['med3'],
				'fld_medi_pregnancy' => $followup_data ['med4'],
				'fld_medi_pregnancy_meet_doctor' => $followup_data ['med5'],
				'fld_employment' => $followup_data ['employment'],
				'fld_emp_income' => $followup_data ['income1'],
				'fld_emp_capital_for_recovery' => $followup_data ['capital-for-recovery'],
				'fld_emp_people_depend_on' => $followup_data ['people-depend-on'],
				'fld_emp_nature_of_asset' => $followup_data ['nature-of-asset'],
				'fld_legal_status_admission_by_cjs' => $followup_data ['legalstatus'],
				'fld_alcohol_drug_nature_of_depend' => $followup_data ['alc_drug1'],
				'fld_alcohol_drug_rout_of_adminstration' => $followup_data ['alc_drug2'],
				'fld_alcohol_drug_first_use_age' => $followup_data ['alc_drug3'],
				'fld_alcohol_drug_use_per_day' => $followup_data ['alc_drug4'] 
		);
		
		return $personal_details;
	}
	/*
	 * preparing array for tbl_follow_up_custodion_details
	 * @param array $followup_data
	 * @return multitype:string unknown
	 */
	function get_array_custodian_details($followup_data) {
		// Details about Custodian
		if ($followup_data ['relationship'] != 'Other') {
			$followup_data ['other-relationship'] = '-';
		}
		$custodian_details = array (
				'form_id' => '',
				'fld_name' => $followup_data ['cust_name'],
				'fld_address' => $followup_data ['cust_address'],
				'fld_contact_mobile' => $followup_data ['cust_contact_mobile'],
				'fld_contact_fixed' => $followup_data ['cust_contact_fixed'],
				'fld_relationship' => $followup_data ['relationship'],
				'fld_relationship_other' => $followup_data ['other-relationship'] 
		);
		return $custodian_details;
	}
	/*
	 * preparing array for tbl_follow_up_treatment_progress
	 * @param array $followup_data
	 * @return multitype:string unknown
	 */
	function get_array_treatement_progress($followup_data) {
		// Progress of Treatment
		for($i = 1; $i <= 15; $i ++) {
			$formatedEnteredDate = $this->changeDateFormat ( $followup_data ['progress-entered-date-p' . $i] );
			$formatedDischargedDate = $this->changeDateFormat ( $followup_data ['progress-discharge-date-p' . $i] );
			
			$attemp_center_no = $followup_data ['progress-count-table-p' . $i];
			$attempt_center = $followup_data ['progress-attempt-center-p' . $i];
			$entered_date = $formatedEnteredDate;
			$discharge_date = $formatedDischargedDate;
			$counsellor_name = $followup_data ['progress-counsellor-name-p' . $i];
			$counsellor_observ = $followup_data ['progress-counsellor-observ-p' . $i];
			$counsellor_observ_summery = $followup_data ['progress-counsellor-observ-summery-p' . $i];
			/* count duration */
			
			$duration = $this->countDuration ( $entered_date, $discharge_date );
			$years = $duration ['years'];
			$months = $duration ['months'];
			$days = $duration ['days'];
			if ($attemp_center_no == NULL) {
				continue;
			}
			
			$treatement_progress [$attemp_center_no] = array (
					'fld_attempt' => $attemp_center_no,
					'fld_attempt_centet' => $attempt_center,
					'fld_enter_date' => $entered_date,
					'fld_discharge_date' => $discharge_date,
					'fld_counsellor_name' => $counsellor_name,
					'fld_counsellor_observation' => $counsellor_observ,
					'fld_counsellor_summary' => $counsellor_observ_summery,
					'fld_duration_y' => $years,
					'fld_duration_m' => $months,
					'fld_duration_d' => $days,
					'form_id' => '' 
			);
		}
		return $treatement_progress;
	}
	/*
	 * prepare an array for tbl_follow_up_feedback
	 * @param array $followup_data
	 * @return multitype:string unknown
	 */
	function get_array_feedback($followup_data) {
		if (! empty ( $followup_data )) {
			// Feedback about Follow Ups
			for($j = 1; $j <= 15; $j ++) {
				if ($followup_data ['Status-of-Client-table-f' . $j] != 'Abstinent') {
					$followup_data ['Status-of-Client-if-abstinent-table-f' . $j] = '-';
				}
				
				$formatedDate = $this->changeDateFormat ( $followup_data ['feed-back-date-table-f' . $j] );
				$feedback_no = $followup_data ['count-table-f' . $j];
				$feedback_date = $formatedDate;
				$feedback_place = $followup_data ['feed-back-place-table-f' . $j];
				$officer_name = $followup_data ['Name-of-Follow-up-Officer-table-f' . $j];
				$activities = $followup_data ['activities-table-f' . $j];
				$client_status = $followup_data ['Status-of-Client-table-f' . $j];
				$client_status_if_abstinent = $followup_data ['Status-of-Client-if-abstinent-table-f' . $j];
				$rh_from_family = $followup_data ['from-family-members-table-f' . $j];
				$rh_from_relation = $followup_data ['from-relation-table-f' . $j];
				$rh_from_neighbour = $followup_data ['from-neighbour-table-f' . $j];
				$rh_to_family = $followup_data ['to-family-members-table-f' . $j];
				$rh_to_relation = $followup_data ['to-relation-table-f' . $j];
				$rh_to_neighbour = $followup_data ['to-neighbour-table-f' . $j];
				$employment = $followup_data ['feedback-employment-table-f' . $j];
				$income = $followup_data ['feedback-income-table-f' . $j];
				
				$client_feedback = $followup_data ['Clients-Feedback-table-f' . $j];
				$officer_observations = $followup_data ['Officers-Observations-table-f' . $j];
				if ($feedback_no == NULL) {
					continue;
				}
				$feedback [$feedback_no] = array (
						'fld_follow_up_no' => $feedback_no,
						'fld_date' => $feedback_date,
						'fld_place' => $feedback_place,
						'fld_officer_name' => $officer_name,
						'fld_activities' => $activities,
						'fld_client_status' => $client_status,
						'fld_if_abstinent' => $client_status_if_abstinent,
						'fld_respect_and_honour_from_family' => $rh_from_family,
						'fld_respect_and_honour_from_relation' => $rh_from_relation,
						'fld_respect_and_honour_from_neighbour' => $rh_to_neighbour,
						'fld_respect_and_honour_to_family' => $rh_to_family,
						'fld_respect_and_honour_to_relation' => $rh_to_relation,
						'fld_respect_and_honour_to_neighbour' => $rh_to_neighbour,
						'fld_employment' => $employment,
						'fld_Income' => $income,
						'fld_clientsfeedback' => $client_feedback,
						'fld_officer_bservation' => $officer_observations,
						'form_id' => '' 
				);
			}
		}
		return $feedback;
	}
	/*
	 * prepare array for tbl_follow_up_status
	 * @param array $followup_data
	 * @param string $user: user name
	 * @param string $edit: for edit client
	 * @return Ambigous <multitype:, multitype:string unknown number , multitype:unknown string >
	 */
	function get_array_accept_regect_statuse($followup_data, $user = '', $edit = '') {
		if (isset ( $followup_data ['follow-up-accept'] ) && $followup_data ['follow-up-accept'] == 'on') {
			// accept/reject switch on
			$follow_up_accept = 1;
		} else {
			// accept/reject switch off
			$follow_up_accept = 0;
		}
		
		if (isset ( $followup_data ['free-from-drug'] ) && $followup_data ['free-from-drug'] == 'on') {
			// accept/reject switch on
			$free_from_drug = 1;
		} else {
			// accept/reject switch off
			$free_from_drug = 0;
		}
		
		$follow_up_status = [ ];
		$today = date ( "Y-m-d H:i:s" );
		$assigned_out_officer = NULL;
		if ($edit == '') {
			/* $assigned_out_officer = NULL; */
			if (isset ( $followup_data ['assigned-out-officer'] )) {
				// if there is assigne outreach officer(add by admin or center)
				$assigned_out_officer = $followup_data ['assigned-out-officer'];
			}
			$follow_up_status = array (
					'follow_up_accept_by_client' => $follow_up_accept,
					'client_insert_officer' => $user,
					'client_update_officer' => $user,
					'insert_date' => $today,
					'center' => $followup_data ['outrich-assigned-center'],
					'update_date' => $today,
					'fld_assigned_by' => $assigned_out_officer 
			); // to adding bool value(1/0) 1: if client accept, 0: client rejected
		} else {
			if (isset ( $followup_data ['assigned-out-officer'] )) {
				$assigned_out_officer = $followup_data ['assigned-out-officer'];
			}
			$follow_up_status = array (
					'follow_up_accept_by_client' => $follow_up_accept,
					'client_update_officer' => $user,
					'update_date' => $today,
					'center' => $followup_data ['outrich-assigned-center'],
					'fld_assigned_by' => $assigned_out_officer,
					'fld_free_drug' => $free_from_drug 
			);
		}
		return $follow_up_status;
	}
	/*
	 * get user location when give user name
	 * @param string $user: user name
	 * @return unknown
	 */
	function getOfficerArea($user) {
		$this->db->select ( 'fld_location' );
		$this->db->from ( 'tbl_users' );
		$this->db->where ( 'fld_username', $user );
		$query = $this->db->get ();
		$results = $query->row_array ();
		return $results ['fld_location'];
	}
	/*
	 * getting ACTIVE list of outreach officers
	 * @return unknown
	 */
	function get_outreach_officer_list() {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_users' );
		$this->db->where ( 'is_active', 1 );
		$this->db->where ( 'role_id', 2 );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	// get client details for displaying on Admin(user level-1) panel
	function getClientsDetails_for_admin() {
		// follow approver---center()assigned center||tbl_follow_up_status.fld_client_accept_reject_followup==1 && tbl_follow_up_status.fld_assigned_cente=$center
		// follow approver---officer()not assign center||tbl_follow_up_status.fld_client_accept_reject_followup==1 && tbl_follow_up_status.fld_assigned_cente=1
		// followed not approved-----all Island||tbl_follow_up_status.fld_client_accept_reject_followup==0
		$centers_list = $this->getDropDownlist ( 'tbl_follow_up_centers', 'id,fld_center_name' );
		
		$centers = [ ];
		foreach ( $centers_list as $center ) {
			$centers [$center->id] = $center->fld_center_name;
		}
		
		/*
		 * $centers = array (
		 * 1 => 'not assign',
		 * 2 => 'center one',
		 * 3 => 'center two',
		 * 4 => 'center three',
		 * 5 => 'center four',
		 * 6 => 'center five'
		 * );
		 */
		$client = [ ];
		// $arr_count = count ( $centers );
		/*
		 * for ($i=$arr_count;$i>0;$i--){
		 * $client[$i]=$this->get_drug_users(1,$i);//
		 * }
		 */
		$arr = $this->get_drug_users ( 0 ); // follow up not accepted,
		$client [0] = array (
				'center_id' => '0',
				'center_name' => 'reject',
				'details' => $arr 
		);
		foreach ( $centers as $center_id => $center_name ) {
			$arr = $this->get_drug_users ( 1, $center_id );
			$client [$center_id] = array (
					'center_id' => $center_id,
					'center_name' => $center_name,
					'details' => $arr 
			);
		}
		
		return $client;
	}
	/*
	 * getting list of clents: all client=>accept/reject,Center Vice clients=>accept/reject
	 * @param integer $status: folloe up accepted=>1, follow up rejected=>2
	 * @param integer $center:
	 * @return unknown
	 */
	function get_drug_users($status, $center = '') {
		$this->db->select ( 'per.form_id, per.fld_client_id,per.fld_gender, per.fld_name,per.fld_address,per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_free_drug' );
		$this->db->from ( 'tbl_follow_up_personal_details per' );
		$this->db->join ( 'tbl_follow_up_status state', 'per.form_id = state.fld_form_id' );
		if ($center != '') {
			$this->db->where ( 'state.fld_assigned_cente', $center );
		}
		$this->db->where ( 'state.fld_client_accept_reject_followup', $status );
		$query = $this->db->get ();
		$list = $query->result ();
		return $list;
	}
	
	/*
	 * for getting a user details using search query
	 * @param string $gender: male/Female
	 * @param integer $form_id: form id(Auto Increment)
	 * @param string $name: Name
	 * @param string $address: a part of the address no need full address
	 * @param string $nic: National Identiti card number xxxxxxxxxV
	 * @param string $client_id: client id given by the centers/officers
	 * @param string $phone: Mobile
	 * @param string $phone2: Fixed Line
	 * @param integer $role: 1=>admin, 2=> outreach officer, 3=>center
	 * @param string $user: if user is in user level 2(outreach officer), give user name for checkin, client add by him, client assign to him, other client(others outreac officers that asigned to the officer)
	 * @param integer $center: if user is in user level 3(center level), give center id for serch users assign to the center
	 */
	function get_search_results($gender = "", $form_id = "", $name = "", $address = "", $nic = "", $client_id = "", $phone = "", $phone2 = "", $role, $user = "", $center = "") {
		$where_array = [ ];
		$like_array = [ ];
		$or_where_array = [ ];
		$result = [ ];
		if ($gender != 'null__') {
			$where_array ['per.fld_gender'] = $gender;
		}
		if ($form_id != 'null__') {
			$where_array ['per.form_id'] = $form_id;
		}
		if ($name != 'null__') {
			$like_array ['per.fld_name'] = $name;
		}
		if ($address != 'null__') {
			$like_array ['per.fld_address'] = $address;
		}
		if ($nic != 'null__') {
			$where_array ['per.fld_id'] = $nic;
		}
		if ($client_id != 'null__') {
			$where_array ['per.fld_client_id'] = $client_id;
		}
		if ($phone != 'null__') {
			// $where_array ['per.fld_contact_mobile'] = $phone;
			$where_array ['per.fld_contact_mobile'] = $phone;
		}
		if ($phone2 != 'null__') {
			// $where_array ['per.fld_contact_mobile'] = $phone;
			$where_array ['per.fld_contact_fixed'] = $phone2;
		}
		
		// $where .= $gender_f . $form_id_f . $name_f . $address_f . $nic_f . $client_id_f . $phone_f;
		if ($user == "null__") {
			/* admin level serach */
			$this->db->trans_start ();
			$this->db->select ( 'per.form_id,per.fld_client_id, per.fld_gender, per.fld_name, per.fld_address, per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_client_accept_reject_followup,state.fld_free_drug' );
			$this->db->from ( 'tbl_follow_up_personal_details as per' );
			$this->db->join ( 'tbl_follow_up_status as state', 'per.form_id=state.fld_form_id' );
			$this->db->where ( $where_array );
			$this->db->like ( $like_array );
			$this->db->or_where ( $or_where_array );
			$query = $this->db->get ();
			$result = $query->result ();
			$this->db->trans_complete ();
			$this->db->trans_off ();
		} else {
			if ($center == "null__") {
				/* outreach officer level serach */
				/* outreach officer insert clients, other client (assign to this officer form other assign officers for him) */
				$username_assign_for_me = $this->get_client_array ( $user );
				$username_assign_for_me [] = $user;
				$this->db->trans_start ();
				$this->db->select ( 'per.form_id,per.fld_client_id, per.fld_gender, per.fld_name, per.fld_address, per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_client_accept_reject_followup,state.fld_free_drug' );
				$this->db->from ( 'tbl_follow_up_personal_details as per' );
				$this->db->join ( 'tbl_follow_up_status as state', 'per.form_id=state.fld_form_id' );
				$this->db->like ( $like_array );
				$this->db->where ( $where_array );
				$this->db->where_in ( 'state.fld_client_insert_officer', $username_assign_for_me );
				//$this->db->or_where_in('state.fld_assigned_by', $username_assign_for_me);//2015-10-28 for assigned use for another officer that asigned for me 
				$query = $this->db->get ();
				$result1 = $query->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
				/* --------------------- */
				/* client assigned by centers or admin for me or for another user that assigned for me */
				//$where_array ['fld_assigned_by'] = $user; 2015-10-28
				$username_assign_for_me[]=$user;
				$this->db->trans_start ();
				$this->db->select ( 'per.form_id,per.fld_client_id, per.fld_gender, per.fld_name, per.fld_address, per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_client_accept_reject_followup,state.fld_free_drug' );
				$this->db->from ( 'tbl_follow_up_personal_details as per' );
				$this->db->join ( 'tbl_follow_up_status as state', 'per.form_id=state.fld_form_id' );
				$this->db->like ( $like_array );
				$this->db->where ( $where_array );
				$this->db->where_in('state.fld_assigned_by', $username_assign_for_me);//2015-10-28
				$query = $this->db->get ();
				$result2 = $query->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
				/* ---------------- */
				/* mearge above both results */
				$result = array_merge ( $result1, $result2 );
			} else {
				/* center level search */
				$where_array ['state.fld_assigned_cente'] = $center;
				$this->db->trans_start ();
				$this->db->select ( 'per.form_id,per.fld_client_id, per.fld_gender, per.fld_name, per.fld_address, per.fld_id, per.fld_contact_mobile, per.fld_contact_fixed,state.fld_client_accept_reject_followup,state.fld_free_drug' );
				$this->db->from ( 'tbl_follow_up_personal_details as per' );
				$this->db->join ( 'tbl_follow_up_status as state', 'per.form_id=state.fld_form_id' );
				$this->db->like ( $like_array );
				$this->db->where ( $where_array );
				$query = $this->db->get ();
				$result = $query->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
			}
		}
		return $result;
		// return array('where'=>$where_array,'like'=>$like_array,'or_where'=>$or_where_array);
	}
	/*
	 * get summery details for seperate user level between start date and end date including both dates
	 * @param string $start_date: state day for getting summery
	 * @param string $end_date: end date for getting summey
	 * @param integer $user_level: 1=>admin, 2=>aoutreach officer, 3=>center
	 * @param string $username: usename
	 * @param integer $center_id: 1=>not a center, others(2,3,...)=>for centers
	 * @return multitype:NULL
	 */
	function get_summery($start_date = "", $end_date = "", $user_level = "", $username = "", $center_id = "") {
		/*
		 * --test data--
		 * $start_timestamp = strtotime ( $start_date );
		 * $start_date = date ( "Y-m-d", $start_timestamp );
		 * $end_timestamp = strtotime ( $end_date );
		 * $end_date = date ( "Y-m-d", $end_timestamp );
		 */
		$result = [ ]; // return array with results
		$centter_table = 'tbl_follow_up_centers'; // table name that include centers EX: tbl_follow_up_centers['id','centrname']
		$checking_table_field_fordate = "state.fld_client_insert_date"; // field for checking date,
		switch ($user_level) {
			case 1 :
				// admin level
				$this->db->trans_start ();
				// all identified user user center one to more
				$sql_one_to_more = "select cent.id,cent.fld_center_name,per.fld_gender,state.fld_client_accept_reject_followup,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id JOIN " . $centter_table . " as cent ON cent.id=state.fld_assigned_cente WHERE cent.id NOT IN (1) AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, state.fld_assigned_cente,state.fld_client_accept_reject_followup order by cent.id";
				$query_one_to_more = $this->db->query ( $sql_one_to_more );
				$result ['center_one_to_more'] = $query_one_to_more->result (); //
				                                                                
				// drug ftee user, insert date bitween date1 to date2
				$sql_free_drug_one_to_more = "select cent.id,cent.fld_center_name,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id JOIN " . $centter_table . " as cent ON cent.id=state.fld_assigned_cente join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE cent.id NOT IN (1) AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, state.fld_assigned_cente order by cent.id";
				$query_free_drug_one_to_more = $this->db->query ( $sql_free_drug_one_to_more );
				$result ['center_free_drug_one_to_more'] = $query_free_drug_one_to_more->result ();
				// user follow up accepted but not assigned to a center, insert date between date 1 and date 2
				$accept_sql_not_assign_to_center = "select cent.id,cent.fld_center_name,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id JOIN " . $centter_table . " as cent ON cent.id=state.fld_assigned_cente WHERE cent.id = 1 AND state.fld_client_accept_reject_followup = 1 AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, state.fld_assigned_cente order by cent.id";
				$accept_query_not_assign_to_center = $this->db->query ( $accept_sql_not_assign_to_center );
				$result ['accept_not_assign_to_center'] = $accept_query_not_assign_to_center->result ();
				// drug free users insert date between date 1 and date 2
				$accept_sql_drug_free_not_assign_to_center = "select cent.id,cent.fld_center_name,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id JOIN " . $centter_table . " as cent ON cent.id=state.fld_assigned_cente join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE cent.id = 1 AND state.fld_client_accept_reject_followup = 1 AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, state.fld_assigned_cente order by cent.id";
				$accept_query_free_drug_not_assign_to_center = $this->db->query ( $accept_sql_drug_free_not_assign_to_center );
				$result ['accept_free_drug_not_assign_to_center'] = $accept_query_free_drug_not_assign_to_center->result ();
				
				// rejected folowing
				$reject_sql_not_assign_to_center = "select cent.id,cent.fld_center_name,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id JOIN " . $centter_table . " as cent ON cent.id=state.fld_assigned_cente WHERE cent.id = 1 AND state.fld_client_accept_reject_followup = 0 AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, state.fld_assigned_cente order by cent.id";
				$reject_query_not_assign_to_center = $this->db->query ( $reject_sql_not_assign_to_center );
				$result ['reject_not_assign_to_center'] = $reject_query_not_assign_to_center->result ();
				
				// drugvice all in given time period : checking insert date
				// $sql_drug_vice_all="select per.fld_alcohol_drug_nature_of_depend,per.fld_gender,state.fld_client_accept_reject_followup,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, per.fld_alcohol_drug_nature_of_depend, state.fld_client_accept_reject_followup order by per.fld_alcohol_drug_nature_of_depend";
				// $sql_drug_vice_all="select per.fld_alcohol_drug_nature_of_depend, per.fld_gender, count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$sql_drug_vice_all = "select per.fld_alcohol_drug_nature_of_depend, count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$query_drug_vice_all = $this->db->query ( $sql_drug_vice_all );
				$result ['drug_vice_all_admin'] = $query_drug_vice_all->result ();
				
				// all registerd user in given period, checking accepted date
				// $sql_drug_vice_accept_admin="select per.fld_alcohol_drug_nature_of_depend,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_follow_up_accepted_user as accept ON accept.fld_form_id=per.form_ID WHERE accept.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$sql_drug_vice_accept_admin = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_follow_up_accepted_user as accept ON accept.fld_form_id=per.form_ID WHERE accept.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$query_drug_vice_accept = $this->db->query ( $sql_drug_vice_accept_admin );
				$result ['drug_vice_accept_admin'] = $query_drug_vice_accept->result ();
				
				// all free drug users in given time period, checking drug free date
				// $sql_drug_vice_free="select per.fld_alcohol_drug_nature_of_depend,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as free ON free.fld_form_id=per.form_ID WHERE free.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_gender, per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$sql_drug_vice_free = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as free ON free.fld_form_id=per.form_ID WHERE free.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				
				$query_drug_vice_free = $this->db->query ( $sql_drug_vice_free );
				$result ['drug_vice_free_admin'] = $query_drug_vice_free->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
				
				break;
			case 2 :
				// outreach officer level
				$this->db->trans_start ();
				$sql_accept_my_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_client_insert_officer='" . $username . "' AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
				$query_accept_my_client = $this->db->query ( $sql_accept_my_client );
				$result ['accept_my_client'] = $query_accept_my_client->result ();
				// count free from drug
				$sql_count_free_drug_accept_my_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_client_insert_officer='" . $username . "' AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by fld_gender";
				$query_count_free_drug_accept_my_client = $this->db->query ( $sql_count_free_drug_accept_my_client );
				$result ['free_drug_my_client'] = $query_count_free_drug_accept_my_client->result ();
				
				$sql_reject_my_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_client_insert_officer='" . $username . "' AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 0 group by per.fld_gender";
				$query_reject_my_client = $this->db->query ( $sql_reject_my_client );
				$result ['reject_my_client'] = $query_reject_my_client->result ();
				
				$assigned_officers_for_me = $this->get_client_array ( $username );
				$where_in = "";
				for($i = 0; $i < count ( $assigned_officers_for_me ); $i ++) {
					$where_in .= "'" . $assigned_officers_for_me [$i] . "'";
					if ($i != count ( $assigned_officers_for_me ) - 1) {
						$where_in .= ",";
					}
				}
				if ($where_in != "") {
					$sql_accept_other_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_client_insert_officer IN (" . $where_in . ") AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
					$query_accept_other_client = $this->db->query ( $sql_accept_other_client );
					$result ['accept_other_client'] = $query_accept_other_client->result ();
					
					$sql_count_free_drug_accept_other_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_client_insert_officer IN (" . $where_in . ") AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
					$query_count_free_drug_accept_other_client = $this->db->query ( $sql_count_free_drug_accept_other_client );
					$result ['free_drug_other_client'] = $query_count_free_drug_accept_other_client->result ();
					
					/*
					 * other assigned drug free user
					 */
					$sql_count_free_drug_accept_other_assigned__client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_assigned_by IN (" . $where_in . ") AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
					$query_count_free_drug_accept_other_assigned_client = $this->db->query ( $sql_count_free_drug_accept_other_assigned__client );
					$result ['free_drug_other_assigned_client'] = $query_count_free_drug_accept_other_assigned_client->result ();
				}
				if ($where_in != "") {
					$sql_reject_other_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_client_insert_officer IN (" . $where_in . ") AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 0 group by per.fld_gender";
					$query_reject_other_client = $this->db->query ( $sql_reject_other_client );
					$result ['reject_other_client'] = $query_reject_other_client->result ();
					
					/*
					 * other assigned drug free user
					 */
					$sql_assigned_other_client = 	"select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by  IN (" . $where_in . ")  AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
					//$sql_assigned_other_client =  "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by  IN ('test')  AND state.fld_client_insert_date BETWEEN '0000-00-00' and '2015-10-28' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
					$query_assigned_other_client = $this->db->query ( $sql_assigned_other_client );
					$result ['assigned_other_client'] = $query_assigned_other_client->result ();
				}
				
				$sql_assigned_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by='" . $username . "'  AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
				// fld_assigned_by: asigna user for a officer by center, admin
				$query_assigned_client = $this->db->query ( $sql_assigned_client );
				$result ['assigned_client'] = $query_assigned_client->result ();
				
				$sql_count_free_drug_assigned_client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_assigned_by='" . $username . "'  AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
				$query_count_free_drug_assigned_client = $this->db->query ( $sql_count_free_drug_assigned_client );
				$result ['free_drug_assigned_client'] = $query_count_free_drug_assigned_client->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
				break;
			case 3 :
				// center level
				$this->db->trans_start ();
				$sql_asigned_to_center = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_cente=" . $center_id . " AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
				$query_assigned_to_center = $this->db->query ( $sql_asigned_to_center );
				$result ['assigned_to_center'] = $query_assigned_to_center->result ();
				
				$sql_count_free_asigned_to_center = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_assigned_cente=" . $center_id . " AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
				$query_count_free_assigned_to_center = $this->db->query ( $sql_count_free_asigned_to_center );
				$result ['free_drug_assigned_to_center'] = $query_count_free_assigned_to_center->result ();
				
				// drugvice all client in center, in given time period checking insert date.
				$sql_drug_vice_all_center = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_cente=" . $center_id . " AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend  order  by  per.fld_alcohol_drug_nature_of_depend";
				$query_drug_vice_all_center = $this->db->query ( $sql_drug_vice_all_center );
				$result ['drug_vice_all_center'] = $query_drug_vice_all_center->result ();
				/*
				 * $sql_drug_vice_all_center="select per.fld_alcohol_drug_nature_of_depend,per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_cente=1 AND state.fld_client_insert_date BETWEEN '2015-09-27' and '2015-10-27' group by per.fld_gender order by per.fld_alcohol_drug_nature_of_depend ";
				 * $query_drug_vice_all_center=$this->db->query($sql_drug_vice_all_center);
				 * $result['drug_vice_center']=$query_drug_vice_all_center->result();
				 */
				
				// drug vice accepted user for the center, checking accepted date
				// $query_drug_vice_accept_center = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_follow_up_accepted_user as accept ON accept.fld_form_id=per.form_ID WHERE state.fld_assigned_cente=3 AND accept.fld_date BETWEEN '0000-00-00' and '2015-10-21' group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend";
				$sql_drug_vice_accept_center = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join  tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_follow_up_accepted_user as accept ON accept.fld_form_id=per.form_ID WHERE state.fld_assigned_cente=" . $center_id . " AND accept.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend ";
				$query_drug_vice_accept_center = $this->db->query ( $sql_drug_vice_accept_center );
				$result ['drug_vice_accept_center'] = $query_drug_vice_accept_center->result ();
				// drug vice free user in given time period, checking free date
				$sql_drug_vice_free_center = "select per.fld_alcohol_drug_nature_of_depend,count(*) as count from tbl_follow_up_personal_details as per join  tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as free ON free.fld_form_id=per.form_ID WHERE state.fld_assigned_cente=" . $center_id . " AND free.fld_date BETWEEN '" . $start_date . "' and '" . $end_date . "'group by per.fld_alcohol_drug_nature_of_depend order by per.fld_alcohol_drug_nature_of_depend ";
				$query_drug_vice_accept_center = $this->db->query ( $sql_drug_vice_free_center );
				$result ['drug_vice_free_center'] = $query_drug_vice_accept_center->result ();
				$this->db->trans_complete ();
				$this->db->trans_off ();
				break;
			
			default :
		}
		return $result;
	}
	/*
	 * check availability of values
	 * @param unknown $table: table name
	 * @param unknown $check_input_where_array: array('field1'=>'val1','field2'=>val2)
	 * @param unknown $select_field: field for outpu
	 * * @return boolean
	 */
	function isAvailable($table, $select_field, $check_input_where_array) {
		$this->db->select ( $select_field );
		$this->db->from ( $table );
		$this->db->where ( $check_input_where_array );
		$query = $this->db->get ();
		$results = $query->row_array ();
		$count = count ( $results );
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 
	 * @param $officer_usernameInser officer user name
	 * */
	function get_insert_officer_level_with_center($officer_username){
		$this->db->select ( 'role_id,	fld_user_center' );
		$this->db->from ( 'tbl_users' );
		$this->db->where ( 'fld_username',$officer_username );
		$query = $this->db->get ();
		$results = $query->row_array ();
		//$result=array('rolid'=>$roleid,'center_id'=>$centerid);
		return $results;
	}
	
	/**
	 * @param $center_id: id of the center
	 * return total count,center short name
	 * */
	function get_client_id($center_id,$gender){
		//$sql="select count(*) as count,centers.fld_short_name from tbl_follow_up_status as state JOIN tbl_follow_up_centers as centers ON state.fld_assigned_cente=centers.id Where state.fld_assigned_cente=".$center_id;
		$this->db->trans_start ();
		$this->db->select('COUNT(*) as count,centers.fld_short_name');
		$this->db->from('tbl_follow_up_status as state');
		$this->db->join('tbl_follow_up_centers as centers', 'state.fld_assigned_cente = centers.id');
		$this->db->join('tbl_follow_up_personal_details as per', 'per.form_id=state.fld_form_id');
		$this->db->where('state.fld_assigned_cente',$center_id);
		$this->db->where('per.fld_gender',$gender);
		$query = $this->db->get();		
		$result=$query->result ();
		$this->db->trans_complete ();
		$this->db->trans_off ();
		//$count=$this->db->count_all_results();		
		//$result=array('center'=>$result);
		return $result[0];
	}
	
	/**
	 * @param $center_id id of the center
	 * return center short name
	 */
	function get_center_short_name($center_id){
		$this->db->trans_start ();
		$this->db->select('fld_short_name');
		$this->db->from('tbl_follow_up_centers');
		$this->db->where('id',$center_id);
		$query = $this->db->get();
		$result=$query->result ();
		$this->db->trans_complete ();
		$this->db->trans_off ();
		return $result[0]->fld_short_name;
	}
	/*
	 * 
	 * @param intiger $id: client id
	 */
	function is_assignedby($id){
		$this->db->select('fld_assigned_by,fld_assigned_cente');
		$this->db->from('tbl_follow_up_status');
		$this->db->where('fld_form_id',$id);
		$query=$this->db->get();
		$result=$query->result();
		
		if (($result[0]->fld_assigned_by==NULL)||($result[0]->fld_assigned_by=!NULL && $result[0]->fld_assigned_cente!=1)){
			return false;		
		}
		else{
			return true;
		}
	}
	
	/*
	 * @param intiger $client_id: client id
	 * */
	function get_assigned_officer($client_id){
		
	}
	
	function test() {
		$checking_table_field_fordate = "state.fld_client_insert_date";
		$start_date = '0000-00-00';
		$end_date = '2015-10-23';
		$username = "out3";
		$assigned_officers_for_me = $this->get_client_array ( $username );
		$where_in = "";
		for($i = 0; $i < count ( $assigned_officers_for_me ); $i ++) {
			$where_in .= "'" . $assigned_officers_for_me [$i] . "'";
			if ($i != count ( $assigned_officers_for_me ) - 1) {
				$where_in .= ",";
			}
		}
		
		/* $sql_count_free_drug_accept_other_assigned__client = "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_assigned_by IN (" . $where_in . ") AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' group by per.fld_gender";
		$query_count_free_drug_accept_other_assigned_client = $this->db->query ( $sql_count_free_drug_accept_other_assigned__client );
		$result ['free_drug_other_assigned_client'] = $query_count_free_drug_accept_other_assigned_client->result (); */
		// select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id join tbl_drug_free_user as dfu ON per.form_id=dfu.fld_form_id WHERE state.fld_assigned_by IN ('test') AND state.fld_client_insert_date BETWEEN '0000-00-00' and '2015-10-29' group by per.fld_gender
		
		$sql_assigned_other_client = 	"select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by  IN (" . $where_in . ")  AND " . $checking_table_field_fordate . " BETWEEN '" . $start_date . "' and '" . $end_date . "' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
					//$sql_assigned_other_client =  "select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by  IN ('test')  AND state.fld_client_insert_date BETWEEN '0000-00-00' and '2015-10-28' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender";
					$query_assigned_other_client = $this->db->query ( $sql_assigned_other_client );
					$result ['assigned_other_client'] = $query_assigned_other_client->result ();
		// select per.fld_gender,count(*) as count from tbl_follow_up_personal_details as per join tbl_follow_up_status as state ON per.form_id=state.fld_form_id WHERE state.fld_assigned_by IN ('test') AND state.fld_client_insert_date BETWEEN '0000-00-00' and '2015-10-28' AND state.fld_client_accept_reject_followup = 1 group by per.fld_gender
		return $result;
	}
}