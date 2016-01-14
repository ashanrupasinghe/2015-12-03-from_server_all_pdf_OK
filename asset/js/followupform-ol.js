//show hide some input field acording to the drop downs select values;
function dropdownShowhide(selectid, selectedvalue, showhideid) {
	/* alert(selectid+selectedvalue+showhideid); */
	var ddl = document.getElementById(selectid);
	ddl.onchange = function showhide() {
		var selectedValue = ddl.options[ddl.selectedIndex].value;

		if (selectedValue == selectedvalue) {
			document.getElementById(showhideid).style.display = "block";
		} else {
			document.getElementById(showhideid).style.display = "none";
		}
	}
}

var counter2 = -1;// 0 t0 14 , 15 rows can add
var FollowUp = [];// array to store all 15 rows data
var rows = 14;// maximum numbers of row can add
var checkAddOrEdit = 0;// if add var=1, if edit var=0
var editid = 100;// set 100 as a id that not set as 100,
var editOrNot = 'no';// edit rw or not
var showOrNotNewRow = 'yes'; // if No, dose not display new row
var temp = '';// store count2 temparaly if need

function addrows(id) {

	// display error when try to add more than 15 rows

	if (counter2 >= 14 && editOrNot == 'no') {
		alert('you are only allowed to add 15 Feedback about Follow Ups');
		reset();
	}
	// get data from form
	var feed_back_date1 = document.getElementById('feed-back-date1').value;
	var feed_back_place1 = document.getElementById('feed-back-place1').value;
	var Name_of_Follow_up_Officer1 = document
			.getElementById('Name-of-Follow-up-Officer1').value;
	var activities1_list = document.getElementById('activities1');
	var activities1 = activities1_list.options[activities1_list.selectedIndex].value;
	/* var activities1 = document.getElementById('activities1').value; */
	var Status_of_Client1_list = document.getElementById('Status-of-Client1');
	var Status_of_Client1 = Status_of_Client1_list.options[Status_of_Client1_list.selectedIndex].value;
	/*
	 * var Status_of_Client1 =
	 * document.getElementById('Status-of-Client1').value;
	 */
	var Status_of_Client1_if_abstinent_list = document
			.getElementById('Status-of-Client1-if-abstinent');
	var Status_of_Client1_if_abstinent = Status_of_Client1_if_abstinent_list.options[Status_of_Client1_if_abstinent_list.selectedIndex].value;
	/*
	 * var Status_of_Client1_if_abstinent = document
	 * .getElementById('Status-of-Client1-if-abstinent').value;
	 */
	/*
	 * var Respect_and_Honour1 =
	 * document.getElementById('Respect-and-Honour1').value;
	 */
	var Respect_from_fammily_list = document
			.getElementById('from-family-members');
	var Respect_from_fammily = Respect_from_fammily_list.options[Respect_from_fammily_list.selectedIndex].value;

	/*
	 * var Respect_from_fammily =
	 * document.getElementById('from-family-members').value;
	 */
	var Respect_from_relation_list = document.getElementById('from-relation');
	var Respect_from_relation = Respect_from_relation_list.options[Respect_from_relation_list.selectedIndex].value;
	/*
	 * var Respect_from_relation =
	 * document.getElementById('from-relation').value;
	 */
	var Respect_from_neighbour_list = document.getElementById('from-neighbour');
	var Respect_from_neighbour = Respect_from_neighbour_list.options[Respect_from_neighbour_list.selectedIndex].value;
	/*
	 * var Respect_from_neighbour =
	 * document.getElementById('from-neighbour').value;
	 */

	var Respect_to_fammily_list = document.getElementById('to-family-members');
	var Respect_to_fammily = Respect_to_fammily_list.options[Respect_to_fammily_list.selectedIndex].value;
	/*
	 * var Respect_to_fammily =
	 * document.getElementById('to-family-members').value;
	 */
	var Respect_to_relation_list = document.getElementById('to-relation');
	var Respect_to_relation = Respect_to_relation_list.options[Respect_to_relation_list.selectedIndex].value;
	/* var Respect_to_relation = document.getElementById('to-relation').value; */
	var Respect_to_neighbour_list = document.getElementById('to-neighbour');
	var Respect_to_neighbour = Respect_to_neighbour_list.options[Respect_to_neighbour_list.selectedIndex].value;
	/* var Respect_to_neighbour = document.getElementById('to-neighbour').value; */

	var feedback_employment_list = document
			.getElementById('feedback-employment');
	var feedback_employment = feedback_employment_list.options[feedback_employment_list.selectedIndex].value;
	/*
	 * var feedback_employment =
	 * document.getElementById('feedback-employment').value;
	 */
	var feedback_income_list = document.getElementById('feedback-income');
	var feedback_income = feedback_income_list.options[feedback_income_list.selectedIndex].value;
	/* var feedback_income = document.getElementById('feedback-income').value; */

	var Clients_Feedback1 = document.getElementById('Clients-Feedback1').value;
	var Officers_Observations1 = document
			.getElementById('Officers-Observations1').value;
	temp = counter2;

	// check edit or add new
	if (editid != 100 && editOrNot == 'yes') {
		counter2 = editid;

	}
	// add form data in to array,
	FollowUp[counter2] = [ feed_back_date1, feed_back_place1,
			Name_of_Follow_up_Officer1, activities1_list.selectedIndex,
			Status_of_Client1_list.selectedIndex,
			Status_of_Client1_if_abstinent_list.selectedIndex,
			Respect_from_fammily_list.selectedIndex,
			Respect_from_relation_list.selectedIndex,
			Respect_from_neighbour_list.selectedIndex,
			Respect_to_fammily_list.selectedIndex,
			Respect_to_relation_list.selectedIndex,
			Respect_to_neighbour_list.selectedIndex,
			feedback_employment_list.selectedIndex,
			feedback_income_list.selectedIndex, Clients_Feedback1,
			Officers_Observations1 ];
	var num = counter2 + 1;
	// display form data on the tble
	document.getElementById("count-table-" + num).innerHTML = counter2 + 1;
	document.getElementById("feed-back-date-table-" + num).innerHTML = feed_back_date1;
	document.getElementById("feed-back-place-table-" + num).innerHTML = feed_back_place1;
	document.getElementById("Name-of-Follow-up-Officer-table-" + num).innerHTML = Name_of_Follow_up_Officer1;
	document.getElementById("activities-table-" + num).innerHTML = activities1;
	document.getElementById("Status-of-Client-table-" + num).innerHTML = Status_of_Client1;
	document.getElementById("Status-of-Client-if-abstinent-table-" + num).innerHTML = Status_of_Client1_if_abstinent;
	document.getElementById("from-family-members-table-" + num).innerHTML = Respect_from_fammily;
	document.getElementById("from-relation-table-" + num).innerHTML = Respect_from_relation;
	document.getElementById("from-neighbour-table-" + num).innerHTML = Respect_from_neighbour;
	document.getElementById("to-family-members-table-" + num).innerHTML = Respect_to_fammily;
	document.getElementById("to-relation-table-" + num).innerHTML = Respect_to_relation;
	document.getElementById("to-neighbour-table-" + num).innerHTML = Respect_to_neighbour;
	document.getElementById("feedback-employment-table-" + num).innerHTML = feedback_employment;
	document.getElementById("feedback-income-table-" + num).innerHTML = feedback_income;
	/*
	 * document.getElementById("Respect-and-Honour-table-" + num).innerHTML =
	 * Respect_and_Honour1;
	 */
	document.getElementById("Clients-Feedback-table-" + num).innerHTML = Clients_Feedback1;
	document.getElementById("Officers-Observations-table-" + num).innerHTML = Officers_Observations1;

	/* form data */
	document.getElementById("count-table-f" + num).innerHTML = counter2 + 1;
	document.getElementById("feed-back-date-table-f" + num).innerHTML = feed_back_date1;
	document.getElementById("feed-back-place-table-f" + num).innerHTML = feed_back_place1;
	document.getElementById("Name-of-Follow-up-Officer-table-f" + num).innerHTML = Name_of_Follow_up_Officer1;
	document.getElementById("activities-table-f" + num).innerHTML = activities1;
	document.getElementById("Status-of-Client-table-f" + num).innerHTML = Status_of_Client1;
	document.getElementById("Status-of-Client-if-abstinent-table-f" + num).innerHTML = Status_of_Client1_if_abstinent;
	/*
	 * document.getElementById("Respect-and-Honour-table-f" + num).innerHTML =
	 * Respect_and_Honour1;
	 */
	document.getElementById("from-family-members-table-f" + num).innerHTML = Respect_from_fammily;
	document.getElementById("from-relation-table-f" + num).innerHTML = Respect_from_relation;
	document.getElementById("from-neighbour-table-f" + num).innerHTML = Respect_from_neighbour;
	document.getElementById("to-family-members-table-f" + num).innerHTML = Respect_to_fammily;
	document.getElementById("to-relation-table-f" + num).innerHTML = Respect_to_relation;
	document.getElementById("to-neighbour-table-f" + num).innerHTML = Respect_to_neighbour;
	document.getElementById("feedback-employment-table-f" + num).innerHTML = feedback_employment;
	document.getElementById("feedback-income-table-f" + num).innerHTML = feedback_income;

	document.getElementById("Clients-Feedback-table-f" + num).innerHTML = Clients_Feedback1;
	document.getElementById("Officers-Observations-table-f" + num).innerHTML = Officers_Observations1;
	/*
	 * if(counter2 == rows) {
	 * document.getElementById("toggleButton").style.display = "none"; }
	 */
	// reset form data after sumbmit
	reset();

}

