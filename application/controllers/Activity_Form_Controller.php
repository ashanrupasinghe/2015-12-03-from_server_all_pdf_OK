<?php
class Activity_Form_Controller extends CI_Controller {
	private $platform;

	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Activity_Form_Model' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		$this->load->helper ( 'form' );
		$this->load->database ();

//		$this->platform = 'LOCAL';
        $this->platform = 'SERVER';
        // Load dompdf library
        $this->load->helper(array('dompdf', 'file'));
	}
	public function index() {
	}

	// ## Load header according to the user level###
	public function header() {
		//$data ['user'] = $this->session->userdata ( 'username' );

		$data ['user_name'] = $this->session->userdata ( 'username' );
		$data ['role_id'] = $this->session->userdata ( 'role' );
		$data ['role_name'] = $this->session->userdata ( 'role_name' );
		$data ['user_center'] = $this->session->userdata ( 'user_center' );
		$data ['first_name'] = $this->session->userdata ( 'first_name' );
		$this->load->view("header",$data);
	}

	// ## Load Previous Activity Form Data ###
	public function activityForm($form_id) {
		$data ['title'] = 'Add Slip';
		for($i = 1; $i <= 16; $i ++) {
			if ($i < 6) {
				$data ['headers'] [$i] = $this->Activity_Form_Model->getHeaders ( $i );
				$data ['previous'] [$i] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id );
			}
			if ($i == 6) {
				for($j = 0; $j <= 2; $j ++) {
					$data ['headers'] [$i + $j] = $this->Activity_Form_Model->getHeaders ( $i );
					$data ['previous'] [$i + $j] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id, $j );
				}
			}
			if ($i > 6) {
				$data ['headers'] [$i + 2] = $this->Activity_Form_Model->getHeaders ( $i );
				$data ['previous'] [$i + 2] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id );
			}
		}
		$language = "english";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
		return $data;
	}

	// ## Insert Activity_Form data to the database ###
	public function insertForm($type, $form_id) {
		$type_db = $this->getFormTypeDb ( $type );
		$formSubmit = $this->input->post ( 'submit' );
		if ($formSubmit == 'save') {
			$index_no = $this->Activity_Form_Model->insertActivityFormData ( $type_db, $form_id );
			$this->session->set_flashdata ( 'index_no', $index_no );
			redirect ( site_url () . "/Activity_Form_Controller/monthlySummary/$form_id/$type" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Activity_Form_Controller/monthlySummary/$form_id/$type" );
		}
	}

	// ## Get Edit or View form data from the database ###
	public function editView($form_id, $row_id, $edit, $iid, $title) {
		$data ['title'] = $title;
		for($i = 1; $i <= 16; $i ++) {
			if ($i < 6) {
				$data ['headers'] [$i] = $this->Activity_Form_Model->getHeaders ( $i );
				$data ['previous'] [$i] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id );
				if (($edit == true) && ($iid == $i)) {
					$data ['results'] [$i] = $this->Activity_Form_Model->getAllFormDataRow ( $i, $row_id );
				}
			}
			if ($i == 6) {
				for($j = 0; $j <= 2; $j ++) {
					$data ['headers'] [$i + $j] = $this->Activity_Form_Model->getHeaders ( $i );
					$data ['previous'] [$i + $j] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id, $j );
					if (($edit == true) && ($i == $iid - $j)) {
						$data ['results'] [$i + $j] = $this->Activity_Form_Model->getAllFormDataRow ( $i, $row_id );
					}
				}
			}
			if ($i > 6) {
				$data ['headers'] [$i + 2] = $this->Activity_Form_Model->getHeaders ( $i );
				$data ['previous'] [$i + 2] = $this->Activity_Form_Model->getAllFormData ( $i, $form_id );
				if (($edit == true) && ($i == $iid - 2)) {
					$data ['results'] [$i + 2] = $this->Activity_Form_Model->getAllFormDataRow ( $i, $row_id );
				}
			}
		}
		$language = "english";
		$this->load->helper ( 'language' );
		$this->lang->load ( 'codepursuit', $language );
		return $data;
	}

	// ## Load Edit Form data of a specific Activity Form Single row to edit ###
	public function editFormData($form_id, $row_id, $edit = '', $iid = '') {
		$title = 'Edit Slip';
		$data = $this->editView ( $form_id, $row_id, $edit, $iid, $title );
		return $data;
	}

	// ## Load View form data###
	public function viewFormData($form_id, $row_id, $edit = '', $iid = '') {
		$title = 'View Slip';
		$data = $this->editView ( $form_id, $row_id, $edit, $iid, $title );
		return $data;
	}

	// ## update Activity_Form data to the database ###
	public function updateForm($type, $form_id, $tbl_id) {
		$formSubmit = $this->input->post ( 'submit' );
		$type_db = $this->getFormTypeDb ( $type );

		if ($formSubmit == 'save') {
			$this->Activity_Form_Model->updateActivityFormData ( $type_db, $tbl_id );
			$this->session->set_flashdata ( 'tbl_id', $tbl_id );
			redirect ( site_url () . "/Activity_Form_Controller/monthlySummary/$form_id/$type" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Activity_Form_Controller/monthlySummary/$form_id/$type" );
		}
	}

	// ##Load Monthly Summary of a Specific Month ###
	public function monthlySummary($form_id, $type = '',$admin_user='') {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		if ($user_role == 1) {
			$user1 = $admin_user;
		} else if($user_role == 2) {
			$user1 = $this->session->userdata ( 'username' );
		}

		$data ['user_role'] = $user_role;
		if ($user == false||$user_role == 3) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['form_id'] = $form_id;
			$data ['month'] = $this->Activity_Form_Model->get_month($form_id);
			$data ['activity_data'] = $this->activityForm ( $form_id );
			$data ['current_form'] = $type;
			$data ['drugUsersFormData'] = $this->Activity_Form_Model->getDrugUsersFormData ( $form_id );
			$data ['user']= $this->Activity_Form_Model->getUser($user1);
			$this->header ();
			$this->load->view ( "outreach_monthly_summary", $data );

			$this->load->view ( "footer" );
		}
	}

	// ##Load Edit Form###
	public function editForm($form_id, $row_id, $iid) {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		if ($user == false||$user_role!=2) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['form_id'] = $form_id;
			$data ['month'] = $this->Activity_Form_Model->get_month($form_id);
			$data ['current_form'] = $iid;
			$data ['activity_data'] = $this->editFormData ( $form_id, $row_id, TRUE, $iid );
			$data ['drugUsersFormData'] = $this->Activity_Form_Model->getDrugUsersFormData ( $form_id );

			$this->header ();
			$this->load->view ( "outreach_monthly_summary", $data );
			$this->load->view ( "footer" );
		}
	}

	// ##Load View Form###
	public function viewForm($form_id, $row_id, $iid) {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		if ($user == false||$user_role!=2) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['form_id'] = $form_id;
			$data ['month'] = $this->Activity_Form_Model->get_month($form_id);
			$data ['current_form'] = $iid;
			$data ['activity_data'] = $this->viewFormData ( $form_id, $row_id, TRUE, $iid );
			$data ['drugUsersFormData'] = $this->Activity_Form_Model->getDrugUsersFormData ( $form_id );

			$this->header ();
			$this->load->view ( "outreach_monthly_summary", $data );
			$this->load->view ( "footer" );
		}
	}

	// ## get the table that the data should inserted or updated ###
	public function getFormTypeDb($type) {
		if ((6 <= $type) && ($type <= 8)) {
			$type_db = 6;
		} else if ($type > 8) {
			$type_db = $type - 2;
		} else {
			$type_db = $type;
		}
		return $type_db;
	}

	// ##Load create new summary form###
	public function createNewSummary($admin_user = '') {
		$user_role = $this->session->userdata ( 'role' );

		if ($user_role == 1) {
			$user = $admin_user;
		} else {
			$user = $this->session->userdata ( 'username' );
		}
		$data ['user_role'] = $user_role;
		if ($user == false || $user_role==3||($user_role==2 && $admin_user!='')) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['user'] = $this->Activity_Form_Model->getUser($user);
			$data ['previous'] = $this->Activity_Form_Model->getMonthlySummaries ($user);
			$data ['district'] = $this->Activity_Form_Model->getDropDownlist ();
			$this->header ();
			$this->load->view ( "new_outreach_summary", $data );
			$this->load->view ( "footer" );
		}
	}

	// ##Insert New Summary to the database###
	public function insertNewSummary() {
		$formSubmit = $this->input->post ( 'submit' );
		if ($formSubmit == 'save') {
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'month', 'Month', 'required|callback_is_valid_form' );
			$this->form_validation->set_rules ( 'district', 'Distrct', 'required' );
			if ($this->form_validation->run () == false) {
				$this->createNewSummary ();
			} else {
				$data ['form_data'] = $this->input->post ();
				$this->Activity_Form_Model->insertForm ( $data );
				redirect ( site_url () . "/Activity_Form_Controller/createNewSummary" );
			}
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Activity_Form_Controller/createNewSummary" );
		}
	}
	public function is_valid_form($month) {
		$user = $this->session->userdata ( 'username' );
		$is_valid = $this->Activity_Form_Model->is_valid_month ( $month, $user );
		if ($is_valid == true) {
			$result = true;
		} else {
			$result = false;
			$this->form_validation->set_message ( 'is_valid_form', 'There is an existing summary for this month' );
		}
		return $result;
	}

	### pdf creation functions
	function pdf() {
        $html = $this->input->post('html');
        $filename = $this->input->post('pdfname');
//        log_message('error', $html);
//        log_message('error', $filename);
        $pdf = pdf_create($html, '', false);
        $this->create_online_payment_receipt($filename, $pdf);
	}

	public function create_online_payment_receipt($code, $pdf) {
        if ($this->platform == 'LOCAL') {
            file_put_contents("C:\\ashan\\" . $code . ".pdf", $pdf);
        } else if ($this->platform == 'SERVER') {
            file_put_contents("/tmp/" . $code . ".pdf", $pdf);
        }
    }

    function redirect($filename) {
		//log_message('error', $filename);
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf";');
        // The PDF source is in original.pdf
        if ($this->platform == 'LOCAL') {
            readfile("C:\\ashan\\" . $filename . ".pdf");
        } else if ($this->platform == 'SERVER') {
            readfile("/tmp/" . $filename . ".pdf");
        }
    }
}
?>