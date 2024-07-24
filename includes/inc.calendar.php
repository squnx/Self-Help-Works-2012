<?php
	
	$response = '';

	// Add an entry to the calendar table
	if($_POST['add_calendar_item']) {
		
		// Get the variables
		${'Owner ID'} = $OwnerID;
		${'Description'} = $_POST['description'];
		${'Date'} = $_POST['date'];
		${'Duraction Hours'} = $_POST['duration_hrs'];
		${'Duration Minutes'} = $_POST['duration_mins'];
		${'Start Date'} = $_POST['start_date'];
		${'Finish Date'} = $_POST['finish_date'];
		${'Start Time'} = $_POST['start_time'];
		${'Start ampm'} = $_POST['start_ampm'];
		${'Finish Time'} = $_POST['finish_time'];
		${'Finish ampm'} = $_POST['finish_ampm'];
		${'Start Year'} = $_POST['start_year'];
		${'Finish Year'} = $_POST['finish_year'];
		
		${'Add Query'} = mysql_query('INSERT INTO `calendar` (
																					`owner`,
																					`description`,
																					`date`,
																					`duration_hrs`,
																					`duration_mins`,
																					`start_date`,
																					`finish_date`,
																					`start_time`,
																					`start_ampm`,
																					`finish_time`,
																					`finish_ampm`,
																					`start_year`,
																					`finish_year`
																					) VALUES (
																					"'.${'Owner ID'}.'",
																					"'.${'Description'}.'",
																					"'.${'Date'}.'",
																					"'.${'Duration Hours'}.'",
																					"'.${'Duration Minutes'}.'",
																					"'.${'Start Date'}.'",
																					"'.${'Finish Date'}.'",
																					"'.${'Start Time'}.'",
																					"'.${'Start ampm'}.'",
																					"'.${'Finish Time'}.'",
																					"'.${'Finish ampm'}.'",
																					"'.${'Start Year'}.'",
																					"'.${'Finish Year'}.'"
																					)');
		
		if(${'Add Query'}){
			$response = 'SUCCESS';
		} else {
			$response = 'FAIL - '.mysql_error();
		}
	}
	
	// Delete a Calendar Item
	if($_POST['delete_from_calendar']) {
		
		${'Owner ID'} = $OwnerID;
		${'Calendar Item ID'} = $_POST['item_id'];
		
		${'Delete Query'} = mysql_query('DELETE FROM `calendar` WHERE `id` = "'.${'Calendar Item ID'}.'" AND `owner` = "'.${'Owner ID'}.'" LIMIT 1');
		
		if(${'Delete Query'}) {
			$response = 'SUCCESS';
		} else {
			$response = 'FAIL - '.mysql_error();
		}
		
	}
	
	// Update Calendar Item
	if($_POST['update_calendar_item']) {
		
		// Get the variables
		${'Owner ID'} = $OwnerID;
		${'Item ID'} = $_POST['item_id'];
		${'Description'} = $_POST['description'];
		${'Date'} = $_POST['date'];
		${'Duraction Hours'} = $_POST['duration_hrs'];
		${'Duration Minutes'} = $_POST['duration_mins'];
		${'Start Date'} = $_POST['start_date'];
		${'Finish Date'} = $_POST['finish_date'];
		${'Start Time'} = $_POST['start_time'];
		${'Start ampm'} = $_POST['start_ampm'];
		${'Finish Time'} = $_POST['finish_time'];
		${'Finish ampm'} = $_POST['finish_ampm'];
		${'Start Year'} = $_POST['start_year'];
		${'Finish Year'} = $_POST['finish_year'];
		
		${'Update Query'} = mysql_query('UPDATE `calendar` SET
																					 `owner` =  "'.${'Owner ID'}.'",
																					 `description` = "'.${'Description'}.'",
																					 `date` = "'.${'Date'}.'",
																					 `duration_hrs` = "'.${'Duration Hours'}.'",
																					 `duration_mins` = "'.${'Duration Minutes'}.'",
																					 `start_date` = "'.${'Start Date'}.'",
																					 `finish_date` = "'.${'Finish Date'}.'",
																					 `start_time` = "'.${'Start Time'}.'",
																					 `start_ampm` = "'.${'Start ampm'}.'",
																					 `finish_time` = "'.${'Finish Time'}.'",
																					 `finish_ampm` = "'.${'Finish ampm'}.'",
																					 `start_year` = "'.${'Start Year'}.'",
																					 `finish_year` = "'.${'Finish Year'}.'"
																					  WHERE
																					  `id` = "'.${'Item ID'}.'"
																					   AND `owner` = "'.${'Owner ID'});
		
		if(${'Update Query'}){
			$response = 'SUCCESS';
		} else {
			$response = 'FAIL - '.mysql_error();
		}
	}
?>