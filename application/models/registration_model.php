<?php

Class Registration_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function getDropDownlist($table,$username='') {
        $this->db->trans_start();
		if($username==''){
			$this->db->select("* from $table");
		}else{
			$this->db->select("$username from $table");
		}
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
    }

	public function addNewUser(){
		$data = array (
				'fld_username' => $this->input->post ( 'nic_no' ),
				'fld_userpassword' => SHA1($this->input->post('nic_no')) ,
				'fld_email' => $this->input->post ( 'email' ),
				'fld_firstname' => $this->input->post ( 'fname' ),
				'fld_lastname' => $this->input->post ( 'lname' ),
				'fld_location' => $this->input->post ( 'district' ),
				'fld_contactno' => $this->input->post ( 'contact' ),
				'is_active' => '1',
				'role_id' => $this->input->post ( 'user_role' ),
				'fld_assigned_to' => $this->input->post ( 'assigned_to' ),
				'fld_user_center' => $this->input->post ( 'center' ),
		);
		$this->db->trans_start();
		$this->db->insert ( 'tbl_users', $data );
		$this->db->trans_complete();
		$this->db->trans_off();
		return $data['fld_firstname'].' '.$data['fld_lastname'];
	}

//	$get_new_iden_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
//			COUNT(*) as newIdentity
//			from tbl_follow_up_status
//			inner join tbl_follow_up_personal_details
//			on tbl_follow_up_status.fld_form_id=tbl_follow_up_personal_details.form_id
//			where tbl_follow_up_status.fld_client_insert_date like '$month_timestamp%'
//			and tbl_follow_up_status.fld_client_insert_officer= '$user'
//			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
//		$query_get_new_iden_count=  $this->db->query($get_new_iden_count);
//		$result['new_iden']=$query_get_new_iden_count->result();

	### get all users from db
	public function getExistingUsers(){
        $this->db->trans_start();
        $this->db->select("* from tbl_users");
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
	}

	### get selected user details
	public function getUser($username){
		$this->db->trans_start();
		$sql = 'SELECT a.*,b.fld_role,c.fld_center_name
		FROM tbl_users a JOIN tbl_user_role b ON a.role_id = b.fld_role_id
		JOIN tbl_follow_up_centers c ON a.fld_user_center=c.id
		WHERE a.fld_username = ?';
        $query = $this->db->query($sql, $username);

		$this->db->trans_complete();
		$this->db->trans_off();
		return $query->result();
	}

	public function updateUser($username,$form_data){
		$updatedata= array(
			'fld_username' => $form_data['nic_no'],
			'fld_email' => $form_data['email'],
			'fld_firstname' => $form_data['fname'],
			'fld_lastname' => $form_data['lname'],
			'fld_location' => $form_data['district'],
			'fld_contactno' => $form_data['contact'],
			'is_active' => $form_data['is_active'],
			'role_id' => $form_data['user_role'],
			'fld_assigned_to' => $form_data['assigned_to'],
			'fld_user_center' => $form_data['center'],
		);
		$this->db->trans_start();
		$this->db->where('fld_username',$username);
		$this->db->update('tbl_users',$updatedata);
		$this->db->trans_complete();
		$this->db->trans_off();
	}

	public function check_password($old_pw,$user){
		$this->db->trans_start();
		$query = $this->db->query("select fld_userpassword from tbl_users where fld_username='$user' and fld_userpassword=SHA1('$old_pw')");

		$this->db->trans_complete();
		$this->db->trans_off();

		if ($query->num_rows() > 0){
			$is_valid=true;
		}else{
			$is_valid=false;
		}

		return $is_valid;
	}

	public function changePassword($user,$form_data){
		$updatedata= array(
			'fld_userpassword' => SHA1($form_data['new_pw'])
		);
		$this->db->trans_start();
		$this->db->where('fld_username',$user);
		$this->db->update('tbl_users',$updatedata);
		$this->db->trans_complete();
		$this->db->trans_off();
	}

}