// reset form data as default
function reset() {
	document.getElementById('feed-back-date1').value = document
			.getElementById('feed-back-date1').defaultValue;
	document.getElementById('feed-back-place1').value = document
			.getElementById('feed-back-place1').defaultValue;
	document.getElementById('Name-of-Follow-up-Officer1').value = document
			.getElementById('Name-of-Follow-up-Officer1').defaultValue;
	document.getElementById('activities1').selectedIndex = "0";
	document.getElementById('Status-of-Client1').selectedIndex = "0";
	document.getElementById('Status-of-Client1-if-abstinent').selectedIndex = "0";
	/*
	 * document.getElementById('Respect-and-Honour1').value = document
	 * .getElementById('Respect-and-Honour1').defaultValue;
	 */
	document.getElementById('from-family-members').selectedIndex = "0";
	document.getElementById('from-relation').selectedIndex = "0";
	document.getElementById('from-neighbour').selectedIndex = "0";
	document.getElementById('to-family-members').selectedIndex = "0";
	document.getElementById('to-relation').selectedIndex = "0";
	document.getElementById('to-neighbour').selectedIndex = "0";
	document.getElementById('feedback-employment').selectedIndex = "0";
	document.getElementById('feedback-income').selectedIndex = "0";

	document.getElementById('Clients-Feedback1').value = document
			.getElementById('Clients-Feedback1').defaultValue;
	document.getElementById('Officers-Observations1').value = document
			.getElementById('Officers-Observations1').defaultValue;

	/* reset form */
}
// will show new row or existing edited roww
function showrow(rownum) {

	var table = document.getElementById("followuptable");
	var rownum = counter2 + 1;
	var rowid = 'follow-table-row-' + rownum;
	var myrow = document.getElementById(rowid);
	if (table.style.display == "none") {
		table.style.display = "";// when satrd add data display table
		myrow.style.display = "";// with a row

	} else {
		myrow.style.display = "";// display other rows
	}

	// after doing the proess sett beiove var as default
	counter2 = temp;
	editid = 100;
	editOrNot = 'no';

}

