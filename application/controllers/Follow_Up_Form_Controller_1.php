<?php

class Follow_Up_Form_Controller extends CI_Controller {
    private $platform;

    public function __construct() {
        parent::__construct();
        $this->load->model('Follow_Up_Form_Model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
//        $this->platform = 'LOCAL';
        $this->platform = 'SERVER';
        // Load dompdf library
        $this->load->helper(array('dompdf', 'file'));

        // Load email library
        $this->load->helper(array('email', 'file'));
        $this->load->database();
    }

    public function index() {
        
    }

    // pass session data in to header area.
    public function header() {
        $data ['user_name'] = $this->session->userdata('username');
        $data ['role_id'] = $this->session->userdata('role');
        $data ['role_name'] = $this->session->userdata('role_name');
        $data ['user_center'] = $this->session->userdata('user_center');
        $data ['first_name'] = $this->session->userdata('first_name');
        $this->load->view("header", $data);
    }

    // load follow up form
    public function followUpForm() {
        $user = $this->session->userdata('username');
        $user_role = $this->session->userdata('role');
        $data ['user_role'] = $user_role;
        if ($user == false) {
            redirect(site_url() . "/Login_Controller/login");
        } else {
            $data ['title'] = 'Client Follow Up Report';
            $language = "english";
            $this->load->helper('language');
            $this->lang->load('codepursuit', $language);

            $data ['race'] = $this->getDropDownlist('tbl_race', 'fld_race_name');
            $data ['religion'] = $this->getDropDownlist('tbl_religion', 'fld_religion_name');
            $data ['districts'] = $this->getDropDownlist('tbl_district', 'fld_district_name');
            $data ['school_evel'] = $this->getDropDownlist('tbl_school_level', 'fld_level');
            $data ['status'] = $this->getDropDownlist('tbl_status', 'fld_status');
            $data ['employments'] = $this->getDropDownlist('tbl_employment', 'fld_employment');
            $data ['Nature_of_Depends'] = $this->getDropDownlist('tbl_nature_of_depend', 'fld_depend_nature');
            $data ['administration_routes'] = $this->getDropDownlist('tbl_route_of_administration', 'fld_administration_route');
            $data ['attempt_centers'] = $this->getDropDownlist('tbl_attempt_center', 'fld_attempt_center');
            $this->header();
            $this->load->view("followup_form", $data);
            $this->load->view("footer");
        }
    }

    /* load forms for add user, */

    public function addfollowup() {
        $user = $this->session->userdata('username');
        $user_role = $this->session->userdata('role');
        // $data['roleid'] = $this->session->userdata ( 'role_id' );
        if ($user == false) {
            redirect(site_url() . "/Login_Controller/login");
        } else {
            // $data ['user_role'] = $user_role;
            // $data['user']=$user;
            $user_role_id = $this->session->userdata('role');
            $data ['title'] = 'Client Follow Up Report';
            $language = "english";
            $this->load->helper('language');
            $this->lang->load('codepursuit', $language);
            $data ['race'] = $this->getDropDownlist('tbl_race', 'fld_race_name');
            $data ['religion'] = $this->getDropDownlist('tbl_religion', 'fld_religion_name');
            $data ['districts'] = $this->getDropDownlist('tbl_district', 'fld_district_name');
            $data ['school_evel'] = $this->getDropDownlist('tbl_school_level', 'fld_level');
            $data ['status'] = $this->getDropDownlist('tbl_status', 'fld_status');
            $data ['employments'] = $this->getDropDownlist('tbl_employment', 'fld_employment');
            $data ['Nature_of_Depends'] = $this->getDropDownlist('tbl_nature_of_depend', 'fld_depend_nature');
            $data ['administration_routes'] = $this->getDropDownlist('tbl_route_of_administration', 'fld_administration_route');
            $data ['attempt_centers'] = $this->getDropDownlist('tbl_attempt_center', 'fld_attempt_center');

            $data ['follow_centers'] = $this->getDropDownlist('tbl_follow_up_centers', 'fld_center_name');
            $data ['follow_centers_Ids'] = $this->getDropDownlist('tbl_follow_up_centers', 'id,fld_center_name', array(
                'id',
                'fld_center_name'
            ));
            $data ['outreach_officer_list'] = $this->Follow_Up_Form_Model->get_outreach_officer_list();
            $data ['income_list'] = $this->getDropDownlist('tbl_follow_up_income', 'fld_income');
            $data ['nature_assets'] = $this->getDropDownlist('tbl_follow_up_nature_of_asset', 'fld_nature');
            $data ['custodion_rilationships'] = $this->getDropDownlist('tbl_follow_up_custodian_relationship', 'fld_relationship');

            // -----------
            $this->formValidation();

            if ($this->form_validation->run() == FALSE) {
                $this->header();
                switch ($user_role_id) {
                    case 2 :
                        $this->load->view("followup_form_user_level_2", $data);
                        break;
                    case 3 :
                        $this->load->view("followup_form_user_level_3", $data);
                        break;
                    default :
                        $this->load->view("followup_form_user_level_1", $data);
                }

                $this->load->view("footer");
            } else {

                $followup_data = $this->input->post();

                /*
                 * print '<pre>';
                 * print_r ( $followup_data );
                 * die ();
                 */
                /* if not validation error submit data to db */
                $process = $this->Follow_Up_Form_Model->addFormDetails($followup_data, $user_role, $user);
                $mssage = $this->messages($process ['bool'], $process ['type']);
                $this->session->set_flashdata($mssage);
                redirect('/Follow_Up_Form_Controller/addfollowup');
            }
        }
    }

    /*
     * set messages
     * $bool=true for success
     * $bool=false for unsuccess
     */

    public function messages($bool, $type) {
        if ($bool == true) {
            switch ($type) {
                case 'ADD_FOLLOW_SUC' :
                    $msg = 'CLIENT FOLLOW UP REPORT DETAILS SUBMITED SUCCESSFULLY !!!';
                    break;
                case 'EDIT_FOLLOW_SUC' :
                    $msg = 'CLIENT FOLLOW UP REPORT DETAILS UPDATED SUCCESSFULLY !!!';
                    break;
            }
        } else {
            switch ($type) {
                case 'ADD_FOLLOW_UNSUC' :
                    $msg = 'CLIENT FOLLOW UP REPORT DETAILS COULD NOT SUBMIT!!!';
                    break;
            }
        }
        return array(
            'msg' => $msg,
            'bool' => $bool
        );
    }

    /*
     * cound duration between two dates
     *
     */

    function countDuration($date1, $date2) {
        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);
        $interval = date_diff($datetime1, $datetime2);
        $years = $interval->format('%y');
        $months = $interval->format('%m');
        $days = $interval->format('%d');
        $duration = array(
            'years' => $years,
            'months' => $months,
            'days' => $days
        );
        return $duration;
    }

