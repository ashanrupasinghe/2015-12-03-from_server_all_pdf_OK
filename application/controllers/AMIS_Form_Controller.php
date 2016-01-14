<?php
class AMIS_Form_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'AMIS_Form_Model' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		$this->load->helper ( 'form' );
		$this->load->database ();
	}
	public function index() {
	}
	
	// ## Load AMIS Data Capture Form to insert Data ###
	public function amisForm() {
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		$data ['title'] = 'Add Slip';
		$data ['policestations'] = $this->AMIS_Form_Model->policeStation ();
		$language = "english";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
		$this->load->view ( "header" );
		$this->load->view ( "amis_form", $data );
		$this->load->view ( "footer" );
	}
	
	// ## Insert AMIS Data Capture Form data to the database ###
	public function insertForm() {
		$formSubmit = $this->input->post ( 'submit' );
		$row_count = $this->input->post ( 'row_count' );
		
		if ($formSubmit == 'save') {
			
			$fld_ref_no = $this->AMIS_Form_Model->insert_ref_no ();
			
			$index_no = $this->AMIS_Form_Model->insertAMISFormData ( $fld_ref_no );
			
			for($j = 1; $j <= $row_count; $j ++) {
				$other_name = $this->input->post ( 'other_names_' . $j );
				$this->AMIS_Form_Model->insertAMISOtherNames ( $index_no, $other_name );
			}
			// var_dump($index_no);
			$this->session->set_flashdata ( 'index_no', $fld_ref_no );
			redirect ( site_url () . "/AMIS_Form_Controller/amisForm" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/AMIS_Form_Controller/amisForm" );
		}
	}
	
	// ## Load Edit AMIS Data Capture Form for a specific Form ID ###
	public function editForm($amis_form_id = 3) {
		$language = "english";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		$data ['policestations'] = $this->AMIS_Form_Model->policeStation ();
		$data ['results'] = $this->AMIS_Form_Model->getAllFormData ( $amis_form_id );
		$data ['other_name'] = $this->AMIS_Form_Model->getAllOtherNames ( $amis_form_id );
		$data ['title'] = 'Edit Slip';
		// var_dump($data['policestations']);
		// var_dump($data['results']);
		$this->load->view ( "header" );
		$this->load->view ( "amis_form", $data );
		$this->load->view ( "footer" );
	}
	
	// ## Load Slip Form for a specific Slip ID to approve ###
	public function toBeApprovedForm($slip_id = 3) {
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		$data ['policestations'] = $this->AMIS_Form_Model->policeStation ();
		$data ['results'] = $this->AMIS_Form_Model->getAllFormData ( $slip_id );
		$data ['title'] = 'Approve Slip';
		// var_dump($data['policestations']);
		// var_dump($data['results']);
		$this->load->view ( "header" );
		$this->load->view ( "amis_form", $data );
		$this->load->view ( "footer" );
	}
	
	// ## Approve or Disapprove Form ###
	public function approveForm($slip_id) {
		$formSubmit = $this->input->post ( 'submit' );
		$user_role = $this->session->userdata ( 'role' );
		
		if ($formSubmit == 'approve') {
			if ($user_role == 2) {
				$this->AMIS_Form_Model->approveSlip ( $slip_id );
			} else if ($user_role == 3) {
				$this->AMIS_Form_Model->approveSlipLevel3 ( $slip_id );
				$this->AMIS_Form_Model->approveMigrate ( $slip_id );
			}
			redirect ( site_url () . "/Login_C/home" );
		} else if ($formSubmit == 'disapprove') {
			if ($user_role == 2) {
				$this->AMIS_Form_Model->disapproveSlip ( $slip_id );
			} else if ($user_role == 3) {
				$this->AMIS_Form_Model->disapproveSlipLevel3 ( $slip_id );
			}
			redirect ( site_url () . "/Login_C/home" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Login_C/home" );
		}
	}
	
	// ## Update Slip Form data to the database ###
	public function updateForm($amis_form_id) {
		$formSubmit = $this->input->post ( 'submit' );
		$row_count = $this->input->post ( 'row_count' );
		
		if ($formSubmit == 'save') {
			$this->AMIS_Form_Model->updateAMISFormData ( $amis_form_id );
			for($j = 1; $j <= $row_count; $j ++) {
				$other_name = $this->input->post ( 'other_names_' . $j );
				$this->AMIS_Form_Model->updateAMISOtherNames ( $amis_form_id, $other_name );
			}
			redirect ( site_url () . "/AMIS_Form_Controller/amisForm" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/AMIS_Form_Controller/editForm/$amis_form_id" );
		}
	}
	
	// ## View Form data of a specific AMIS Form ###
	public function viewForm($amis_form_id = 3) {
		$language = "english";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		$data ['policestations'] = $this->AMIS_Form_Model->policeStation ();
		$data ['results'] = $this->AMIS_Form_Model->getAllFormData ( $amis_form_id );
		$data ['other_name'] = $this->AMIS_Form_Model->getAllOtherNames ( $amis_form_id );
		$data ['title'] = 'View Slip';
		// var_dump($data['policestations']);
		// var_dump($data['results']);
		$this->load->view ( "header" );
		$this->load->view ( "amis_form", $data );
		$this->load->view ( "footer" );
	}
}

?>