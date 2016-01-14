<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	public function checkUserCredentials($username, $password) {
		$userIsValid = FALSE;
		
		$sql = 'SELECT user_id
		FROM tbl_users
		WHERE fld_username = ? AND fld_userpassword = SHA1(?)';
		$query = $this->db->query ( $sql, array (
				$username,
				$password 
		) );
		
		if ($query->num_rows () > 0) {
			$userIsValid = TRUE;
		}
		
		return $userIsValid;
	}
	public function getUserRole($username) {
		$userRole = NULL;
		
		$sql = 'SELECT a.*,b.fld_firstname 
		FROM tbl_user_role a LEFT JOIN tbl_users b ON a.fld_role_id = b.role_id
		WHERE b.fld_username = ?';
		$query = $this->db->query ( $sql, $username );
		
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$userRole = array (
						'role_id' => $row->fld_role_id,
						'role_name' => $row->fld_role,
						'first_name'=> $row->fld_firstname
				);
			}
		}
		
		return $userRole;
	}
	public function getUserCenter($username) {
		$userCenter = NULL;
	
		$sql = 'SELECT fld_user_center FROM tbl_users WHERE fld_username = ?';
		$query = $this->db->query ( $sql, $username );
	
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$userCenter = array (
						'fld_user_center' => $row->fld_user_center					
				);
			}
		}
	
		return $userCenter;
	}
//check wether email address is exist or not	
	public function checkUserEmail($email) {
		$userIsValid = FALSE;
	
		$sql = 'SELECT user_id
		FROM tbl_users
		WHERE fld_email = ? AND is_active=?';
		$query = $this->db->query ( $sql, array (
				$email,1
				
		) );
	
		if ($query->num_rows () > 0) {
			$userIsValid = TRUE;
		}
	
		return $userIsValid;
	}
	
	function resetpw($email,$password){
		$data = array('fld_userpassword' => $password);		
		$this->db->trans_start();
		$this->db->where('fld_email', $email);
		$this->db->update('tbl_users', $data);
		$this->db->trans_complete();		
		return $this->db->trans_status();
	}
}
