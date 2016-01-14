//url for the contoller that ajax calle functions
/*
 * this variable add to header(2015-11-05 );
 * var controler_url="http://localhost/outreachmerged/index.php/Follow_Up_Form_Controller/";
 *
 * */

/* create xmlHttpRequest object */
function createRequestObject() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	return xmlhttp;
}
// search users
/* var counter = 0; */
function searchUsers22(role) {
	/* alert(counter); */
	// alert(role);
	var counting = 0;
	var gender_drop_down = document.getElementById("search-gender");
	var gender = gender_drop_down.options[gender_drop_down.selectedIndex].value;
	if (!gender) {
		gender = 'null__';
		counting++;
	}
	var form_id = document.getElementById("search-form-id").value;
	if (!form_id) {
		form_id = 'null__';
		counting++;
	}
	var name = document.getElementById("search-name").value;
	if (!name) {
		name = 'null__';
		counting++;
	}
	var area = document.getElementById("search-address").value;
	if (!area) {
		area = 'null__';
		counting++;
	}
	var nic = document.getElementById("search-nic").value;
	if (!nic) {
		nic = 'null__';
		counting++;
	}
	var client_id = document.getElementById("search-client-id").value;
	if (!client_id) {
		client_id = 'null__';
		counting++;
	}
	var phone = document.getElementById("search-phone").value;
	if (!phone) {
		phone = 'null__';
		counting++;
	}
	var phone = document.getElementById("search-phone").value;
	if (!phone) {
		phone = 'null__';
		counting++;
	}
	var phone2 = document.getElementById("search-phone-f").value;
	if (!phone2) {
		phone2 = 'null__';
		counting++;
	}

	/*
	 * alert(" gender: " + gender + "\n form id: " + form_id + "\n name: " +
	 * name + "\n area: " + area + "\n nic: " + nic + "\n client id: " +
	 * client_id + "\n phone: " + phone);
	 */
	if (counting == 9) {
		// if at least one value not insert alert this
		alert('please insert at least one field');
	} else {

		var xmlhttp = createRequestObject();

		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				// var parts = JSON.parse(xmlhttp.responseText);

				var jsonstring = xmlhttp.responseText;

				if (jsonstring) {

					var searcharray = eval("(" + jsonstring + ")");

					var result = [];

					for ( var i in searcharray) {
						/*
						 * result.push([ searcharray[i].index,
						 * searcharray[i].option, searcharray[i].formid,
						 * searcharray[i].ClientID, searcharray[i].Gender,
						 * searcharray[i].Name, searcharray[i].address,
						 * searcharray[i].NIC, searcharray[i].Mobile,
						 * searcharray[i].Fixed ]);
						 */
						var gliphicon = '';

						if (searcharray[i].freeDrug == 1) {
							gliphicon = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";// finished
						} else {
							gliphicon = "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>";// following
							if (searcharray[i].userState == 0) {
								gliphicon = "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";// reject
							}
						}

						var firstcolumn = gliphicon + searcharray[i].formid;
						result
								.push([
										firstcolumn,
										searcharray[i].ClientID,
										searcharray[i].Name,
										searcharray[i].address,
										searcharray[i].NIC,
										searcharray[i].Mobile,
										searcharray[i].Fixed,
										"<a class='btn btn-default btn-sm' href='editClientDetails/"
												+ searcharray[i].option
												+ "/"
												+ searcharray[i].userState
												+ "' role='button'><span class='glyphicon glyphicon-pencil'></span></a><a class='btn btn-default btn-sm' href='#' role='button'><span class='glyphicon glyphicon-list-alt'></span></a>" ]);
					}
					// searcharray[i].option
					/*
					 * this part ok
					 *
					 * http://datatables.net/release-datatables/examples/data_sources/js_array.html***
					 *
					 * search-result-table
					 */

					/* if (counter != 0) { */
					$(document).ready(function() {
						var oTable = $('#search-result-table').dataTable();
						// Immediately 'nuke' the current rows (perhaps
						// waiting
						// for an Ajax callback...)
						oTable.fnClearTable();
						oTable.fnAddData(result);
					});

					/* } */

				} else {
					$(document).ready(function() {
						alert("No result to display");
						var oTable = $('#search-result-table').dataTable();
						// Immediately 'nuke' the current rows (perhaps
						// waiting
						// for an Ajax callback...)
						oTable.fnClearTable();
					});

				}

			}

		}
		/*
		 * clear the table ( fnClearTable )
		 *
		 * add new data to the table ( fnAddData)
		 *
		 * redraw the table ( fnDraw )
		 */
		var encoded_name = encodeURIComponent(name);
		var encoded_area = encodeURIComponent(area);
		// ($gender = '', $form_id = '', $name = '', $address = '', $nic = '',
		// $client_id = '', $phone = '')
		// ($gender = '', $form_id = '33', $name = '', $address = '', $nic = '',
		// $client_id = '', $phone = ''){

		// alert(encoded_name);
		var url = "get_search_results/" + gender + "/" + form_id + "/"
				+ encoded_name + "/" + encoded_area + "/" + nic + "/"
				+ client_id + "/" + phone + "/" + phone2 + "/" + role;
		alert(url);
		xmlhttp.open("GET", url, true);

		xmlhttp.send();

	}
	/* counter++; */
}
// http://stackoverflow.com/questions/19701728/call-javascript-function-after-ajax-load
// get summery details
function getsummery(startDate, endDate) {
	// start-date
	// end-date
	var startDate = document.getElementById(startDate).value;// mm/dd/yyyy
	var endDate = document.getElementById(endDate).value;// mm/dd/yyyy
	var birthday = new Date(1991, 1 - 1, 23);
	// alert(birthday.getTime());
	if (startDate && endDate) {
		// ****************************need to veryfy startDate <
		// endDate**********
		var StartDateArray = startDate.split("/");
		var EndDateArray = endDate.split("/");

		// var birthday = new Date(1991, 1-1, 23);
		var jsStartDate = new Date(StartDateArray[2], StartDateArray[0] - 1,
				StartDateArray[1]);
		var jsEndDate = new Date(EndDateArray[2], EndDateArray[0] - 1,
				EndDateArray[1]);

		if (jsStartDate.getTime() < jsEndDate.getTime()) {

			var newStartDate = StartDateArray[2] + "-" + StartDateArray[0]
					+ "-" + StartDateArray[1];// yyyy/mm/dd
			var newEndDate = EndDateArray[2] + "-" + EndDateArray[0] + "-"
					+ EndDateArray[1];// yyyy/mm/dd

			var xmlhttp = createRequestObject();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("summery-admin").innerHTML = xmlhttp.responseText;

				}
			}
			xmlhttp.open("GET", controler_url + "Follow_Up_Form_Controller/getSummery/" + newStartDate
					+ "/" + newEndDate, true);

			xmlhttp.send();

		} else {
			alert('start date muse be smaller than end date');
			document.getElementById("summery-admin").innerHTML = "";
		}

	} else {
		alert('please Inset Start and End Dates');
		document.getElementById("summery-admin").innerHTML = "";
	}

}
// generate pdf
/*
 * get html content of dive taht id=id pass them in to pdf controller function,
 * call dom pdf function
 */
