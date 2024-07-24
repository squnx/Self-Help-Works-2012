<?php

// **************************************************************************************************************************************
// Cleans an integer, prior to DB use
// Calls the precision round function
// Uses sprintf to avoid scientific notation
// **************************************************************************************************************************************
	function inputCleanInt($int, $dec = 0, $size = 20, $abs = true) {
		
		// If we are only allowing positive, continue
		if ($abs) {
			$int = ($dec) ? preg_replace('/[^0-9\.]/', '', $int) : preg_replace('/[^0-9]/', '', $int);
			$int = mb_substr(sprintf("%.{$dec}f", mathPrecisionRound(abs($int), $dec)), 0, $size);
		} else {
			$int = ($dec) ? preg_replace('/[^0-9\.-]/', '', $int) : preg_replace('/[^0-9-]/', '', $int);
			$int = mb_substr(sprintf("%.{$dec}f", mathPrecisionRound($int, $dec)), 0, $size);
		}
	
		return $int;
	}

// **************************************************************************************************************************************
// Make a string mySQL friendly
// **************************************************************************************************************************************
	function inputCleanSQL($value, $length = 255, $toUpper = false) { 
		$value = mysql_real_escape_string(trim(stripslashes(mb_substr($value, 0, $length))));
		$value = ($toUpper) ? mb_strtoupper($value) : $value;
		return $value;
	}

// **************************************************************************************************************************************
// Prepares a string prior to being inserted into the DB
// Optionally allows a string to be truncated at a given length
// **************************************************************************************************************************************
	function inputCleanText($message, $length = NULL) {
		$length = ($length) ? $length : 65000;
		$message = mb_substr($message, 0, $length);
		$message = trim($message);
		$message = str_replace(chr(10), '', $message);
		$message = str_replace(chr(13), '', $message);
		return mysql_real_escape_string($message);
	}

// **************************************************************************************************************************************
// Clean XML input
// **************************************************************************************************************************************
	function inputCleanXML($input, $length = 65000, $toUpper = false) {

		// Strip any extra slashes
		$input = stripslashes($input);

		// Trim the input
		$input = function_exists('utf8_trim') ? utf8_trim($input) : trim($input);

		// Replace <, &, >
		$input = str_replace(array('<', '>', '&'), array('&lt;', '&gt', '&amp;'), $input);

		// Output XML save UTF-8 characters
		if (function_exists('utf8_tohtml')) {
			$input = utf8_tohtml($input, 'HTML_ENTITIES');
		}

		// Trim the text
		$input = mb_substr($input, 0, $length);

		// If we want uppercase
		$input = ($toUpper) ? mb_strtoupper($input) : $input;

		// Return our clean input
		return $input;
	}

// Function to return xml of selected table by owner id
function calendarXML($info,$calOwner){
	
	$rs = mysql_query("SELECT * FROM `".$info."` WHERE `owner` = '".$calOwner."' ORDER BY `id` DESC") or die(mysql_error());
	if(!$rs) {
		echo 'Error';
		exit;
	} else {
		$fcount = mysql_num_fields($rs); 
		
		echo ("<response>"); 
		while($row = mysql_fetch_array($rs)) {
			echo ("<item>"); 
			for($i=0; $i< $fcount; $i++){
				$tag = mysql_field_name( $rs, $i ); 
				echo ("<$tag>". $row[$i]. "</$tag>"); 
				} 
			echo ("</item>"); 
		} 
		echo ("</response>"); 
	}
}

function foodlogXML($info,$logOwner){
	
	$rs = mysql_query("SELECT * FROM `".$info."` WHERE `owner` = '".$logOwner."' ORDER BY `date_added` DESC") or die(mysql_error());
	if(!$rs) {
		echo 'Error';
		exit;
	} else {
		$fcount = mysql_num_fields($rs); 
		
		echo ("<response>"); 
		while($row = mysql_fetch_array($rs)) {
			echo ("<item>"); 
			for($i=0; $i< $fcount; $i++){
				$tag = mysql_field_name( $rs, $i ); 
				echo ("<$tag>". $row[$i]. "</$tag>"); 
				} 
			echo ("</item>"); 
		} 
		echo ("</response>"); 
	}
}

