<?php 

	// Include the needed class
	if(in_array('Billing', $ClassName)) {
			require_once('classes/class.Billing.php');
	}
	if(in_array('Profile', $ClassName)) {
			require_once('classes/class.Profile.php');
	}
	if(in_array('FeatureSet', $ClassName)) {
			require_once('classes/class.FeatureSet.php');
			require_once('classes/class.FeatureSetLabel.php');
	}
	if(in_array('Recipe', $ClassName)) {
			require_once('classes/class.Recipe.php');
	}
		
?>