// when click on the edit button add data in to the form
function editflowup(id) {
	editid = id;// id of the edit row
	editOrNot = 'yes';// is this edit option
	showOrNotNewRow = 'no';// when submit, show new roe or show an existing row
	document.getElementById('feed-back-date1').value = FollowUp[id][0];
	document.getElementById('feed-back-place1').value = FollowUp[id][1];
	document.getElementById('Name-of-Follow-up-Officer1').value = FollowUp[id][2];
	document.getElementById('activities1').selectedIndex = FollowUp[id][3];
	document.getElementById('Status-of-Client1').selectedIndex = FollowUp[id][4];
	document.getElementById('Status-of-Client1-if-abstinent').selectedIndex = FollowUp[id][5];
	document.getElementById('from-family-members').selectedIndex = FollowUp[id][6];
	document.getElementById('from-relation').selectedIndex = FollowUp[id][7];
	document.getElementById('from-neighbour').selectedIndex = FollowUp[id][8];
	document.getElementById('to-family-members').selectedIndex = FollowUp[id][9];
	document.getElementById('to-relation').selectedIndex = FollowUp[id][10];
	document.getElementById('to-neighbour').selectedIndex = FollowUp[id][11];
	document.getElementById('feedback-employment').selectedIndex = FollowUp[id][12];
	document.getElementById('feedback-income').selectedIndex = FollowUp[id][13];
	document.getElementById('Clients-Feedback1').value = FollowUp[id][14];
	document.getElementById('Officers-Observations1').value = FollowUp[id][15];
}

