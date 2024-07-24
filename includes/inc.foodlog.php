<?php

$response = '';

// Add item to Food Log
if($_POST['add_foodlog_item']) {
	
	// Get the POST Variables
	${'Owner'} = $OwnerID;
	${'Food'} = $_POST['food'];
	${'Serving'} = $_POST['serving'];
	${'Calories'} = $_POST['calories'];
	${'Fat'} = $_POST['fat'];
	${'Chol'} = $_POST['chol'];
	${'Sodium'} = $_POST['sodium'];
	${'Carbs'} = $_POST['carbs'];
	${'Fiber'} = $_POST['fiber'];
	${'Protein'} = $_POST['protein'];
	${'Sugars'} = $_POST['sugars'];
	${'Meal Time'} = $_POST['meal_time'];
	
	${'Add Query'} = mysql_query('INSERT INTO `food_log` (
																					`owner`,
																					`food`,
																					`serving`,
																					`calories`,
																					`fat`,
																					`chol`,
																					`sodium`,
																					`carbs`,
																					`fiber`,
																					`protein`,
																					`sugars`,
																					`meal_time`
																					) VALUES (
																					"'.${'Owner ID'}.'",
																					"'.${'Food'}.'",
																					"'.${'Serving'}.'",
																					"'.${'Calories'}.'",
																					"'.${'Fat'}.'",
																					"'.${'Chol'}.'",
																					"'.${'Sodium'}.'",
																					"'.${'Carbs'}.'",
																					"'.${'Fiber'}.'",
																					"'.${'Sugars'}.'",
																					"'.${'Meal Time'}.'")');
																					
	if(${'Add Query'}){
		$response = 'SUCCESS';
	} else {
		$response = 'FAIL - '.mysql_error();
	}
}


// Delete a Food Log item
if($_POST['delete_from_foodlog']) {
	
	${'Owner ID'} = $OwnerID;
	${'Food Log Item ID'} = $_POST['item_id'];
	
	${'Delete Query'} = mysql_query('DELETE FROM `food_log` WHERE `id` = "'.${'Food Log Item ID'}.'" AND `owner` = "'.${'Owner ID'}.'" LIMIT 1');
	
	if(${'Delete Query'}) {
		$response = 'SUCCESS';
	} else {
		$response = 'FAIL - '.mysql_error();
	}
	
}

// Update Food Log item
if($_POST['update_foodlog_item']) {
	
	// Get the POST Variables
	${'Owner'} = $OwnerID;
	${'Item ID'} = $_POST['item_id'];
	${'Food'} = $_POST['food'];
	${'Serving'} = $_POST['serving'];
	${'Calories'} = $_POST['calories'];
	${'Fat'} = $_POST['fat'];
	${'Chol'} = $_POST['chol'];
	${'Sodium'} = $_POST['sodium'];
	${'Carbs'} = $_POST['carbs'];
	${'Fiber'} = $_POST['fiber'];
	${'Protein'} = $_POST['protein'];
	${'Sugars'} = $_POST['sugars'];
	${'Meal Time'} = $_POST['meal_time'];
	
	${'Update Query'} = mysql_query('UPDATE `food_log` SET 
																					`food` = "'.${'Food'}.'",
																					`serving` = "'.${'Serving'}.'",
																					`calories` = "'.${'Calories'}.'",
																					`fat` = "'.${'Fat'}.'",
																					`chol` = "'.${'Chol'}.'",
																					`sodium` = "'.${'Sodium'}.'",
																					`carbs` = "'.${'Carbs'}.'",
																					`fiber` = "'.${'Fiber'}.'",
																					`protein` = "'.${'Protein'}.'",
																					`sugars` = "'.${'Sugars'}.'",
																					`meal_time` = "'.${'Meal Time'}.'"
																					WHERE
																					`owner` = "'.${'Owner'}.'"
																					AND `id` = "'.${'Item ID'});
																					
	if(${'Update Query'}){
		$response = 'SUCCESS';
	} else {
		$response = 'FAIL - '.mysql_error();
	}
}
?>