function getpdf(id, pdfname) {
	var html = $("#" + id).html();
	var startDate = document.getElementById('start-date').value;// mm/dd/yyyy
	var endDate = document.getElementById('end-date').value;// mm/dd/yyyy
	var StartDateArray = startDate.split("/");
	var EndDateArray = endDate.split("/");
	var newStartDate = StartDateArray[2] + "-" + StartDateArray[0] + "-"
			+ StartDateArray[1];// yyyy/mm/dd
	var newEndDate = EndDateArray[2] + "-" + EndDateArray[0] + "-"
			+ EndDateArray[1];// yyyy/mm/dd

	var newpdfname = pdfname + "-" + newStartDate + "_" + newEndDate;
	// alert(html);
	if (html) {
		var xmlhttp = createRequestObject();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//				alert('success');
                                window.location = controler_url+"Follow_Up_Form_Controller/redirect/" + newpdfname;
							   // window.location = "http://sdu.ucsc.lk/nddcb_outreach/index.php/Follow_Up_Form_Controller/redirect/" + newpdfname;
			}
		}
		// var new_html = encodeURIComponent(html);
		var params = "html=" + html + "&pdfname=" + newpdfname;

		xmlhttp.open("POST", controler_url+"Follow_Up_Form_Controller/pdf", true);
		//xmlhttp.open("POST", "http://sdu.ucsc.lk/nddcb_outreach/index.php/Follow_Up_Form_Controller/pdf", true);


		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		/*xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");*/
		xmlhttp.send(params);
		// http://stackoverflow.com/questions/9713058/sending-post-data-with-a-xmlhttprequest

	} else {
		alert('You have to get summery first');
	}

}

