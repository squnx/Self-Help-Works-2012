<?php

${'Video Training'} = '<div class="page">';
$i=1;
${'Query Video'} = mysql_query('SELECT * FROM `training` WHERE `type` = "training" ORDER BY `id` ASC');
while(${'Video'} = mysql_fetch_assoc(${'Query Video'})) {
	${'Video Training'} .= '<a href="'.${'Video'}['file'].'" class="'.${'Video'}['class'].'">'.${'Video'}['section'].': '.${'Video'}['title'].' '.${'Video'}['length'].'</a>';
	if ($i % 7 == 0) {
				 ${'Video Training'} .= '</div><div class="page">';
			  }
	$i++;
}

${'Video Training'} .= '</div>'; 

?>
