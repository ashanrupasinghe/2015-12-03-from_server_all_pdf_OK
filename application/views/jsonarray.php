<?php
$json_string = '';
if (isset ( $search_result )) {
	if (! empty ( $search_result )) {		
		$json_string .= '[';
		$count4 = 1;
		foreach ( $search_result as $clent ) {
			$json_string .= '{';
			$json_string .= '"index" : ' . '"' . $count4 . '",';			
			$json_string .= '"option":' . '"' . $clent->form_id . '",';
			$json_string .= '"formid":' . '"' . $clent->form_id . '",';
			$json_string .= '"ClientID":' . '"' . $clent->fld_client_id . '",';
			$json_string .= '"Gender":' . '"' . $clent->fld_gender . '",';
			$json_string .= '"Name":' . '"' . $clent->fld_name . '",';
			$json_string .= '"address":' . '"' . $clent->fld_address . '",';
			$json_string .= '"NIC":' . '"' . $clent->fld_id . '",';
			$json_string .= '"Mobile":' . '"' . $clent->fld_contact_mobile . '",';
			$json_string .= '"Fixed":' . '"' . $clent->fld_contact_fixed . '",';
			$json_string .= '"userState":' . '"' . $clent->fld_client_accept_reject_followup . '",';
			$json_string .= '"freeDrug":' . '"' . $clent->fld_free_drug . '"';
			$json_string .= '}';
			if ($count4 != count ( $search_result )) {
				$json_string .= ',';
			}
			$count4 ++;
		}
		$json_string .= ']';
	}
}

echo $json_string

?>