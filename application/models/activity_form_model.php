<?php

Class Activity_Form_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    ### Get Table headers for a perticular table id ###
    function getHeaders($table_id)
    {
          $this->db->select("* from tbl_table_header where fld_table_no=$table_id");
          $query = $this->db->get();
          return $query->result();
    }

    ### Insert Activity Form Data to the database ###
    function insertActivityFormData($type,$form_id) {
        $data['headers'] = $this->getHeaders($type);
        $table_name = $data['headers'][0]->fld_save_table;
        for($i=0 ; $i<count( $data['headers']);$i++){
            $val = $data['headers'][$i]->fld_save_column;
			if($data['headers'][$i]->fld_save_column=="fld_time_period"){
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				$$val = $from." to ".$to;
				$arr[$val] = $$val;
			}else{
				$$val = $this->input->post($data['headers'][$i]->fld_save_column);
				$arr[$val] = $$val;
			}
        }
			$arr['fld_form_id']=$form_id;
			$this->db->trans_start();
			$this->db->insert($table_name, $arr);
			$last_id = $this->db->insert_id();
			$this->db->trans_complete();
			$this->db->trans_off();
			return $last_id;
    }

	### Update Activity Form Data to the database ###
	function updateActivityFormData($type,$tbl_id){
		$data['headers'] = $this->getHeaders($type);
		$table_name = $data['headers'][0]->fld_save_table;
		for($i=0 ; $i<count($data['headers']);$i++){
			$val = $data['headers'][$i]->fld_save_column;
			if($data['headers'][$i]->fld_save_column=="fld_time_period"){
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				$$val = $from." to ".$to;
				$arr[$val] = $$val;
			}else{
				$$val = $this->input->post($data['headers'][$i]->fld_save_column);
				$arr[$val] = $$val;

			}	$this->db->trans_start();
				$this->db->where('tbl_id', $tbl_id);
				$this->db->update($table_name, $arr);
				$this->db->trans_complete();
				$this->db->trans_off();
		}
	}

    ### Get all Activity Form Data for a specific activity_form_id ###
	function getAllFormData($type,$form_id,$vehicle_type="")
    {
		$data['headers'] = $this->getHeaders($type);
		$table_name = $data['headers'][0]->fld_save_table;

		### make the vehicle type by parameters from the controller ###
		if($vehicle_type==0){
		$vehicle="three_wheel";
		}else if($vehicle_type==1){
		$vehicle="van";
		}else{
		$vehicle="bus";
		}

		if($type != 6){
			$this->db->select("* from $table_name where fld_form_id=$form_id");
			$query = $this->db->get();
			return $query->result();
		}else{###Get only data related to driver type###
			$this->db->select("* from $table_name where fld_type='$vehicle' and fld_form_id=$form_id");
			$query = $this->db->get();
			return $query->result();
		}
    }

    ### Get Activity Form Data Row for a specific row_id ###
    function getAllFormDataRow($type,$row_id)
    {
          $data['headers'] = $this->getHeaders($type);
          $table_name = $data['headers'][0]->fld_save_table;
          $this->db->select("* from $table_name where tbl_id=$row_id");
          $query = $this->db->get();
          return $query->result();
    }

	function getDrugUsersFormData($form_id){
		$user=$this->session->userdata('username');
		$this->db->select("fld_month from tbl_monthly_summary_form where form_id=$form_id");
		$query=  $this->db->get();
		$month=  $query->row()->fld_month;
		$month_str = strtotime($month);
		$month_timestamp = date("Y-m", $month_str);

		$this->db->select("drug_name from tbl_drug_name");
		$query2= $this->db->get();
		$ress['drugs']=$query2->result();

//		$get_new_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
//			COUNT(*) as newIdentity,
//			COUNT(IF(tbl_follow_up_status.fld_client_accept_reject_followup='1',1,null)) as newRegis
//			from tbl_follow_up_status
//			inner join tbl_follow_up_personal_details
//			on tbl_follow_up_status.fld_form_id=tbl_follow_up_personal_details.form_id
//			where tbl_follow_up_status.fld_client_insert_date like '$month_timestamp%'
//			and tbl_follow_up_status.fld_client_insert_officer= '$user'
//			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
//		$query_get_new_count=  $this->db->query($get_new_count);
//		$result['new']=$query_get_new_count->result();
//
//		$get_cum_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
//			COUNT(*) as cumIden,
//			COUNT(IF(tbl_follow_up_status.fld_client_accept_reject_followup='1',1,null)) as cumRegis
//			from tbl_follow_up_status
//			inner join tbl_follow_up_personal_details
//			on tbl_follow_up_status.fld_form_id=tbl_follow_up_personal_details.form_id
//			where tbl_follow_up_status.fld_client_insert_officer= '$user'
//			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
//		$query_get_cum_count=  $this->db->query($get_cum_count);
//		$result['cum']=$query_get_cum_count->result();

		$get_new_iden_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
			COUNT(*) as newIdentity
			from tbl_follow_up_status
			inner join tbl_follow_up_personal_details
			on tbl_follow_up_status.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_follow_up_status.fld_client_insert_date like '$month_timestamp%'
			and tbl_follow_up_status.fld_client_insert_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_new_iden_count=  $this->db->query($get_new_iden_count);
		$result['new_iden']=$query_get_new_iden_count->result();

		$get_cum_iden_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
			COUNT(*) as cumIden
			from tbl_follow_up_status
			inner join tbl_follow_up_personal_details
			on tbl_follow_up_status.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_follow_up_status.fld_client_insert_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_cum_iden_count=  $this->db->query($get_cum_iden_count);
		$result['cum_iden']=$query_get_cum_iden_count->result();

		$get_free_frm_drug_count="select COUNT(*) as freeFromDrug,tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug
			from tbl_drug_free_user
			inner join tbl_follow_up_personal_details
			on tbl_drug_free_user.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_drug_free_user.fld_date like '$month_timestamp%'
			and tbl_drug_free_user.fld_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_free_frm_drug_count=$this->db->query($get_free_frm_drug_count);
		$result['free']=$query_get_free_frm_drug_count->result();

		$get_free_frm_drug_cum_count="select COUNT(*) as freeFromDrugCum,tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug
			from tbl_drug_free_user
			inner join tbl_follow_up_personal_details
			on tbl_drug_free_user.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_drug_free_user.fld_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_free_frm_drug_cum_count=$this->db->query($get_free_frm_drug_cum_count);
		$result['free_cum']=$query_get_free_frm_drug_cum_count->result();

		###
		$get_new_reg_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
			COUNT(*) as newRegis
			from tbl_follow_up_accepted_user
			inner join tbl_follow_up_personal_details
			on tbl_follow_up_accepted_user.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_follow_up_accepted_user.fld_date like '$month_timestamp%'
			and tbl_follow_up_accepted_user.fld_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_new_reg_count=  $this->db->query($get_new_reg_count);
		$result['new_reg']=$query_get_new_reg_count->result();

		$get_cum_reg_count="select tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend as drug,
			COUNT(*) as cumRegis
			from tbl_follow_up_accepted_user
			inner join tbl_follow_up_personal_details
			on tbl_follow_up_accepted_user.fld_form_id=tbl_follow_up_personal_details.form_id
			where tbl_follow_up_accepted_user.fld_officer= '$user'
			group by tbl_follow_up_personal_details.fld_alcohol_drug_nature_of_depend";
		$query_get_cum_reg_count=  $this->db->query($get_cum_reg_count);
		$result['cum_reg']=$query_get_cum_reg_count->result();
		###
		for($i=0;$i<5;$i++){
			$ress[$i]['new_identity']='0';
			$ress[$i]['new_regis']='0';
			$ress[$i]['cum_iden']='0';
			$ress[$i]['cum_regis']='0';
			$ress[$i]['new_free']='0';
			$ress[$i]['cum_free']='0';
		}

		$drug=array('Heroin','Cannabis','Alcohol','Illicit','Other');


		for($j=0;$j<count($result['new_iden']);$j++){
			for($k=0;$k<5;$k++){
				if($result['new_iden'][$j]->drug==$drug[$k]){
					$ress[$k]['new_identity']=$result['new_iden'][$j]->newIdentity;
				}
			}
		}
		for($j=0;$j<count($result['cum_iden']);$j++){
			for($k=0;$k<5;$k++){
				if($result['cum_iden'][$j]->drug==$drug[$k]){
					$ress[$k]['cum_iden']=$result['cum_iden'][$j]->cumIden;
				}
			}
		}
		for($j=0;$j<count($result['new_reg']);$j++){
			for($k=0;$k<5;$k++){
				if($result['new_reg'][$j]->drug==$drug[$k]){
					$ress[$k]['new_regis']=$result['new_reg'][$j]->newRegis;
				}
			}
		}
		for($j=0;$j<count($result['cum_reg']);$j++){
			for($k=0;$k<5;$k++){
				if($result['cum_reg'][$j]->drug==$drug[$k]){
					$ress[$k]['cum_regis']=$result['cum_reg'][$j]->cumRegis;
				}
			}
		}
		for($j=0;$j<count($result['free']);$j++){
			for($k=0;$k<5;$k++){
				if($result['free'][$j]->drug==$drug[$k]){
					$ress[$k]['new_free']=$result['free'][$j]->freeFromDrug;
				}
			}
		}

		for($j=0;$j<count($result['free_cum']);$j++){
			for($k=0;$k<5;$k++){
				if($result['free_cum'][$j]->drug==$drug[$k]){
					$ress[$k]['cum_free']=$result['free_cum'][$j]->freeFromDrugCum;
				}
			}
		}
//		var_dump($result['new']);
//		var_dump($result['cum']);
        return $ress;
	}

	#from monthly work plan model
	function insertForm($data) {
        $data_arr = array(
            'fld_month' => $data['form_data']['month'],
            'fld_district' => $data['form_data']['district'],
            'fld_username' => $this->session->userdata('username'),
        );

        $this->db->insert('tbl_monthly_summary_form', $data_arr);
        $this->db->insert_id();
        $this->db->trans_complete();
        $this->db->trans_off();
    }

	public function getMonthlySummaries($user){

        $this->db->trans_start();
        $this->db->select("* from tbl_monthly_summary_form where fld_username='$user'");
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
    }

	public function getDropDownlist() {
        $this->db->trans_start();
		$this->db->select("fld_district_name from tbl_district");
        $query = $this->db->get();
        $this->db->trans_complete();
        $this->db->trans_off();
        return $query->result();
    }

	public function is_valid_month($month,$user){
		$this->db->trans_start();
		$query = $this->db->query("select * from tbl_monthly_summary_form where fld_month='$month' and fld_username='$user'");

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
		$this->db->select("fld_month from tbl_monthly_summary_form where form_id=$form_id");
		$query=  $this->db->get();
		return $query->row()->fld_month;
	}

	public function getUser($user){
		$this->db->select("fld_username,fld_firstname,fld_lastname,fld_location from tbl_users where fld_username='$user'");
		$query=  $this->db->get();
		return $query->row();
	}


}
?>