function searchUsers(role) {
	/* alert(counter); */
	// alert(role);
	//var enable_disabled
	var counting = 0;
	var gender_drop_down = document.getElementById("search-gender");
	var gender = gender_drop_down.options[gender_drop_down.selectedIndex].value;
	if (!gender) {
		gender = 'null__';
		counting++;
	}
	var form_id = document.getElementById("search-form-id").value;
	if (!form_id) {
		form_id = 'null__';
		counting++;
	}
	var name = document.getElementById("search-name").value;
	if (!name) {
		name = 'null__';
		counting++;
	}
	var area = document.getElementById("search-address").value;
	if (!area) {
		area = 'null__';
		counting++;
	}
	var nic = document.getElementById("search-nic").value;
	if (!nic) {
		nic = 'null__';
		counting++;
	}
	var client_id = document.getElementById("search-client-id").value;
	if (!client_id) {
		client_id = 'null__';
		counting++;
	}
	var phone = document.getElementById("search-phone").value;
	if (!phone) {
		phone = 'null__';
		counting++;
	}
	var phone = document.getElementById("search-phone").value;
	if (!phone) {
		phone = 'null__';
		counting++;
	}
	var phone2 = document.getElementById("search-phone-f").value;
	if (!phone2) {
		phone2 = 'null__';
		counting++;
	}

	/*
	 * alert(" gender: " + gender + "\n form id: " + form_id + "\n name: " +
	 * name + "\n area: " + area + "\n nic: " + nic + "\n client id: " +
	 * client_id + "\n phone: " + phone);
	 */
	if (counting == 9) {
		// if at least one value not insert alert this
		alert('please insert at least one field');
	} else {

		var xmlhttp = createRequestObject();

		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				// var parts = JSON.parse(xmlhttp.responseText);

				var jsonstring = xmlhttp.responseText;

				if (jsonstring) {

					var searcharray = eval("(" + jsonstring + ")");

					var result = [];

					for ( var i in searcharray) {
						/*
						 * result.push([ searcharray[i].index,
						 * searcharray[i].option, searcharray[i].formid,
						 * searcharray[i].ClientID, searcharray[i].Gender,
						 * searcharray[i].Name, searcharray[i].address,
						 * searcharray[i].NIC, searcharray[i].Mobile,
						 * searcharray[i].Fixed ]);
						 */
						var gliphicon = '';

						if (searcharray[i].freeDrug == 1) {
							gliphicon = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";// finished
						} else {
							gliphicon = "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>";// following
							if (searcharray[i].userState == 0) {
								gliphicon = "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";// reject
							}
						}

						var firstcolumn = gliphicon + searcharray[i].formid;
						result
								.push([
										firstcolumn,
										searcharray[i].ClientID,
										searcharray[i].Name,
										searcharray[i].address,
										searcharray[i].NIC,
										searcharray[i].Mobile,
										searcharray[i].Fixed,
										"<a class='btn btn-default btn-sm' href='"
												+ controler_url
												+ "Follow_Up_Form_Controller/editClientDetails/"
												+ searcharray[i].option
												+ "/"
												+ searcharray[i].userState
												+ "' role='button'><span class='glyphicon glyphicon-pencil'></span></a><a class='btn btn-default btn-sm' href='"+ controler_url+ "Follow_Up_Form_Controller/editClientDetails/" + searcharray[i].option	+ "/" + searcharray[i].userState +"/1"+"' role='button'><span class='glyphicon glyphicon-list-alt'></span></a>" ]);
					}
					// searcharray[i].option
					/*
					 * this part ok
					 *
					 * http://datatables.net/release-datatables/examples/data_sources/js_array.html***
					 *
					 * search-result-table
					 */

					/* else { */

					/*
					 * $(document).ready(function() {
					 *
					 * $('.search-result-table').DataTable({ data : result,
					 * columns : [ { title : "index" }, { title : "Options" }, {
					 * title : "form id" }, { title : "Client ID" }, { title :
					 * "Gender" }, { title : "Name" }, { title : "Address" }, {
					 * title : "NIC" }, { title : "Mobile" }, { title : "Fixed" } ]
					 * }); });
					 */
					/* } */

					/* if (counter != 0) { */
					$(document).ready(function() {
						var oTable = $('#search-result-table').dataTable();
						// Immediately 'nuke' the current rows (perhaps
						// waiting
						// for an Ajax callback...)
						oTable.fnClearTable();
						oTable.fnAddData(result);
					});

					/* } */

				} else {
					$(document).ready(function() {
						alert("No result to display");
						var oTable = $('#search-result-table').dataTable();
						// Immediately 'nuke' the current rows (perhaps
						// waiting
						// for an Ajax callback...)
						oTable.fnClearTable();
					});

				}

			}

		}
		/*
		 * clear the table ( fnClearTable )
		 *
		 * add new data to the table ( fnAddData)
		 *
		 * redraw the table ( fnDraw )
		 */
		var encoded_name = encodeURIComponent(name);
		var encoded_area = encodeURIComponent(area);
		// ($gender = '', $form_id = '', $name = '', $address = '', $nic = '',
		// $client_id = '', $phone = '')
		// ($gender = '', $form_id = '33', $name = '', $address = '', $nic = '',
		// $client_id = '', $phone = ''){

		// alert(encoded_name);
		// var url="get_search_results/" + gender + "/" + form_id+ "/" +
		// encoded_name + "/" + encoded_area + "/" + nic + "/"+ client_id + "/"
		// + phone + "/" + phone2 + "/" + role;
		var url = "gender=" + gender + "&form_id=" + form_id + "&name=" + name
				+ "&area=" + area + "&nic=" + nic + "&client_id=" + client_id
				+ "&phone=" + phone + "&phone2=" + phone2 + "&role=" + role;
		// $gender = "", $form_id = "", $name = "", $address = "", $nic = "",
		// $client_id = "", $phone = "", $phone2 = "", $role = ""
		// alert(url);
		xmlhttp.open("POST", controler_url + "Follow_Up_Form_Controller/get_search_results", true);

		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", url.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(url);

	}
	/* counter++; */
}
