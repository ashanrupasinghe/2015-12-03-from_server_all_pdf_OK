<?php

Class Registration_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Registration_Model');
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->library('session');
        $this->load->database();
    }

	### Load header according to the user level###
    public function header()
    {
       // $data['user'] = $this->session->userdata('username');
    	$data ['user_name'] = $this->session->userdata ( 'username' );
    	$data ['role_id'] = $this->session->userdata ( 'role' );
    	$data ['role_name'] = $this->session->userdata ( 'role_name' );
    	$data ['user_center'] = $this->session->userdata ( 'user_center' );
    	$data ['first_name'] = $this->session->userdata ( 'first_name' );
        $this->load->view("header",$data);
    }

    public function index(){
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		if ($user == false||$user_role!=1) {			
			redirect ( site_url () . "/Login_Controller/login" );
		 } else {
		$this->header();
		$data['title']='Register';
		$data['districts']=$this->Registration_Model->getDropDownList('tbl_district');
		$data['user_role']=$this->Registration_Model->getDropDownList('tbl_user_role');
		$data['assigned_to']=$this->Registration_Model->getDropDownList('tbl_users','fld_username');
		$data['center']=$this->Registration_Model->getDropDownList('tbl_follow_up_centers');

		$this->load->view("register_user",$data);
		$this->load->view("footer");
		}
	}

	public function insertNewUser(){
		$formSubmit = $this->input->post('submit');
        if ($formSubmit == 'save') {
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
			$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'district', 'District', 'required');
			$this->form_validation->set_rules ( 'contact', 'Contact No.', 'required|callback_contactNo_validation');
			$this->form_validation->set_rules ( 'nic_no', 'NIC No.', 'required|is_unique[tbl_users.fld_username]|callback_nic_validation');
			$this->form_validation->set_rules ( 'user_role', 'User Role', 'required');
			$this->form_validation->set_rules ( 'center', 'Center', 'required');

			if($this->form_validation->run()==FALSE){
				$this->index();
			}else{
            $user = $this->Registration_Model->addNewUser();
			$this->session->set_flashdata('user', $user);
            redirect(site_url() . "/Registration_Controller");
			}
        }else if ($formSubmit == 'cancel') {
            redirect(site_url() . "/Registration_Controller");
        }
	}

	public function nic_validation($nic)
	{
		$result = TRUE;
		if($nic !=""){
		if(strlen($nic) <> 10){
		$result = FALSE;
		}

		$nic_9 = substr($nic,0,9);

		if (!is_numeric ($nic_9)){
		$result =FALSE;
		}

		$nic_v = substr($nic,9,1);
		if (is_numeric ($nic_v)){
		$result =FALSE;
		}
		$this->form_validation->set_message('nic_validation', 'The NIC No. you have given is invalid');
		}
		return $result;
	}

	public function contactNo_validation($contact){
		$result = TRUE;
		if($contact !=""){
			if(strlen($contact)<>10){
				$result=FALSE;
			}
			if(!is_numeric($contact)){
				$result=FALSE;
			}
			$this->form_validation->set_message('contactNo_validation','The Contact No. you have given is invalid');
		}
		return $result;
	}

	public function existingUsers(){
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		if ($user == false || $user_role!=1) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
		$data['users']=$this->Registration_Model->getExistingUsers();
		$data['title']='UserList';
		$this->header();
		$this->load->view("register_user",$data);
		$this->load->view("footer");
		}
	}

	### load update_user form for specific user###
	public function updateUserForm($username){
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );		
		if ($user == false||$user_role!=1) {
			redirect ( site_url () . "/Login_Controller/login" );
		 } else {
		$data['title']='Update';
		$data['user']=  $this->Registration_Model->getUser($username);
		$data['districts']=$this->Registration_Model->getDropDownList('tbl_district');
		$data['user_role']=$this->Registration_Model->getDropDownList('tbl_user_role');
		$data['assigned_to']=$this->Registration_Model->getDropDownList('tbl_users','fld_username');
		$data['center']=$this->Registration_Model->getDropDownList('tbl_follow_up_centers');

		$this->header();
		$this->load->view("register_user",$data);
		$this->load->view("footer");
		 }
	}

	### load user data for specific user to view data###
	public function viewUserForm($username){
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		
		if ($user == false||$user_role!=1) {
			redirect ( site_url () . "/Login_Controller/login" );
		 } else {
		$data['title']='View';
		$data['user']=  $this->Registration_Model->getUser($username);
		$data['districts']=$this->Registration_Model->getDropDownList('tbl_district');
		$data['user_role']=$this->Registration_Model->getDropDownList('tbl_user_role');
		$data['assigned_to']=$this->Registration_Model->getDropDownList('tbl_users','fld_username');
		$data['center']=$this->Registration_Model->getDropDownList('tbl_follow_up_centers');

		$this->header();
		$this->load->view("register_user",$data);
		$this->load->view("footer");
		 }
	}

	public function updateUser($username){
		$formsubmit=$this->input->post('submit');
		if($formsubmit=='save'){
			$user=$this->Registration_Model->getUser($username);
			if($this->input->post('nic_no') != $user[0]->fld_username) {
				$is_unique =  '|is_unique[tbl_users.fld_username]';
			} else {
				$is_unique =  '';
			}

			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
			$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'district', 'District', 'required');
			$this->form_validation->set_rules ( 'contact', 'Contact No.', 'required|callback_contactNo_validation');
			$this->form_validation->set_rules ( 'nic_no', 'NIC No.', 'required|'.$is_unique.'|callback_nic_validation');
			$this->form_validation->set_rules ( 'user_role', 'User Role', 'required');
			$this->form_validation->set_rules ( 'center', 'Center', 'required');
			if($this->form_validation->run()==false){
				$this->updateUserForm($username);
			}else{
				$form_data = $this->input->post();

//				$this->Monthly_Work_Plan_Model->updateFormData();
				$this->Registration_Model->updateUser($username,$form_data);
				$this->session->set_flashdata('update',$username);
				redirect(site_url() . "/Registration_Controller");
			}

		}else if($formsubmit=='cancel'){
			redirect(site_url() . "/Registration_Controller");
		}
	}

	public function userProfile(){
		$user = $this->session->userdata ( 'username' );
		if ($user == false) {
			redirect ( site_url () . "/Login_Controller/login" );
		 } else {
		$username = $this->session->userdata('username');
		$data['user']=  $this->Registration_Model->getUser($username);
		$this->header();
		$this->load->view("user_profile",$data);
		$this->load->view("footer");
		 }
	}

	public function changePassword(){
		$user = $this->session->userdata('username');
		$formSubmit = $this->input->post('submit');
        if ($formSubmit == 'save') {
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'old_pw', 'Current Password', 'required|callback_check_password' );
			$this->form_validation->set_rules ( 'new_pw', 'New Password', 'required|matches[confirm_pw]' );
			$this->form_validation->set_rules ( 'confirm_pw', 'Confirm Password', 'required' );


			if($this->form_validation->run()==FALSE){
				$this->userProfile();
			}else{
			$form_data = $this->input->post();
            $this->Registration_Model->changePassword($user,$form_data);
			$this->session->set_flashdata('aaa',$user);
            redirect(site_url() . "/Registration_Controller/userProfile");
			}
        }else if ($formSubmit == 'cancel') {
            redirect(site_url() . "/Registration_Controller/userProfile");
        }
	}

	public function check_password($old_pw)
	{
	$user = $this->session->userdata('username');
	$is_valid = $this->Registration_Model->check_password($old_pw,$user);
	if($is_valid==true){
		$result=true;
	}else{
		$result=false;
	$this->form_validation->set_message('check_password', 'The password you entered is wrong');
	}
		return $result;
	}
	/*	 
	 *set flash message for accessing urls that not provide privilege
	 *this message show on the page that redirect after login
	 *if user dose not login, he rederct to login pannel and this message not show there
	 *but message already set
	 * */
	public function user_role_error(){
		$this->session->set_flashdata('role_error', 'You Have Not Privilages To Access This Page');
		//$this->session->flashdata('role_error');
		//$this->session->keep_flashdata('role_error');
	}
	

}

?>

