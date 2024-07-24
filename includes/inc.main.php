<?php

if(!session_id()) {
	session_start();
}

//********************************************* 
//    Include all the files
//*********************************************

	require_once('inc.variables.php');
	require_once('inc.classes.php');
	require_once('inc.functions.php');
	
	
//********************************************* 
//    Connect to MySQL
//*********************************************
	class dbConnect
    { 
    var $Host     = MYSQL_HOST; 
    var $Database = MYSQL_DB; 
    var $User     = MYSQL_USER; 
    var $Password = MYSQL_PASSWORD; 
     
    var $Link_ID  = 0;  
    var $Query_ID = 0;  
    var $Record   = array();  
    var $Row;           
    var $LoginError = ""; 

    var $Errno    = 0;  
    var $Error    = ""; 
     
    function connect() 
        { 
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        }
	}

$db = new dbConnect;
$db->connect();	
	
	// Still need to do real authentication
	if(!$_SESSION['user'] && !$_GET['user']) {

		$OwnerID = '1';
		$_SESSION['user'] = '1';

	} elseif($_SESSION['user'] && !$_GET['user']) {
		
		$OwnerID = $_SESSION['user'];
		
	} elseif(!$_SESSION['user'] && $_GET['user']) {
		
		$OwnerID = $_GET['user'];
		$_SESSION['user'] = $_GET['user'];
		
	} elseif($_SESSION['user'] && $_GET['user']) {
		
		$OwnerID = $_GET['user'];
		$_SESSION['user'] = $_GET['user'];
		
	}
	
//********************************************* 
//    Set the Recipe ID
//*********************************************
	if(isset($_GET['rid'])) {
		$RecipeID = $_GET['rid'];
		$rid = $_GET['rid'];
		
	} else {
		$RecipeID = '40';
		$rid = '40';
	}
	
//********************************************* 
//    Initiate the Profile Class
//*********************************************

