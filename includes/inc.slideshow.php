<?php

// temp code
if(isset($_GET['slideshow'])) {
	${'Slideshow ID'} = $_GET['slideshow'];
	${'Item ID'} = $_GET['slideshow'];
} else {
	${'Slideshow ID'} = 1;
	${'Item ID'} = 1;
	$_GET['slideshow'] = 1;
}

// Get the active slideshow
${'Slideshow ID'} = $_GET['slideshow'];
${'Active Set'} = mysql_fetch_assoc(mysql_query('SELECT * FROM `slideshow_sets` WHERE `id` = '.${'Slideshow ID'}.' AND `active` = 1 LIMIT 1'));
${'Title'} = ${'Active Set'}['name'];
${'Slideshow Tags'} = explode(',', ${'Active Set'}['tags']);
${'Date Posted'} = date("m-d-Y", strtotime(${'Active Set'}['date']));
${'Item ID'} = ${'Active Set'}['id'];
${'Tags'} = array();
foreach(${'Slideshow Tags'} as ${'Tag'}){
	${'Tags'}[] = '<a href="#">'.ucwords(${'Tag'}).'</a>';
}
${'Tags'} = implode(', ', ${'Tags'});
$k = 1;
${'Slideshow'} = '';
${'Owner Info'} = mysql_fetch_assoc(mysql_query('SELECT `firstname`,`lastname` FROM `profile` WHERE `id` = '.${'Active Set'}['id'].' LIMIT 1'));
${'Author'} = ${'Owner Info'}['firstname'].' '.${'Owner Info'}['lastname'];
${'Slides Query'} = mysql_query('SELECT * FROM `slideshow_items` WHERE `set_id` = '.${'Active Set'}['id']);
${'Total Slides'} = mysql_num_rows(${'Slides Query'});
while(${'Slides'} = mysql_fetch_assoc(${'Slides Query'})){
	${'Slideshow'} .= '<div class="slide">
									<a href="'.${'Slides'}['slide_'.$k.'_link'].'" target="_blank"><img src="/images/'.${'Slides'}['slide_'.$k.'_image'].'" width="633" height="323" border="0" /></a>
									<div class="caption" style="bottom:0">
										<p class="slideNumber">SLIDE '.$k.' OF '.${'Total Slides'}.'</p>
										<p>'.${'Slides'}['slide_'.$k.'_desc'].'</p>
									</div>
								</div>';
								$k++;
}

// Nutrition Slides
${'Query'} = mysql_fetch_assoc(mysql_query('SELECT * FROM `nutrition_slides` ORDER BY `id` DESC LIMIT 1'));
${'Nutrition Slides'} = '<li>
										<div><img src="http://50.17.184.116/images/nutrition/'.${'Query'}['slide1'].'" /></div>
									</li>
									<li>
										<div><img src="http://50.17.184.116/images/nutrition/'.${'Query'}['slide2'].'" /></div>
									</li>
									<li>
										<div><img src="http://50.17.184.116/images/nutrition/'.${'Query'}['slide3'].'" /></div>
									</li>
									<li>
										<div><img src="http://50.17.184.116/images/nutrition/'.${'Query'}['slide4'].'" /></div>
									</li>';


?>