    /* validation ruels for the forms */

    public function formValidation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'divisional-sec',
                'lable' => 'Divisional Secretariats',
                'rules' => 'required'
            ),
            array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'exact_length[10]|is_unique[tbl_follow_up_personal_details.fld_id]'
            ),
            array(
                'field' => 'mobile',
                'label' => 'Mobile Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'fixed',
                'label' => 'Fixed Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'cust_contact_mobile',
                'label' => 'Mobile Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'cust_contact_fixed',
                'label' => 'Fixed Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'childunder18',
                'label' => 'No.of children under 18',
                'rules' => 'callback_children_no_vali[children]'
            )
        );

        $user_role_id = $this->session->userdata('role');
        if ($user_role_id == 1 || $user_role_id == 3) {
            $config [] = array(
                'field' => 'assigned-out-officer',
                'label' => 'Assign an Outreach Officer',
                'rules' => 'callback_radio'
            );
        }

        /* $this->form_validation->set_rules ( 'name', 'Name', 'required' ); */
        $this->form_validation->set_rules($config);
    }

    public function formValidation_update($stat = 0, $nedd_radio_validation) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'divisional-sec',
                'lable' => 'Divisional Secretariats',
                'rules' => 'required'
            ),
            array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'exact_length[10]'
            ),
            array(
                'field' => 'mobile',
                'label' => 'Mobile Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'fixed',
                'label' => 'Fixed Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'cust_contact_mobile',
                'label' => 'Mobile Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'cust_contact_fixed',
                'label' => 'Fixed Phone Number',
                'rules' => 'exact_length[10]|numeric'
            ),
            array(
                'field' => 'childunder18',
                'label' => 'No.of children under 18',
                'rules' => 'callback_children_no_vali[children]'
            )
        );

        $user_role_id = $this->session->userdata('role');
        if (($user_role_id == 1 || $user_role_id == 3) && $stat && $nedd_radio_validation) {
            $config [] = array(
                'field' => 'assigned-out-officer',
                'label' => 'Assign an Outreach Officer',
                'rules' => 'callback_radio'
            );
        }

        /* $this->form_validation->set_rules ( 'name', 'Name', 'required' ); */
        $this->form_validation->set_rules($config);
    }

    public function radio($is_available) {
        if (isset($is_available)) {
            $result = true;
        } else {
            $result = false;
            $this->form_validation->set_message('radio', 'Assign an Outreach Officer is required');
        }
        return $result;
    }

    public function children_no_vali($childunder18, $children) {
        if ($this->input->post($children) >= $childunder18) {
            $result = true;
        } else {
            $result = false;
            $this->form_validation->set_message('children_no_vali', 'More than number of childern ');
        }
        return $result;
    }

    /*
     *
     * @param string $table: table name
     * @param string $field: fields for select data
     * @param string $field_array: fleld name for prepare dropdown
     * @return multitype:NULL
     */

    public function getDropDownlist($table = 'tbl_follow_up_centers', $field = 'id,fld_center_name', $field_array = '') {
        // $field_array=array('id','fld_center_name');
        $dropdownlist = $this->Follow_Up_Form_Model->getDropDownlist($table, $field);
        // print '<pre>';
        // print_r ( $dropdownlist );
        // die ();
        if ($field_array == '') {
            for ($i = 0; $i < count($dropdownlist); $i ++) {
                $dropdownlist [$i] = $dropdownlist [$i]->$field;
            }
        } else {
            for ($i = 0; $i < count($dropdownlist); $i ++) {
                // $dropdownlist [$i]= $dropdownlist [$i]->$field_array[0];
                // $dropdownlist [$i] = $dropdownlist [$i]->$field_array[1];
                $dropdownlist [$i] = array(
                    $field_array [0] => $dropdownlist [$i]->$field_array [0],
                    $field_array [1] => $dropdownlist [$i]->$field_array [1]
                );
            }
        }
        /*
         * print '<pre>';
         * print_r ( $dropdownlist );
         * die ();
         */
        return $dropdownlist;
    }

    /*
     * client list, summery, serch art
     */

    public function showClientsDetails() {
        $user = $this->session->userdata('username');
        $user_role = $this->session->userdata('role');
        $user_center = $this->session->userdata('user_center');
        $data ['user_center'] = $user_center;
        $data ['user_role'] = $user_role;
        $data ['pdf_name'] = $user_role . "-" . $user_center . "-" . $user;
        if ($user == false) {
            redirect(site_url() . "/Login_Controller/login");
        } else {
            // $officer_area = $this->Follow_Up_Form_Model->getOfficerArea ( $user );

            $data ['title'] = 'Client List';
            /* $data ['follow_statuse'] = $status; */
            $language = "english";
            $this->load->helper('language');
            $this->lang->load('codepursuit', $language);

            /* $data ['clent_details'] = $this->Follow_Up_Form_Model->getClientsDetails ( $officer_area, $status ); */

            $this->header();
            if ($user_role != 1) {
                // user:center,outreach officer
                $data ['clent_details'] = $this->Follow_Up_Form_Model->getClientsDetails($user, $user_center);
                $this->load->view('followup_table', $data);
            } else {
                // user: admin
                $data ['clent_details'] = $this->Follow_Up_Form_Model->getClientsDetails_for_admin($user);
                $this->load->view('followup_admin_table', $data);
            }
            $this->load->view('footer');
        }
    }

    /*
     *
     * @param unknown $id: client id
     * @param string $stat: accept follow(1) or reject follow(0)
     * @param numeric show: show details(1) or edit (0)
     */

    public function editClientDetails($id, $stat = '', $show = 0) {
        $nedd_radio_validation = $this->Follow_Up_Form_Model->is_assignedby($id); //for check set assigne officer required or not
        $data ['formid'] = $id; // 2015-11-16
        $data ['stat'] = $stat; // 2015-11-16
        $this->formValidation_update($stat, $nedd_radio_validation); // 2015-11-16
        if ($this->form_validation->run() == FALSE) { // 2015-11-16
            $user = $this->session->userdata('username');
            $user_role = $this->session->userdata('role');
            $data ['user_role'] = $user_role;
            if ($user == false) {
                redirect(site_url() . "/Login_Controller/login");
            } else {

                $data ['client'] = $this->Follow_Up_Form_Model->getClientDetails($id); // get all clients data,
                // create variable for sending glyphicon class name=>refresh,ok,remove
                $free_drug_state = $data ['client'] ['follow_status'] [0]->fld_free_drug;
                $accept_follow_state = $data ['client'] ['follow_status'] [0]->fld_client_accept_reject_followup;
                $data ['glyphicon'] = '';
                if ($free_drug_state) {
                    $data ['glyphicon'] = "glyphicon-ok";
                } else {
                    $data ['glyphicon'] = "glyphicon-refresh";
                    if (!$accept_follow_state) {
                        $data ['glyphicon'] = "glyphicon-remove " . $accept_follow_state;
                    }
                }
                // change date format for all date fields
                $bday = $data ['client'] ['personal'] [0]->fld_birthday;
                $data ['client'] ['personal'] [0]->fld_birthday = $this->changeDateFormat_backToFront($bday);
                foreach ($data ['client'] ['treatment_progress'] as $tratprogress) {
                    $prog_enter_date = $tratprogress->fld_enter_date;
                    $tratprogress->fld_enter_date = $this->changeDateFormat_backToFront($prog_enter_date);
                    $prog_discharge_date = $tratprogress->fld_discharge_date;
                    $tratprogress->fld_discharged_date = $this->changeDateFormat_backToFront($prog_discharge_date);
                }
                foreach ($data ['client'] ['feedback'] as $feedback) {

                    $fedback_date = $feedback->fld_date;
                    $feedback->fld_date = $this->changeDateFormat_backToFront($fedback_date);
                }
                // get a list of drop down from db
                $data ['race'] = $this->getDropDownlist('tbl_race', 'fld_race_name');
                $data ['religion'] = $this->getDropDownlist('tbl_religion', 'fld_religion_name');
                $data ['districts'] = $this->getDropDownlist('tbl_district', 'fld_district_name');
                $data ['school_evel'] = $this->getDropDownlist('tbl_school_level', 'fld_level');
                $data ['status'] = $this->getDropDownlist('tbl_status', 'fld_status');
                $data ['employments'] = $this->getDropDownlist('tbl_employment', 'fld_employment');
                $data ['Nature_of_Depends'] = $this->getDropDownlist('tbl_nature_of_depend', 'fld_depend_nature');
                $data ['administration_routes'] = $this->getDropDownlist('tbl_route_of_administration', 'fld_administration_route');
                $data ['attempt_centers'] = $this->getDropDownlist('tbl_attempt_center', 'fld_attempt_center');
                $data ['client_form_id'] = $id;
                $data ['follow_centers'] = $this->getDropDownlist('tbl_follow_up_centers', 'fld_center_name');
                $data ['follow_centers_Ids'] = $this->getDropDownlist('tbl_follow_up_centers', 'id,fld_center_name', array(
                    'id',
                    'fld_center_name'
                ));
                $data ['outreach_officer_list'] = $this->Follow_Up_Form_Model->get_outreach_officer_list();

                $data ['income_list'] = $this->getDropDownlist('tbl_follow_up_income', 'fld_income');
                $data ['nature_assets'] = $this->getDropDownlist('tbl_follow_up_nature_of_asset', 'fld_nature');
                $data ['custodion_rilationships'] = $this->getDropDownlist('tbl_follow_up_custodian_relationship', 'fld_relationship');
                $data ['activities_list'] = $this->getDropDownlist('tbl_follow_up_activities_list', 'fld_activities');

                // add tratement progress data to a array, for jsonencode
                $prog = array();
                foreach ($data ['client'] ['treatment_progress'] as $treatProgress) :
                    $centerindex = $this->getMachIndex($data ['attempt_centers'], $treatProgress->fld_attempt_centet);
                    $prog [$treatProgress->fld_attempt - 1] = array(
                        $centerindex,
                        $treatProgress->fld_enter_date,
                        $treatProgress->fld_discharge_date,
                        $treatProgress->fld_counsellor_name,
                        $treatProgress->fld_counsellor_observation,
                        $treatProgress->fld_counsellor_summary
                    );
                endforeach
                ;
                // drop down list that do not get from db
                // created a table:tbl_follow_up_income['id(AI)','fld_income']
                /*
                 * $income_list = array (
                 * 'Below 5000',
                 * '5001-10000',
                 * '10001-15000',
                 * '15001-20000',
                 * '20001-25000',
                 * 'More 25001'
                 * );
                 */

                $yes_no_list = array(
                    'Yes',
                    'No'
                );

                $client_status_list = array(
                    'Relabse',
                    'Abstinent'
                );
                $if_bstinent_list = array(
                    'Permanent',
                    'Occasalion'
                );
                // crated a table: tbl_follow_up_activities_list['id(AI)','fld_activities']
                /*
                 * $activities_list = array (
                 * 'Economic buildup activities',
                 * 'Helthly activities',
                 * 'Social Recognized buildup activities'
                 * );
                 */

                // add Feedback data to a array, for jsonencode
                $feed = array();
                foreach ($data ['client'] ['feedback'] as $feedback) :
                    // $this->getMachIndex($list, $value);

                    $feed [$feedback->fld_follow_up_no - 1] = array(
                        $feedback->fld_date,
                        $feedback->fld_place,
                        $feedback->fld_officer_name,
                        $this->getMachIndex($data ['activities_list'], $feedback->fld_activities),
                        $this->getMachIndex($client_status_list, $feedback->fld_client_status),
                        $this->getMachIndex($if_bstinent_list, $feedback->fld_if_abstinent),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_from_family),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_from_relation),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_from_neighbour),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_to_family),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_to_relation),
                        $this->getMachIndex($yes_no_list, $feedback->fld_respect_and_honour_to_neighbour),
                        $this->getMachIndex($data ['employments'], $feedback->fld_employment),
                        $this->getMachIndex($data ['income_list'], $feedback->fld_Income),
                        $feedback->fld_clientsfeedback,
                        $feedback->fld_officer_bservation
                    );
                endforeach
                ;

                $data ['TreatProg'] = $prog;
                $data ['FeedBack'] = $feed;
                // $data ['follow_status']=$follow_status;
                // add insert officer detail, for editing as an array
                $insert_odfficer = $data ['client'] ['follow_status'] [0]->fld_client_insert_officer;
                $data ['insert_officer_role_and_center'] = $this->Follow_Up_Form_Model->get_insert_officer_level_with_center($insert_odfficer);

                $this->header();
                switch ($user_role) {
                    case 1 :
                        $data ['follow_stateus'] = $stat;
                        if ($stat == 1) {
                            if ($show) {
                                $this->load->view('followup_show_form', $data);
                            } else {
                                $this->load->view('followup_edit_form', $data);
                            }
                        } elseif ($stat == 0) {
                            if ($show) {
                                $this->load->view('followup_show_form_0', $data);
                            } else {
                                $this->load->view('followup_edit_form_0', $data);
                            }
                        }
                        break;
                    case 2 :
                        $data ['follow_stateus'] = $stat;
                        if ($stat == 1) {
                            if ($show) {
                                $this->load->view('followup_show_form_user_level_2', $data);
                            } else {
                                $this->load->view('followup_edit_form_user_level_2', $data);
                            }
                        } elseif ($stat == 0) {
                            if ($show) {
                                $this->load->view('followup_show_form_user_level_20', $data);
                            } else {
                                $this->load->view('followup_edit_form_user_level_20', $data);
                            }
                        }
                        break;

                    case 3 :
                        if ($show) {
                            $this->load->view('followup_show_form_user_level_3', $data);
                        } else {
                            $this->load->view('followup_edit_form_user_level_3', $data);
                        }

                        break;
                    default :
                }

                $this->load->view('footer');
            }
        } else {



            $user = $this->session->userdata('username');
            $user_role = $this->session->userdata('role');
            $followup_edited_data = $this->input->post();
            /*
              print '<pre>';
              print_r($followup_edited_data);
              die(); */


            $form_id = $id;
            $process = $this->Follow_Up_Form_Model->editFormDetails($followup_edited_data, $user_role, $user, $form_id);
            $mssage = $this->messages($process ['bool'], $process ['type']);
            $this->session->set_flashdata($mssage);

            redirect('/Follow_Up_Form_Controller/showClientsDetails');
        }
    }

    // find the index of selected value in dropdown, $list: dropdownlist, $value: curently selected value
    function getMachIndex($list, $value) {
        $selectIndex = '';
        foreach ($list as $index => $listvalue) {
            if ($value == $listvalue) {
                $selectIndex = $index;
            }
        }

        if ($selectIndex == '') {
            $selectIndex = 0;
        }

        return $selectIndex;
    }

    // edit follow up form data.
    function editfollowup($form_id) {
        /*
         * $this->formValidation ();
         * if ($this->form_validation->run () == FALSE) {
         * $this->editClientDetails($form_id,$this->input->post('stat'));
         * } else {
         */
        $user = $this->session->userdata('username');
        $user_role = $this->session->userdata('role');
        $followup_edited_data = $this->input->post();

        $process = $this->Follow_Up_Form_Model->editFormDetails($followup_edited_data, $user_role, $user, $form_id);
        $this->messages($process ['bool'], $process ['type']);
        $this->session->set_flashdata($mssage);

        redirect('/Follow_Up_Form_Controller/showClientsDetails');
        /* } */
    }

    // change date format yyy-mm-dd to mm/dd/yyyy
    function changeDateFormat_backToFront($date) {
        $timestamp = strtotime($date);
        $newDate = date("m/d/Y", $timestamp);
        return $newDate;
    }

    // get user list
    function get_user_list() {
        
    }

    /*
     * @param string $gender
     * @param string $form_id
     * @param string $name
     * @param string $address
     * @param string $nic
     * @param string $client_id
     * @param string $phone
     * @param unknown $user:outrach officer user name
     * $param number $center: center id
     */

    function get_search_results($gender = "", $form_id = "", $name = "", $address = "", $nic = "", $client_id = "", $phone = "", $phone2 = "", $role = "") {
        // echo 'jszjahj';
        $gender = $this->input->post('gender');
        $form_id = $this->input->post('form_id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $nic = $this->input->post('nic');
        $client_id = $this->input->post('client_id');
        $phone = $this->input->post('phone');
        $phone2 = $this->input->post('phone2');
        $role = $this->input->post('role');

        /*
         * echo $name;
         * die();
         */
        /*
         * $form_id : form_id|=
         * $gender: fld_gender|=
         * $name: fld_name|like %name%
         * $address: fld_address| like %address%
         * $nic: fld_id|=
         * $client_id: fld_client_id|=
         * $phone: fld_contact_mobile=||fld_contact_fixed=
         */
        /*
         * $role=1(admin: username empty, center empty),
         * $role=2(outreach officer: username-fill, center-empty),
         * $role=3(center officer: user name-fill, center-fill)
         */
        // $name = urldecode ( $name );as2015-10-26
        // $address = urldecode ( $address );as2015-10-26
        $search_result = '';
        $user_name = $this->session->userdata('username');
        $user_center = $this->session->userdata('user_center');
        if ($role == 1) {
            $search_result = $this->Follow_Up_Form_Model->get_search_results($gender, $form_id, $name, $address, $nic, $client_id, $phone, $phone2, $role, "null__", "null__");
        } elseif ($role == 2) {
            $search_result = $this->Follow_Up_Form_Model->get_search_results($gender, $form_id, $name, $address, $nic, $client_id, $phone, $phone2, $role, $user_name, "null__");
        } elseif ($role == 3) {
            $search_result = $this->Follow_Up_Form_Model->get_search_results($gender, $form_id, $name, $address, $nic, $client_id, $phone, $phone2, $role, $user_name, $user_center);
        }

        $data ['search_result'] = $search_result;
        $data ['no_of_search_result'] = count($search_result);
        // $this->load->view ( 'user_search_result', $data );
        $this->load->view('jsonarray', $data);
    }

    // function get_search_results_center_outrich_officer($gender = "", $form_id = "", $name = "",$address = "", $nic = "", $client_id = "", $phone = ""){}
    function getSummery($start_date = "", $end_date = "") {
        $user_level = $this->session->userdata('role');
        $username = $this->session->userdata('username');
        $center_id = $this->session->userdata('user_center');
        $data ['user_level'] = $user_level;

        /*
         * $start_date = "0000-00-00";
         * $end_date = "2015-10-12";
         * $user_level = 3;
         * $username = 'center';
         * $center_id = 3;
         */

        $result = [];
        $centers_vice_data = $this->Follow_Up_Form_Model->get_summery($start_date, $end_date, $user_level, $username, $center_id);
        switch ($user_level) {
            case 1 :
                $data ['report_user'] = "User Level: admin/  Center ID: " . $center_id . " / User Name: " . $username;
                if (isset($centers_vice_data ['center_one_to_more']) && !empty($centers_vice_data ['center_one_to_more'])) {
                    foreach ($centers_vice_data ['center_one_to_more'] as $center) {
                        // $array [$center->fld_center_name] [$center->fld_gender] = $center->count;
                        $array_one_to_more [$center->fld_center_name] [$center->fld_gender] [$center->fld_client_accept_reject_followup] = $center->count;
                    }
                    $result ['center_one_to_more'] = $array_one_to_more;
                }
                if (isset($centers_vice_data ['center_free_drug_one_to_more']) && !empty($centers_vice_data ['center_free_drug_one_to_more'])) {
                    foreach ($centers_vice_data ['center_free_drug_one_to_more'] as $center) {
                        // $array [$center->fld_center_name] [$center->fld_gender] = $center->count;
                        $array_drug_free_one_to_more [$center->fld_center_name] [$center->fld_gender] = $center->count;
                    }
                    $result ['center_free_drug_one_to_more'] = $array_drug_free_one_to_more;
                }

                if (isset($centers_vice_data ['accept_not_assign_to_center']) && !empty($centers_vice_data ['accept_not_assign_to_center'])) {
                    foreach ($centers_vice_data ['accept_not_assign_to_center'] as $center) {

                        $array_accept_not_assign_to_center [$center->fld_center_name] [$center->fld_gender] = $center->count;
                    }
                    $result ['accept_not_assign_to_center'] = $array_accept_not_assign_to_center;
                }
                if (isset($centers_vice_data ['accept_free_drug_not_assign_to_center']) && !empty($centers_vice_data ['accept_free_drug_not_assign_to_center'])) {
                    foreach ($centers_vice_data ['accept_free_drug_not_assign_to_center'] as $center) {

                        $array_accept_free_drug_not_assign_to_center [$center->fld_center_name] [$center->fld_gender] = $center->count;
                    }
                    $result ['accept_free_drug_not_assign_to_center'] = $array_accept_free_drug_not_assign_to_center;
                }

                if (isset($centers_vice_data ['reject_not_assign_to_center']) && !empty($centers_vice_data ['reject_not_assign_to_center'])) {
                    foreach ($centers_vice_data ['reject_not_assign_to_center'] as $center) {

                        $array_reject_not_assign_to_center [$center->fld_center_name] [$center->fld_gender] = $center->count;
                    }
                    $result ['reject_not_assign_to_center'] = $array_reject_not_assign_to_center;
                }
                // drug vice all identificATION
                if (isset($centers_vice_data ['drug_vice_all_admin']) && !empty($centers_vice_data ['drug_vice_all_admin'])) {
                    foreach ($centers_vice_data ['drug_vice_all_admin'] as $center) {

                        $array_drug_vice_all_admin [$center->fld_alcohol_drug_nature_of_depend] = $center->count;
                    }
                    $result ['drug_vice_all_admin'] = $array_drug_vice_all_admin;
                }
                if (isset($centers_vice_data ['drug_vice_accept_admin']) && !empty($centers_vice_data ['drug_vice_accept_admin'])) {
                    foreach ($centers_vice_data ['drug_vice_accept_admin'] as $center) {

                        $array_drug_vice_accept_admin [$center->fld_alcohol_drug_nature_of_depend] = $center->count;
                    }
                    $result ['drug_vice_accept_admin'] = $array_drug_vice_accept_admin;
                }
                if (isset($centers_vice_data ['drug_vice_free_admin']) && !empty($centers_vice_data ['drug_vice_free_admin'])) {
                    foreach ($centers_vice_data ['drug_vice_free_admin'] as $center) {

                        $array_drug_vice_free_admin [$center->fld_alcohol_drug_nature_of_depend] = $center->count;
                    }
                    $result ['drug_vice_free_admin'] = $array_drug_vice_free_admin;
                }

                break;
            case 2 :
                $data ['report_user'] = "User Level: center/ Center ID: " . $center_id . "/ User Name: " . $username;
                if (isset($centers_vice_data ['accept_my_client']) && !empty($centers_vice_data ['accept_my_client'])) {
                    foreach ($centers_vice_data ['accept_my_client'] as $my_accept) {
                        $array_my_accept [$my_accept->fld_gender] = $my_accept->count;
                    }
                    $result ['my_accepted'] = $array_my_accept;
                }
                if (isset($centers_vice_data ['reject_my_client']) && !empty($centers_vice_data ['reject_my_client'])) {
                    foreach ($centers_vice_data ['reject_my_client'] as $my_reject) {
                        $array_my_reject [$my_reject->fld_gender] = $my_reject->count;
                    }
                    $result ['my_rejected'] = $array_my_reject;
                }
                if (isset($centers_vice_data ['accept_other_client']) && !empty($centers_vice_data ['accept_other_client'])) {
                    foreach ($centers_vice_data ['accept_other_client'] as $other_accept) {
                        $array_other_accept [$other_accept->fld_gender] = $other_accept->count;
                    }
                    $result ['other_accept'] = $array_other_accept;
                }
                if (isset($centers_vice_data ['reject_other_client']) && !empty($centers_vice_data ['reject_other_client'])) {
                    foreach ($centers_vice_data ['reject_other_client'] as $other_reject) {
                        $array_other_reject [$other_reject->fld_gender] = $other_reject->count;
                    }
                    $result ['other_rejct'] = $array_other_reject;
                }
                /*
                 * if (isset ( $centers_vice_data ['reject_other_client'] ) && ! empty ( $centers_vice_data ['reject_other_client'] )) {
                 * foreach ( $centers_vice_data ['reject_other_client'] as $other_reject ) {
                 * $array_other_reject [$other_reject->fld_gender] = $other_reject->count;
                 * }
                 * $result ['other_assigned'] = $array_other_reject;
                 * }
                 */
                if (isset($centers_vice_data ['assigned_client']) && !empty($centers_vice_data ['assigned_client'])) {
                    foreach ($centers_vice_data ['assigned_client'] as $assigned) {
                        $array_assigned [$assigned->fld_gender] = $assigned->count;
                    }
                    $result ['assigned'] = $array_assigned;
                }
                /**
                 * after long time
                 */
                if (isset($centers_vice_data ['assigned_other_client']) && !empty($centers_vice_data ['assigned_other_client'])) {
                    foreach ($centers_vice_data ['assigned_other_client'] as $other_assigned) {
                        $array_other_assigned [$other_assigned->fld_gender] = $other_assigned->count;
                    }
                    $result ['other_assigned'] = $array_other_assigned;
                }

                /* free drug user */
                if (isset($centers_vice_data ['free_drug_my_client']) && !empty($centers_vice_data ['free_drug_my_client'])) {
                    foreach ($centers_vice_data ['free_drug_my_client'] as $free_drug_my_client) {
                        $array_free_drug_my_client [$free_drug_my_client->fld_gender] = $free_drug_my_client->count;
                    }
                    $result ['my_free_drug'] = $array_free_drug_my_client;
                }
                if (isset($centers_vice_data ['free_drug_other_client']) && !empty($centers_vice_data ['free_drug_other_client'])) {
                    foreach ($centers_vice_data ['free_drug_other_client'] as $free_drug_other_client) {
                        $array_free_drug_other_client [$free_drug_other_client->fld_gender] = $free_drug_other_client->count;
                    }
                    $result ['other_free_drug'] = $array_free_drug_other_client;
                }
                if (isset($centers_vice_data ['free_drug_assigned_client']) && !empty($centers_vice_data ['free_drug_assigned_client'])) {
                    foreach ($centers_vice_data ['free_drug_assigned_client'] as $free_drug_assigned_client) {
                        $array_free_drug_assigned_client [$free_drug_assigned_client->fld_gender] = $free_drug_assigned_client->count;
                    }
                    $result ['assigned_free_drug'] = $array_free_drug_assigned_client;
                }

                // /other assigned
                if (isset($centers_vice_data ['free_drug_other_assigned_client']) && !empty($centers_vice_data ['free_drug_other_assigned_client'])) {
                    foreach ($centers_vice_data ['free_drug_other_assigned_client'] as $free_drug_assigned_other_client) {
                        $array_free_drug_assigned_other_client [$free_drug_assigned_other_client->fld_gender] = $free_drug_assigned_other_client->count;
                    }
                    $result ['assigned_other_free_drug'] = $array_free_drug_assigned_other_client;
                }

                /*
                 * print '<pre>';
                 * print_r($result);
                 * die();
                 */

                break;
            case 3 :
                $data ['report_user'] = "User Level: outreach officer/ Center ID: " . $center_id . "/ User Name: " . $username;
                if (isset($centers_vice_data ['assigned_to_center']) && !empty($centers_vice_data ['assigned_to_center'])) {
                    foreach ($centers_vice_data ['assigned_to_center'] as $center_clients) {
                        $array_center_clients [$center_clients->fld_gender] = $center_clients->count;
                    }
                    $result ['center_clients'] = $array_center_clients;
                }
                if (isset($centers_vice_data ['free_drug_assigned_to_center']) && !empty($centers_vice_data ['free_drug_assigned_to_center'])) {
                    foreach ($centers_vice_data ['free_drug_assigned_to_center'] as $free_drug_assigned_to_center) {
                        $array_free_drug_assigned_to_center [$free_drug_assigned_to_center->fld_gender] = $free_drug_assigned_to_center->count;
                    }
                    $result ['free_drug_center_clients'] = $array_free_drug_assigned_to_center;
                }
                if (isset($centers_vice_data ['drug_vice_all_center']) && !empty($centers_vice_data ['drug_vice_all_center'])) {
                    foreach ($centers_vice_data ['drug_vice_all_center'] as $drug) {
                        $array_drug_vice_all [$drug->fld_alcohol_drug_nature_of_depend] = $drug->count;
                    }
                    $result ['drug_vice_all_center'] = $array_drug_vice_all;
                }
                if (isset($centers_vice_data ['drug_vice_accept_center']) && !empty($centers_vice_data ['drug_vice_accept_center'])) {
                    foreach ($centers_vice_data ['drug_vice_accept_center'] as $drug) {
                        $array_drug_vice_accept [$drug->fld_alcohol_drug_nature_of_depend] = $drug->count;
                    }
                    $result ['drug_vice_accept_center'] = $array_drug_vice_accept;
                }
                if (isset($centers_vice_data ['drug_vice_free_center']) && !empty($centers_vice_data ['drug_vice_free_center'])) {
                    foreach ($centers_vice_data ['drug_vice_free_center'] as $drug) {
                        $array_drug_vice_free [$drug->fld_alcohol_drug_nature_of_depend] = $drug->count;
                    }
                    $result ['drug_vice_free_center'] = $array_drug_vice_free;
                }

                break;
            default :
        }

        // return $result;
        $data ['summery'] = $result;
        $data ['starting_date'] = $start_date;
        $data ['ending_date'] = $end_date;
        $data ['generated_date'] = date("Y-m-d H:i:s");
        $this->load->view('summery_admin', $data);
    }

    // domPdf pdf fnction
    function pdf() {
        $html = $this->input->post('html');
        $filename = $this->input->post('pdfname');
//        log_message('error', $html);
//        log_message('error', $filename);
        $pdf = pdf_create($html, '', false);
        $this->create_online_payment_receipt($filename, $pdf);

        /*
         * pdf name: roleid-centerid-username_datestart_dateend.pdf
         * admin: 1-1-username
         * center:3-[2*]-username
         * outreach officer: 2-1-username
         */

        // page info here, db calls, etc.
        /*
         * $data = array (
         * 'fname' => 'Ashan',
         * 'midname' => 'Neranja',
         * 'lname' => 'Rupasinghe'
         * );
         * $html = $this->load->view ( 'pdftest', $data, true );
         * pdf_create ( $html, 'filename' );
         */

        // $this->getSummery('0000-00-00','2015-10-22');
        /*
         * $html = $this->load->view ( 'pdftest', $data, true );
         * pdf_create ( $html, 'filename' );
         */
        // or
        // $data = pdf_create($html, '', false);
        // write_file('name', $data);
        // if you want to write it to disk and/or send it as an attachment
    }

    public function create_online_payment_receipt($code, $pdf) {
        if ($this->platform == 'LOCAL') {
            file_put_contents("C:\\ashan\\" . $code . ".pdf", $pdf);
        } else if ($this->platform == 'SERVER') {
            file_put_contents("/tmp/" . $code . ".pdf", $pdf);
        }
    }

    function redirect($filename) {
//        log_message('error', $filename);
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf";');
        // The PDF source is in original.pdf
         if ($this->platform == 'LOCAL') {
            readfile("C:\\ashan\\" . $filename . ".pdf");
        } else if ($this->platform == 'SERVER') {
            readfile("/tmp" . $filename . ".pdf");
        }
    }

    function get_client_id() {
        $center_id = $this->input->post('center_id');
        $gender = $this->input->post('gender');

        $results = $this->Follow_Up_Form_Model->get_client_id($center_id, $gender);
        if ($gender == 'Male') {
            $gender = 'M';
        } else {
            $gender = 'F';
        }
        if ($results->count == 0) {
            // if no record that not assigned to the center
            $short_code = $this->Follow_Up_Form_Model->get_center_short_name($center_id);
            $count = str_pad(1, 5, '0', STR_PAD_LEFT);
            $ID = $short_code . "-" . $gender . "-" . $count;
        } else {
            $count = ($results->count) + 1;
            $count = str_pad($count, 5, '0', STR_PAD_LEFT);
            $ID = $results->fld_short_name . "-" . $gender . '-' . $count;
        }
        echo '[{"ID":"' . $ID . '"}]';
    }

    /* ------------------- */

    // testing function
    function test() {
        $available = $this->Follow_Up_Form_Model->get_center_short_name(1);
        print '<pre>';
        print_r($available);
    }

}
