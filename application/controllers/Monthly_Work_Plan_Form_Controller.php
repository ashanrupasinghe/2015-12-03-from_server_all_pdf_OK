<?php
class Monthly_Work_Plan_Form_Controller extends CI_Controller {
	private $platform;
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		$this->load->helper ( 'form' );
		$this->load->database ();
		$this->load->model ( 'Monthly_Work_Plan_Model' );
//		$this->platform = 'LOCAL';
		$this->platform = 'SERVER';
        // Load dompdf library
        $this->load->helper(array('dompdf', 'file'));
	}

	// ##Load Header###
	public function header() {
		// $data ['user'] = $this->session->userdata('username');
		$data ['user_name'] = $this->session->userdata ( 'username' );
		$data ['role_id'] = $this->session->userdata ( 'role' );
		$data ['role_name'] = $this->session->userdata ( 'role_name' );
		$data ['user_center'] = $this->session->userdata ( 'user_center' );
		$data ['first_name'] = $this->session->userdata ( 'first_name' );
		$this->load->view ( "header", $data );
	}
	public function index() {
	}

	// ##Load previous work plans and create plan form###
	public function createNewPlan($admin_user = '') {
		$user_role = $this->session->userdata ( 'role' );

		if ($user_role == 1) {
			$user = $admin_user; // outreach officer user name
		} else {
			$user = $this->session->userdata ( 'username' );
		}

		$data ['user_role'] = $user_role;
		if ($user == false||$user_role==3||($user_role==2 && $admin_user!='')) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['user'] = $this->Monthly_Work_Plan_Model->getUser ( $user );
			$data ['previous'] = $this->Monthly_Work_Plan_Model->getMonthlyWorkPlans ( $user );
			$data ['district'] = $this->Monthly_Work_Plan_Model->getDropDownlist ();
			$this->header ();
			$this->load->view ( "create_new_outreach_plan", $data );
			$this->load->view ( "footer" );
		}
	}

	// ##Insert new plan to database###
	public function insertNewPlan() {
		$formSubmit = $this->input->post ( 'submit' );
		if ($formSubmit == 'save') {
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'month', 'Month', 'required|callback_is_valid_form' );
			$this->form_validation->set_rules ( 'district', 'District', 'required' );

			if ($this->form_validation->run () == false) {
				$this->createNewPlan ();
			} else {
				$data ['form_data'] = $this->input->post ();
				$this->Monthly_Work_Plan_Model->insertForm ( $data );
				redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/createNewPlan" );
			}
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/createNewPlan" );
		}
	}

	// ##Load monthly work plan of a specific month###
	public function monthlyPlan($form_id,$admin_user='') {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );

		if ($user_role == 1) {
			$user1 = $admin_user;
		} else if($user_role == 2) {
			$user1 = $this->session->userdata ( 'username' );
		}

		$data ['user_role'] = $user_role;
		if ($user == false || $user_role == 3) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$data ['title'] = 'Add slip';
			$data ['form_id'] = $form_id;
			$data ['user'] = $this->Monthly_Work_Plan_Model->getUser ( $user1 );
			$data ['month'] = $this->Monthly_Work_Plan_Model->getMonth ( $form_id );
			$data ['previous'] = $this->Monthly_Work_Plan_Model->getAllFormData ( $form_id );
			$this->header ();
			$this->load->view ( "outreach_monthly_work_plan", $data );
			$this->load->view ( "footer" );
		}
	}

	// ##Insert monthly plan item to monthly work plan of a selected month###
	public function insertForm($form_id) {
		$formSubmit = $this->input->post ( 'submit' );

		if ($formSubmit == 'save') {
			$form_data = $this->input->post ();
			$form_data ['form_id'] = $form_id;
			$this->Monthly_Work_Plan_Model->insertFormData ( $form_data );
			redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/monthlyPlan/$form_id" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/monhtlyPlan/$form_id" );
		}
	}

	// ##Load data of a specific row to update data###
	public function updatePlanForm($form_id, $tbl_id) {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		if ($user == false || $user_role != 2) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$title = 'Edit Slip';
			$this->updateView ( $form_id, $tbl_id, $title );
		}
	}

	// ##Load data of a specific row to view data###
	public function viewPlanForm($form_id, $tbl_id) {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		if ($user == false || $user_role != 2) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$title = 'View_Slip';
			$this->updateView ( $form_id, $tbl_id, $title );
		}
	}

	// ##Get update or view form data from db###
	public function updateView($form_id, $tbl_id, $edit_view) {
		$user = $this->session->userdata ( 'username' );
		$user_role = $this->session->userdata ( 'role' );
		$data ['user_role'] = $user_role;
		if ($user == false) {
			redirect ( site_url () . "/Login_Controller/login" );
		} else {
			$language = "english";
			$this->load->helper ( 'language' );
			$this->lang->load ( 'codepursuit', $language );
			$data ['form_id'] = $form_id;
			$data ['month'] = $this->Monthly_Work_Plan_Model->getMonth ( $form_id );
			$data ['results'] = $this->Monthly_Work_Plan_Model->getAllFormDataRow ( $tbl_id );
			$data ['previous'] = $this->Monthly_Work_Plan_Model->getAllFormData ( $form_id );
			$data ['title'] = $edit_view;
			$this->header ();
			$this->load->view ( "outreach_monthly_work_plan", $data );
			$this->load->view ( "footer" );
		}
	}

	// ##Update data to the db###
	public function updateFormData($form_id, $tbl_id) {
		$formSubmit = $this->input->post ( 'submit' );

		if ($formSubmit == 'save') {
			$form_data = $this->input->post ();
			$form_data ['form_id'] = $form_id;
			$this->Monthly_Work_Plan_Model->updateFormData ( $tbl_id, $form_data );
			redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/monthlyPlan/$form_id" );
		} else if ($formSubmit == 'cancel') {
			redirect ( site_url () . "/Monthly_Work_Plan_Form_Controller/monthlyPlan/$form_id" );
		}
	}
	public function is_valid_form($month) {
		$user = $this->session->userdata ( 'username' );
		$is_valid = $this->Monthly_Work_Plan_Model->is_valid_month ( $month, $user );
		if ($is_valid == true) {
			$result = true;
		} else {
			$result = false;
			$this->form_validation->set_message ( 'is_valid_form', 'There is an existing plan for this month' );
		}
		return $result;
	}

	### pdf creation functions
//	function pdf() {
//        $html = $this->input->post('html');
//        $filename = $this->input->post('pdfname');
////        log_message('error', $html);
////        log_message('error', $filename);
//        $pdf = pdf_create($html, '', false);
//        $this->create_online_payment_receipt($filename, $pdf);
//	}
//
//	public function create_online_payment_receipt($code, $pdf) {
//        if ($this->platform == 'LOCAL') {
//            file_put_contents("C:\\ashan\\" . $code . ".pdf", $pdf);
//        } else if ($this->platform == 'SERVER') {
//            file_put_contents("/tmp/" . $code . ".pdf", $pdf);
//        }
//    }
//
//    function redirect($filename) {
//		//log_message('error', $filename);
//        header("Content-type:application/pdf");
//        // It will be called downloaded.pdf
//        header('Content-Disposition: attachment; filename="' . $filename . '.pdf";');
//        // The PDF source is in original.pdf
//        if ($this->platform == 'LOCAL') {
//            readfile("C:\\ashan\\" . $filename . ".pdf");
//        } else if ($this->platform == 'SERVER') {
//            readfile("/tmp" . $filename . ".pdf");
//        }
//    }


}
?>

