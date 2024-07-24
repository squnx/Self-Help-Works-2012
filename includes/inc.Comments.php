<?php
require_once('inc.main.php');

// Get the Comments
if(!$_POST['new_comment']){

	// Get Global Comment Variables
	if(${'Comment Type'} == 'recipe'){
		${'Search By'} = 'recipe_id';
		${'Comment Type List'} = 'recipe';
		${'Item ID'} = $_GET['rid'];
	}
	if(${'Comment Type'} == 'article'){
		${'Search By'} = 'article_id';
		${'Comment Type List'} = 'article';
		${'Item ID'} = $_GET['article'];
	}
	if(${'Comment Type'} == 'slideshow'){
		${'Search By'} = 'slideshow_id';
		${'Comment Type List'} = 'slideshow';
		${'Item ID'} = $_GET['slideshow'];
	}

	${'Comments Array'} = array();
	${'Comments'} = '';
	${'Comment SQL'} = 'SELECT * FROM `comments` WHERE `type`= "'.${'Comment Type List'}.'" AND `'.${'Search By'}.'` = '.${'Item ID'}.' ORDER BY `id` DESC LIMIT '.${'Number of Comments'};
	${'Comment'} = mysql_query(${'Comment SQL'});
	while(${'Comment Results'} = mysql_fetch_assoc(${'Comment'})) {
		${'Comments Array'}[] = array('Comment' => ${'Comment Results'}['comments'], 'posted_by' => ${'Comment Results'}['usr_name'], 'posted_date' => date('n/j/Y', strtotime(${'Comment Results'}['date'])));
	}
	if(${'Comments Array'}['0']['Comment'] != '') {
		$a=0;
		if(mysql_num_rows(${'Comment'}) < ${'Number of Comments'}) { ${'Number of Comments'} = mysql_num_rows(${'Comment'}); }
		while($a < ${'Number of Comments'}) {
			${'Comments'} .= '<div id="divComment">
									<br><br>'.stripslashes(${'Comments Array'}[$a]['Comment']).'
								</div>
								<!-- BEGIN: divSpace15 -->
									<div class="divSpace15"></div>
								<!-- END: divSpace15 -->
								<div id="divCommentFooter">
									<img src="/images/profile/'.${'Profile Photo'}.'" border="1" style="width:28px; height:28px; vertical-align:middle">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">'.${'Comments Array'}[$a]['posted_by'].'</a>   '.${'Comments Array'}[$a]['posted_date'].'
								</div>';	
			$a++;
		}
	}
}

if($_POST['new_comment'] != '') {
	
	${'New Comment'} = addslashes($_POST['new_comment']);
	${'Owner ID'} = $_POST['owner'];
	${'Comment POST Type'} = $_POST['type'];
	${'Owner Name'} = $_POST['username'];
	if(${'Comment POST Type'} == 'article'){
		${'Type'} = 'article';
		${'Related ID'} = $_POST['article_id'];
	}
	if(${'Comment POST Type'} == 'recipe'){
		${'Type'} = 'recipe';
		${'Related ID'} = $_POST['recipe_id'];
	}
	if(${'Comment POST Type'} == 'slideshow'){
		${'Type'} = 'slideshow';
		${'Related ID'} = $_POST['slideshow_id'];
	}
		 
	${'Add Comment'} = mysql_query('INSERT INTO `comments` (`owner`, `type`, `'.${'Type'}.'_id`, `usr_name`, `comments`, `date`) VALUES ("'.${'Owner ID'}.'", "'.${'Type'}.'", "'.${'Related ID'}.'", "'.${'Owner Name'}.'", "'.${'New Comment'}.'", NOW())') or die(mysql_error());
	
	if(${'Add Comment'}) {
		$_SESSION['Response'] = 'SUCCESS';
	} else {
		$_SESSION['Response'] = 'FAIL: ';
	}
	
}

?>