// if not use edit option increase count
function increasecount() {

	if (editOrNot == 'no' && counter2 < 14) {
		counter2++;
	}
}

/*------------------------------------------------------------------------------------------------*/

/* progress of treatements */
var counter = -1;// 0 t0 14 , 15 rows can add
var ProgressTreat = [];// array to store all 15 rows data
var progRows = 14;// maximum numbers of row can add
var progCheckAddOrEdit = 0;// if add var=1, if edit var=0
var progEditid = 100;// set 100 as a id that not set as 100,
var progEditOrNot = 'no';// edit rw or not
var progShowOrNotNewRow = 'yes'; // if No, dose not display new row
var progTemp = '';// store count2 temparaly if need
var checkCounter = 0;

function progAddrows(id) {
	// display error when try to add more than 15 rows
	/* alert(counter); */

	if (checkCounter == 1 && progEditOrNot == 'no') {
		alert('you are only allowed to add 15 progress of treatments');
		progReset();
	}
	if (counter == 14) {
		checkCounter = 1;
	}
	// get data from form
	var prog_attempt_center_list = document.getElementById('attempt_center1');
	var prog_attempt_center = prog_attempt_center_list.options[prog_attempt_center_list.selectedIndex].value;
	/*
	 * var prog_attempt_center =
	 * document.getElementById('attempt_center1').value;
	 */
	var prog_entered_date = document.getElementById('entered-date1').value;
	var prog_discharge_date = document.getElementById('discharge-date1').value;
	var prog_counsellor_name = document.getElementById('counsellor_name1').value;
	var prog_counsellor_observ = document.getElementById('counsellor_observ1').value;
	var prog_counsellor_observ_summery1 = document
			.getElementById('counsellor_observ_summery1').value;
	progTemp = counter;

	// check edit or add new
	if (progEditid != 100 && progEditOrNot == 'yes') {
		counter = progEditid;

	}
	// add form data in to array,
	ProgressTreat[counter] = [ prog_attempt_center_list.selectedIndex,
			prog_entered_date, prog_entered_date, prog_counsellor_name,
			prog_counsellor_observ, prog_counsellor_observ_summery1 ];
	var num = counter + 1;
	// display form data on the tble
	document.getElementById("progress-count-table-" + num).innerHTML = counter + 1;
	document.getElementById("progress-attempt-center-" + num).innerHTML = prog_attempt_center;
	document.getElementById("progress-entered-date-" + num).innerHTML = prog_entered_date;
	document.getElementById("progress-discharge-date-" + num).innerHTML = prog_discharge_date;
	document.getElementById("progress-counsellor-name-" + num).innerHTML = prog_counsellor_name;
	document.getElementById("progress-counsellor-observ-" + num).innerHTML = prog_counsellor_observ;
	document.getElementById("progress-counsellor-observ-summery-" + num).innerHTML = prog_counsellor_observ_summery1;

	/* add form field */

	document.getElementById("progress-count-table-p" + num).innerHTML = counter + 1;
	document.getElementById("progress-attempt-center-p" + num).innerHTML = prog_attempt_center;
	document.getElementById("progress-entered-date-p" + num).innerHTML = prog_entered_date;
	document.getElementById("progress-discharge-date-p" + num).innerHTML = prog_discharge_date;
	document.getElementById("progress-counsellor-name-p" + num).innerHTML = prog_counsellor_name;
	document.getElementById("progress-counsellor-observ-p" + num).innerHTML = prog_counsellor_observ;
	document.getElementById("progress-counsellor-observ-summery-p" + num).innerHTML = prog_counsellor_observ_summery1;

	/*
	 * if(counter2 == rows) {
	 * document.getElementById("toggleButton").style.display = "none"; }
	 */
	// reset form data after sumbmit
	progReset();

}
// RESET FIELD INPUT AS DEFAULT
function progReset() {
	document.getElementById('entered-date1').value = document
			.getElementById('entered-date1').defaultValue;
	document.getElementById('discharge-date1').value = document
			.getElementById('discharge-date1').defaultValue;
	document.getElementById('attempt_center1').selectedIndex = "0";
	document.getElementById('counsellor_name1').value = document
			.getElementById('counsellor_name1').defaultValue;
	document.getElementById('counsellor_observ1').value = document
			.getElementById('counsellor_observ1').defaultValue;
	document.getElementById('counsellor_observ_summery1').value = document
			.getElementById('counsellor_observ_summery1').defaultValue;
}