function SingleArticleXML($info,$article){
	
	$rs = mysql_query("SELECT * FROM `".$info."` WHERE `id` = '".$article."' LIMIT 1") or die(mysql_error());
	if(!$rs) {
		echo 'Error';
		exit;
	} else {
		$fcount = mysql_num_fields($rs); 
		echo ("<kml xmlns=\"http://www.opengis.net/kml/2.2\">");
		echo ("<response>"); 
		while($row = mysql_fetch_array($rs)) {
			echo ("<article>"); 
			for($i=0; $i< $fcount; $i++){
				$column = mysql_field_name( $rs, $i ); 
				if($column != 'tags') { 
					if($column == 'date_posted') {
						${'Formatted Date'} = date("m-d-Y", strtotime($row[$i]));
						echo ("<$column>".${'Formatted Date'}."</$column>");
					} else {
						echo ("<$column>". $row[$i]. "</$column>");
					}
				} }
				echo ("<tags>");
				${'Query'} = mysql_query('SELECT * FROM `article_tags` WHERE `id` IN ('.$row['tags'].')');
				while(${'Query Results'} = mysql_fetch_assoc(${'Query'})){
					echo ("<tag>". ${'Query Results'}['tag'] ."</tag>");	
				}
				echo ("</tags>");
				echo ("<comments>");
				${'Query'} = mysql_query('SELECT * FROM `article_comments` WHERE `article_id` = "'.$row['id'].'" ORDER BY `date` DESC');
				while(${'Query Results'} = mysql_fetch_assoc(${'Query'})) {
					echo ("<comment_id>". ${'Query Results'}['id'] ."</comment_id>");
					echo ("<comment_owner_id>". ${'Query Results'}['owner'] ."</comment_owner_id>");
					echo ("<comment_article_id>". ${'Query Results'}['article_id'] ."</comment_article_id>");
					echo ("<comment_body>". ${'Query Results'}['comment'] ."</comment_body>");
				}
				echo ("</comments>");
			echo ("</article>"); 
			} 										
		echo ("</response>"); 
		echo ("</kml>");
	}
}

function menuXML($info,$menuOwner){

		$rs = mysql_query("SELECT * FROM `".$info."` WHERE `owner` = '".$menuOwner."' ORDER BY `menu_date` DESC") or die(mysql_error());
		$fcount = mysql_num_fields($rs); 
		echo ("<response>"); 
		while($row = mysql_fetch_array($rs)) {
			$rs2 = mysql_query('SELECT * FROM `menu_planner_items` WHERE `owner` = "'.$menuOwner.'" AND `menu_id` = "'.$row['id'].'"') or die(mysql_error());
			$fcount2 = mysql_num_fields($rs2);
			echo ("<menu>"); 
			for($i=0; $i< $fcount; $i++){
				$tag = mysql_field_name( $rs, $i ); 
				echo ("<$tag>". $row[$i]. "</$tag>"); 
			} 
			while($item_row = mysql_fetch_array($rs2)){
				echo ("<item>");
				for($z=0; $z< $fcount2; $z++){
					$item_tag = mysql_field_name( $rs2, $z ); 
					if($item_tag != 'tags') { echo ("<$item_tag>". $item_row[$z]. "</$item_tag>"); };
				}
				echo ("</item>");	
			}
							echo ("<tags>");
							${'Query'} = mysql_query('SELECT * FROM `tags` WHERE `id` IN ('.$row['tags'].')');		
							while($tag_row = mysql_fetch_array(${'Query'})){
								echo ("<tag>". $tag_row['tag'] ."</tag>");	
							}
							echo ("</tags>");
			
			echo ("</menu>");		
		} 	
		echo ("</response>");
	
}

function VisitorIP()
    { 
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
    else $TheIp=$_SERVER['REMOTE_ADDR'];
 
    return trim($TheIp);
    }
	
	
?>