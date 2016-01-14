<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login_Controller extends CI_Controller {
	function __construct() {
		parent::__construct ();
		
		$this->load->database ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'session' );
		$this->load->model ( 'User_Model' );
		$this->load->helper ( 'string' );
		// $this->load->model('Activity_Form_Model');
		// $this->load->model('Headers_Model');
		
		$language = "sinhala";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
	}
	
	// ## Load the login page if user not logged in and redirect to the home page if user already logged in ###
	public function login() {
		$user = $this->session->userdata ( 'username' );
		
		if ($user == false) {
			$this->load->view ( "login" );
		} else {
			redirect ( site_url () . '/Follow_Up_Form_Controller/showClientsDetails' );
		}
	}
	public function index() {
		$this->_destroySessionData ();
		
		$this->load->view ( 'login' );
	}
	
	// ## Submit login form data and validate and add data to the session variable ###
	public function submit() {
		
		// if ($this->input->post('is_posted') == 'true') {
		$username = $this->input->post ( 'username' );
		$password = $this->input->post ( 'password' );
		$userrole = [ ];
		
		if ($this->_isUserValid ( $username, $password )) {
			
			$userrole = $this->_getUserRole ( $username );
			$userCenterId = $this->_getUserCenterId ( $username );
			$this_session = $this->session->all_userdata ();
			
			$sessdata = array (
					'username' => $username,
					'role' => $userrole ['role_id'],
					'role_name' => $userrole ['role_name'],
					'user_center' => $userCenterId ['fld_user_center'],
					'first_name'=>$userrole['first_name']
			);
			
			$this->session->set_userdata ( $sessdata );
			
			if ($userrole ['role_id'] == 1 || $userrole ['role_id'] == 2 || $userrole ['role_id'] == 3) {
				redirect ( site_url () . '/Follow_Up_Form_Controller/showClientsDetails' );
			}
		} else {
			$this->session->set_flashdata ( 'item', 'Invalid Username or Password' );
			redirect ( site_url () . '/Login_Controller/login' );
		}
		// }
		// redirect(site_url() . '/login');
	}
	
	// ## Logout ###
	public function logOut() {
		$this->_destroySessionData ();
		redirect ( site_url () . '/Login_Controller/login' );
	}
	
	// ## Destroy session Data ###
	private function _destroySessionData() {
		$sessdata = array (
				'username' => '',
				'role' => '',
				'role_name' => '',
				'user_center' => '',
				'first_name'=>''
		);
		
		$this->session->unset_userdata ( $sessdata );
		
		$this->session->sess_destroy ();
	}
	private function _isUserValid($username, $password) {
		return $this->User_Model->checkUserCredentials ( $username, $password );
	}
	private function _getUserRole($username) {
		return $this->User_Model->getUserRole ( $username );
	}
	private function _getUserCenterId($username) {
		return $this->User_Model->getUserCenter ( $username );
	}
	private function _checkUserEmail($email) {
		return $this->User_Model->checkUserEmail ( $email );
	}
	
	// ## Load the home page ###
	public function home() {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		
		if ($user == false) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			if ($user_role == 1) {
				
				$data ['user_role'] = $user_role;
				// $data['results'] = $this->AMIS_Form_Model->search_all($fld_from);
				$this->header ();
				$this->load->view ( "home", $data );
				$this->load->view ( "footer" );
			} else if ($user_role == 2) {
				$data ['user_role'] = $user_role;
				// $data['results'] = $this->AMIS_Form_Model->search_all_level2($fld_from);
				$this->header ();
				$this->load->view ( "home", $data );
				$this->load->view ( "footer" );
			}
		}
	}
	public function header() {
		$data ['user'] = $this->session->userdata ( 'username' );
		$this->load->view ( "header", $data );
	}
//load form for reset password	
	public function forgetpassword() {
		$this->load->view ( "forget_pw" );
	}
	function reset() {
		// load wmail library
		$this->load->helper ( 'email' );
		$email = $this->input->post ( 'email' );
		// check email adress is available in any user account
		if ($this->_checkUserEmail ( $email )) {
			$newpw = random_string ( 'alnum', 16 ); // generate a password
			$hashedpw = sha1 ( $newpw ); // hash the password
			$query_status = $this->User_Model->resetpw ( $email, $hashedpw ); // update db with the password
			                                                                  // check db updated or not
			if ($query_status) {
				$recipient = $email;
				$subject = "Reset Password";
				$message = "You have requested to change your password
							<br>Your new password: " . $newpw."
							<br>If you did not request to reset your password,
							please login to your account with this password and reset your password";
				$email_status = mail ( $recipient, $subject, $message ); // send email
				                                                         // check email was sent or not
				if ($email_status) {
					$this->session->set_flashdata ( 'item', 'Your New Password is sent to ' . $email );
					$this->session->set_flashdata ( 'success', true );
					redirect ( site_url () . '/Login_Controller/login' );
				} else {
					$this->session->set_flashdata ( 'item', 'We have reset your password<br>But There Is an Issue in sending email to ' . $email . '<br>Please contact 011-0000000' );
					redirect ( site_url () . '/Login_Controller/forgetpassword' );
				}
			}
		} else {
			$this->session->set_flashdata ( 'item', 'The Email address not associate with any user account' );
			redirect ( site_url () . '/Login_Controller/forgetpassword' );
		}

	}
	
	
	public function sendemail(){
		//$this->load->helper ( 'email' );
		mail('ashanrupasinghe11@gmail.com', 'subject', 'message');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