// if not use edit option increase count
function progIncreasecount() {
	if (progEditOrNot == 'no' && counter < 14) {
		counter++;
	}
}

// will show new row or existing edited roww
function progShowrow(rownum) {

	var table = document.getElementById("progressoftreattable");
	var rownum = counter + 1;
	var rowid = 'progress-table-row-' + rownum;
	var myrow = document.getElementById(rowid);
	if (table.style.display == "none") {
		table.style.display = "";// when satrd add data display table
		myrow.style.display = "";// with a row

	} else {
		myrow.style.display = "";// display other rows
	}

	// after doing the proess sett beiove var as default
	counter = progTemp;
	progEditid = 100;
	progEditOrNot = 'no';

}

// when click on the edit button add data in to the form
function progEdit(id) {
	progEditid = id;// id of the edit row
	progEditOrNot = 'yes';// is this edit option
	progShowOrNotNewRow = 'no';// when submit, show new roe or show an existing
	// row

	document.getElementById('attempt_center1').selectedIndex = ProgressTreat[id][0];
	document.getElementById('entered-date1').value = ProgressTreat[id][1];
	document.getElementById('discharge-date1').value = ProgressTreat[id][2];
	document.getElementById('counsellor_name1').value = ProgressTreat[id][3];
	document.getElementById('counsellor_observ1').value = ProgressTreat[id][4];
	document.getElementById('counsellor_observ_summery1').value = ProgressTreat[id][5];
}

/*
 * function progResetHiddnField(id) {
 * document.getElementById('progress-count-table-p'+id).value = document
 * .getElementById('progress-count-table-p'+id).defaultValue;
 * document.getElementById('progress-attempt-center-p'+id).value = document
 * .getElementById('progress-attempt-center-p'+id).defaultValue;
 * document.getElementById('progress-entered-date-p'+id).value = document
 * .getElementById('progress-entered-date-p'+id).defaultValue;
 * document.getElementById('progress-discharge-date-p'+id).value = document
 * .getElementById('progress-discharge-date-p'+id).defaultValue;
 * document.getElementById('progress-counsellor-name-p'+id).value = document
 * .getElementById('progress-counsellor-name-p'+id).defaultValue;
 * document.getElementById('progress-counsellor-observ-p'+id).value = document
 * .getElementById('progress-counsellor-observ-p'+id).defaultValue;
 * document.getElementById('progress-counsellor-observ-summery-p'+id).value =
 * document
 * .getElementById('progress-counsellor-observ-summery-p'+id).defaultValue; }
 */

/*---------------------------------------------------------------------------------------*/

function progDlete(id) {
	alert(counter);
	/*
	 * 1.remove the array from index array 2.reset table rows
	 */

	ProgressTreat.splice(id, 1);
	for (i = 0; i < ProgressTreat.length - 1; i++) {
		var j = i + 1;
		document.getElementById("progress-count-table-" + j).innerHTML = j;

		var prog_attempt_center_list = document
				.getElementById('attempt_center1');

		var prog_attempt_center = prog_attempt_center_list.options[ProgressTreat[i][0]].value;

		document.getElementById("progress-attempt-center-" + j).innerHTML = prog_attempt_center;
		document.getElementById("progress-entered-date-" + j).innerHTML = ProgressTreat[i][1];
		document.getElementById("progress-discharge-date-" + j).innerHTML = ProgressTreat[i][2];
		document.getElementById("progress-counsellor-name-" + j).innerHTML = ProgressTreat[i][3];
		document.getElementById("progress-counsellor-observ-" + j).innerHTML = ProgressTreat[i][4];
		document.getElementById("progress-counsellor-observ-summery-" + j).innerHTML = ProgressTreat[i][5];

		document.getElementById("progress-count-table-p" + j).innerHTML = j;
		document.getElementById("progress-attempt-center-p" + j).innerHTML = prog_attempt_center;
		document.getElementById("progress-entered-date-p" + j).innerHTML = ProgressTreat[i][1];
		document.getElementById("progress-discharge-date-p" + j).innerHTML = ProgressTreat[i][2];
		document.getElementById("progress-counsellor-name-p" + j).innerHTML = ProgressTreat[i][3];
		document.getElementById("progress-counsellor-observ-p" + j).innerHTML = ProgressTreat[i][4];
		document.getElementById("progress-counsellor-observ-summery-p" + j).innerHTML = ProgressTreat[i][5];

	}
	var delrow = ProgressTreat.length + 1;// remove last row
	var deleteTable = document.getElementById("progressoftreattable");
	var deleteRowid = 'progress-table-row-' + delrow;
	var deleteMyrow = document.getElementById(deleteRowid);

	if (ProgressTreat.length >= 1) {
		deleteMyrow.style.display = "none";

	} else {
		deleteMyrow.style.display = "none";
		deleteTable.style.display = "none";

	}

	document.getElementById("progress-count-table-p" + delrow).innerHTML = '';
	document.getElementById("progress-attempt-center-p" + delrow).innerHTML = '';
	document.getElementById("progress-entered-date-p" + delrow).innerHTML = '';
	document.getElementById("progress-discharge-date-p" + delrow).innerHTML = '';
	document.getElementById("progress-counsellor-name-p" + delrow).innerHTML = '';
	document.getElementById("progress-counsellor-observ-p" + delrow).innerHTML = '';
	document.getElementById("progress-counsellor-observ-summery-p" + delrow).innerHTML = '';

	if (counter > 0) {
		counter--;
		checkCounter = 0;
	}

}