if(in_array('Profile', $ClassName)) {
	
		if($_POST['update'] == true) {
			
			$Profile = new ProfileClass; 	
			$ProfileQuery = "SELECT * FROM `profile` WHERE `id`='$OwnerID' LIMIT 1";  
			$Profile->query($ProfileQuery);        
			$Profile->singleRecord();
			${'Profile Photo'} = $Profile->Record['profilephoto'];
			
			if($_FILES['profilephoto']['size'] > 0) {
				
				$filePath='../images/profile/';
				$originalImage = $filepath.$Profile->Record['profilephoto'];				
				chmod($originalImage, 777);				
				unlink($originalImage);		
				$file = $_FILES['profilephoto']['name'];
				$ext = end(explode('.', $file));
				$filename = 'user_'.$OwnerID.'.'.$ext;
				$target = $filePath.'user_'.$OwnerID.'.'.$ext; 
				move_uploaded_file($_FILES['profilephoto']['tmp_name'], $target);
			
			} else {
			
				$filename = ${'Profile Photo'};
			
			}
			mysql_query('UPDATE `profile` SET 
												`password`="'.$_POST['password'].'",
												`firstname`="'.$_POST['firstname'].'",
												`lastname`="'.$_POST['lastname'].'",
												`middleinitial`="'.$_POST['middleinitial'].'",
												`securityquestion`="'.$_POST['securityquestion'].'",
												`securityanswer`="'.$_POST['securityanswer'].'",
												`primaryemail`="'.$_POST['primaryemail'].'",
												`secondaryemail`="'.$_POST['secondaryemail'].'",
												`profilephoto`="'.$filename.'",
												`age`="'.$_POST['age'].'",
												`birthdate`="'.$_POST['birthday'].'",
												`height`="'.$_POST['height'].'",
												`address`="'.$_POST['address'].'",
												`city`="'.$_POST['city'].'",
												`stateprovince`="'.$_POST['state'].'",
												`zip`="'.$_POST['zip'].'",
												`country`="'.$_POST['country'].'",
												`mobilephone`="'.$_POST['mobilenumber'].'",
												`mobileprovider`="'.$_POST['mobileprovider'].'",
												`smsallowed`="'.$_POST['smsallowed'].'",
												`gender`="'.$_POST['gender'].'",
												`startingweight`="'.$_POST['startingweight'].'",
												`visionstatement`="'.$_POST['visionstatement'].'",
												`mainmunches`="'.$_POST['mainmunches'].'",
												`language`="'.$_POST['language'].'",
												`maritalstatus`="'.$_POST['maritalstatus'].'",
												`company`="'.$_POST['company'].'"
												WHERE
												`id` = "'.$OwnerID.'"') or die(mysql_error());
	}
	
	$Profile = new ProfileClass; 	
	$ProfileQuery = "SELECT * FROM `profile` WHERE `id`='$OwnerID' LIMIT 1";  
	$Profile->query($ProfileQuery);        
	$Profile->singleRecord();
	
	${'First Name'} = $Profile->Record['firstname'];
    ${'Middle Initial'} = $Profile->Record['middleinitial'];
    ${'Last Name'} = $Profile->Record['lastname'];
    ${'Username'} = $Profile->Record['username'];
    ${'Password'} = md5($Profile->Record['password']);
	${'Password2'} = $Profile->Record['password'];
    ${'Security Question'} = $Profile->Record['securityquestion'];
    ${'Security Answer'} = $Profile->Record['securityanswer'];
    ${'Primary E-Mail'} = $Profile->Record['primaryemail'];
    ${'Secondary E-Mail'} = $Profile->Record['secondaryemail'];
    ${'Profile Photo'} = $Profile->Record['profilephoto'];
    ${'Age'} = $Profile->Record['age'];
    ${'Height'} = $Profile->Record['height'];
    ${'Birthdate'} = $Profile->Record['birthdate'];
    ${'Starting Weight'} = $Profile->Record['startingweight'];
    ${'Address'} = $Profile->Record['address'];
    ${'City'} = $Profile->Record['city'];
    ${'State/Province'} = $Profile->Record['stateprovince'];
    ${'Zip'} = $Profile->Record['zip'];
    ${'Country'} = $Profile->Record['country'];
    ${'Mobile Number'} = $Profile->Record['mobilephone'];
    ${'Mobile Provider'} = $Profile->Record['mobileprovider'];
    ${'SMS Allowed'} = $Profile->Record['smsallowed'];
    ${'Gender'} = $Profile->Record['gender'];
    ${'Vision Statement'} = $Profile->Record['visionstatement'];
    ${'Main Munches'} = $Profile->Record['mainmunches'];
    ${'Privacy Settings'} = $Profile->Record['privacysettings'];
    ${'Photos'} = $Profile->Record['photos'];
    ${'Language'} = $Profile->Record['language'];
    ${'Marital Status'} = $Profile->Record['maritalstatus'];
    ${'Company'} = $Profile->Record['company'];
		
	if(${'Profile Photo'} == NULL) {
		if(${'Gender'} == 'M') {
			${'Profile Photo'} = 'default-M.png';
		} else {
			${'Profile Photo'} = 'default-F.png';
		}
	}	
}

//********************************************* 
//    Initiate the Billing Class
//*********************************************

if(in_array('Billing', $ClassName)) {
	
	$Billing = new BillingClass; 	
	$BillingQuery = "SELECT * FROM `billing` WHERE `owner`='$OwnerID' LIMIT 1"; 
	$Billing->query($BillingQuery);        
	$Billing->singleRecord();
	
	${'Bank'} = $Billing->Record['bank'];
    ${'Address'} = $Billing->Record['address'];
    ${'City'} = $Billing->Record['city'];
    ${'State/Province'} = $Billing->Record['stateprovince'];
    ${'Zip'} = $Billing->Record['zip'];
    ${'Country'} = $Billing->Record['country'];
    ${'Phone'} = $Billing->Record['phone'];
	
}

//********************************************* 
//    Initiate the Feature Set xRef Class
//*********************************************

if(in_array('FeatureSet', $ClassName)) {
	$FeatureSet = new FeatureSetClass; 	
	$FeatureSetQuery = "SELECT * FROM `feature_set_xref` WHERE `owner`='$OwnerID'";
	$FeatureSet->query($FeatureSetQuery);       
}

//********************************************* 
//    Initiate the Recipe Class
//*********************************************

if(in_array('Recipe', $ClassName)) {
	$Recipe = new RecipeClass; 	
	$RecipeQuery = "SELECT * FROM `recipes` WHERE `id` = '".$RecipeID."' AND `owner`='$OwnerID'"; 
	$Recipe->query($RecipeQuery);
	$Recipe->singleRecord();
	
	// Include single recipe info
	require_once('inc.getRecipe.php');        
}

//*********************************************
// Include Calendar Files
//*********************************************

if(in_array('Calendar', $ClassName)) {
	require_once('inc.calendar.php');
}

//*********************************************
// Include Food Log Files
//*********************************************

if(in_array('FoodLog', $ClassName)) {
	require_once('inc.foodlog.php');
}

//*********************************************
// Include Article Files
//*********************************************

if(in_array('Article', $ClassName)) {
	require_once('inc.article.php');
}

//*********************************************
// Include Slideshow Files
//*********************************************

if(in_array('Slideshow', $ClassName)) {
	require_once('inc.slideshow.php');
}

//*********************************************
// Include Training Video Files
//*********************************************

if(in_array('Training', $ClassName)) {
	require_once('inc.Videotraining.php');
}
	
//********************************************* 
//    Set the Username
//*********************************************
		$UserName = $Profile->Record['username'];

require_once('inc.Comments.php');

// Get the current full URL
	${'Get'} = '';
	foreach ($_GET AS $key=>$val) {
		${'Get'}.=(empty(${'Get'}))?'?':'&';
		${'Get'}.=urlencode($key).'='.urlencode($val);
	}
	${'Current Page'} = URL_FULL_UNSECURE.$_SERVER['SCRIPT_NAME'].${'Get'};
?>