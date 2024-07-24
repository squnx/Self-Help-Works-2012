<?php

// temp code
if(isset($_GET['article'])) {
	${'Article ID'} = $_GET['article'];
	${'Item ID'} = $_GET['article'];
} else {
	${'Article ID'} = 1;
	${'Item ID'} = 1;
	$_GET['article'] = 1;
}

// Declare Some Variables
	// ${'Article ID'} = $_GET['article'];
	${'Base URL'} = URL_FULL_UNSECURE;
	${'Location'} = '/includes/xml/xml.article.php';
	${'Request URL'} = ${'Base URL'} . ${'Location'} . '?article=' . ${'Article ID'};

	$xml = simplexml_load_file(${'Request URL'}); 
	
	${'Article Owner Query'} = mysql_fetch_assoc(mysql_query('SELECT `firstname`, `lastname` FROM `profile` WHERE `id` = '.$xml->response->article->owner.' LIMIT 1'));
	${'Author'} = ${'Article Owner Query'}['firstname'].' '.${'Article Owner Query'}['lastname'];
	${'Title'} = $xml->response->article->article_title;
	${'Article Top Quote'} = $xml->response->article->top_quote;
	${'Article Body'} = $xml->response->article->article_body;
	${'Date Posted'} = $xml->response->article->date_posted;
	${'Article R'} = $xml->response->article->resources;
	${'Article R'} = explode(',', ${'Article R'});
	
	${'Article Resources'} = '<ul>';
	
	foreach(${'Article R'} as ${'Resource'}){
		${'Article Resources'} .= '<li>'.${'Resource'}.'</li>';
	}
	
	${'Article Resources'} .= '</ul>';
	${'Article Image'} = $xml->response->article->article_image;
	${'Article Thumbnail Image'} = $xml->response->article->article_image_thumbnail;
	${'Article Tags'} = $xml->response->article->tags->tag;
	
	${'Tags'} = array();
	
	foreach(${'Article Tags'} as ${'Tag'}){
		${'Tags'}[] = '<a href="#">'.ucwords(${'Tag'}).'</a>';
	}
	
	${'Tags'} = implode(', ', ${'Tags'});
	
?>