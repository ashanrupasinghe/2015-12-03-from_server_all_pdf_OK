<?php

Class Monthly_Work_Plan_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    ### Insert Form Data to the database ###

    function insertFormData($form_data) {
        $form_data_arr = array(
            'fld_date' => $form_data ['date'],
            'fld_target_group' => $form_data ['target_grp'],
            'fld_location' => $form_data ['location'],
            'fld_program' => $form_data ['program'],
            'fld_start_time' => $form_data ['start_time'],
            'fld_end_time' => $form_data ['end_time'],
            'fld_form_id' => $form_data['form_id'],
        );
        $this->db->trans_start();
        $this->db->insert('tbl_monthly_work_plan', $form_data_arr);
        $last_id = $this->db->insert_id();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $last_id;
    }

    function getAllFormData($form_id) {
        $this->db->select("* from tbl_monthly_work_plan where fld_form_id = $form_id");
        $query = $this->db->get();
        return $query->result();
    }

	function getMonth($form_id){
		$this->db->select("fld_month from tbl_monthly_plan_form where form_id=$form_id");
		$query = $this->db->get();
		return $query->row()->fld_month;
	}

    function getFormData() {
        $form_id = $this->getFormId($this->input->post('month'));
        $this->db->select("* from tbl_monthly_work_plan where fld_form_id='$form_id'");
        $query = $this->db->get();
        return $query->result();
    }

    function insertForm($data) {
        $data_arr = array(
            'fld_month' => $data['form_data']['month'],
            'fld_district' => $data['form_data']['district'],
            'fld_username' => $this->session->userdata('username'),
        );
        $this->db->trans_start();
        $this->db->insert('tbl_monthly_plan_form', $data_arr);
        $this->db->insert_id();
        $this->db->trans_complete();
        $this->db->trans_off();
    }

    public function getDropDownlist() {
        $this->db->trans_start();
        $this->db->select("fld_district_name from tbl_district");
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
    }

    public function getMonthlyWorkPlans($user){
        $this->db->trans_start();
        $this->db->select("* from tbl_monthly_plan_form where fld_username='$user'");
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
    }

	public function getAllFormDataRow($tbl_id){
        $this->db->trans_start();
		$this->db->select("* from tbl_monthly_work_plan where tbl_id=$tbl_id");
		$query = $this->db->get();
		$this->db->trans_complete();
		$this->db->trans_off();
		return $query->result();
	}

	public function updateFormData($tbl_id,$form_data){
		$form_data_arr = array(
            'fld_date' => $form_data ['date'],
            'fld_target_group' => $form_data ['target_grp'],
            'fld_location' => $form_data ['location'],
            'fld_program' => $form_data ['program'],
            'fld_start_time' => $form_data ['start_time'],
            'fld_end_time' => $form_data ['end_time'],
            'fld_form_id' => $form_data['form_id'],
        );
        $this->db->trans_start();
        $this->db->where('tbl_id',$tbl_id);
		$this->db->update('tbl_monthly_work_plan',$form_data_arr);
        $this->db->trans_complete();
        $this->db->trans_off();

	}

	public function is_valid_month($month,$user){
		$this->db->trans_start();
		$query = $this->db->query("select * from tbl_monthly_plan_form where fld_month='$month' and fld_username='$user'");

		$this->db->trans_complete();
		$this->db->trans_off();

		if ($query->num_rows() > 0){
			$is_valid=false;
		}else{
			$is_valid=true;
		}

		return $is_valid;
	}

	public function get_month($form_id){
		$this->db->select("fld_month from tbl_monthly_plan_form where form_id=$form_id");
		$query=  $this->db->get();
		return $query->row()->fld_month;
	}

	public function getUser($user){
		$this->db->select("fld_username,fld_firstname,fld_lastname,fld_location from tbl_users where fld_username='$user'");
		$query=  $this->db->get();
		return $query->row();
	}

}