function dlete(id) {
	FollowUp.splice(id, 1);
	for (i = 0; i < FollowUp.length - 1; i++) {
		var j = i + 1;
		

		var activities_list = document.getElementById('activities1');
		var status_of_client_list = document
				.getElementById('Status-of-Client1');
		var status_of_client_if_ab_list=document.getElementById('');	
		var rhf_fammily_list = document.getElementById('from-family-members');
		var rhf_relation_list = document.getElementById('from-relation');
		var rhf_neighbour_list = document.getElementById('from-neighbour');
		var rht_fammily_list = document.getElementById('to-family-members');
		var rht_relation_list = document.getElementById('to-relation');
		var rht_neighbour_list = document.getElementById('to-neighbour');

		var employment_list = document.getElementById('feedback-employment');
		var income_list = document.getElementById('feedback-income');

		var activities = activities_list.options[FollowUp[i][3]].value;
		var status_of_client = status_of_client_list.options[FollowUp[i][4]].value;
		var status_of_client_if_ab = status_of_client_if_ab_list.options[FollowUp[i][4]].value;

		var rhf_fammily = rhf_fammily_list.options[FollowUp[i][5]].value;
		var rhf_relation = rhf_relation_list.options[FollowUp[i][6]].value;
		var rhf_neighbour = rhf_neighbour_list.options[FollowUp[i][7]].value;

		var rht_fammily = rht_fammily_list.options[FollowUp[i][8]].value;
		var rht_relation = rht_relation_list.options[FollowUp[i][9]].value;
		var rht_neighbour = rht_neighbour_list.options[FollowUp[i][10]].value;

		var employment = employment_list.options[FollowUp[i][11]].value;
		var income = income_list.options[FollowUp[i][12]].value;
		
		document.getElementById("count-table-" + j).innerHTML = j;
		document.getElementById("feed-back-date-table-" + j).innerHTML = FollowUp[i][0];
		document.getElementById("feed-back-place-table-" + j).innerHTML = FollowUp[i][1];
		document.getElementById("Name-of-Follow-up-Officer-table-" + j).innerHTML = FollowUp[i][2];
		document.getElementById("activities-table-" + j).innerHTML = ;
		document.getElementById("Status-of-Client-table-" + j).innerHTML = ;
		document.getElementById("Status-of-Client-if-abstinent-table-" + j).innerHTML = ;
		document.getElementById("from-family-members-table-" + j).innerHTML = ;
		document.getElementById("from-relation-table-" + j).innerHTML = ;
		document.getElementById("from-neighbour-table-" + j).innerHTML = ;
		document.getElementById("to-family-members-table-" + j).innerHTML = ;
		document.getElementById("to-relation-table-" + j).innerHTML =;
		document.getElementById("to-neighbour-table-" + j).innerHTML = ;
		document.getElementById("feedback-employment-table-" + j).innerHTML = ;
		document.getElementById("feedback-income-table-" + j).innerHTML = ;
		document.getElementById("Clients-Feedback-table-" + j).innerHTML = FollowUp[i][];
		document.getElementById("Officers-Observations-table-" + j).innerHTML = FollowUp[i][];
		

	}
}
