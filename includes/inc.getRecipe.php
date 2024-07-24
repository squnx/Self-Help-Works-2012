<?php

if(!isset(${'Number of Reviews'})) {
	${'Number of Reviews'} = 2;
}
if(!isset(${'Number of Notes'})) {
	${'Number of Notes'} = 2;
}
if(!isset(${'Number of Recommendations'})) {
	${'Number of Recommendations'} = 3;
}

// logging the recipe visit for popularity
${'Time Now'} = strtotime(date("Y-m-d G:i:s"));
${'Time In Past'} = strtotime(date("Y-m-d G:i:s", strtotime('-30 minutes', ${'Time Now'})));
${'User IP'} = VisitorIP();

	// chech for user and recipe
	if(isset($OwnerID) && isset($_GET['rid'])){
		
		// get the last visit log
		${'Visit Query'} = mysql_fetch_assoc(mysql_query('SELECT * FROM `recipe_view_log` WHERE `recipe_id` = "'.$_GET['rid'].'" AND `ip_address` = "'.${'User IP'}.'" ORDER BY `date_visited` DESC LIMIT 1'));
		${'Last Visit'} = strtotime(${'Visit Query'}['date_visited']);
		if(${'Time In Past'} >= ${'Last Visit'}){
			mysql_query('INSERT INTO `recipe_view_log` (`recipe_id`, `owner_id`, `visitor_id`, `ip_address`, `date_visited`) VALUES ("'.$_GET['rid'].'", "'.$Recipe->Record['owner'].'", "'.$Profile->Record['id'].'", "'.${'User IP'}.'", NOW())');
		}
		
	}

// Add new review
if(isset($_POST['newreview']) && $_POST['newreview'] != '') {	
	$recipe_id = $_POST['recipe_id'];
	$reviewtoadd = $_POST['newreview'];		
	$query = "INSERT INTO `comments` (`recipe_id`, `usr_name`, `comments`) VALUES ('".$recipe_id."','".${'First Name'}.' '.${'Last Name'}."','".$reviewtoadd."')";
	mysql_query($query);
}

// Add new note
if(isset($_POST['newnote']) && $_POST['newnote'] != '') {	
	$notetoadd = $_POST['newnote'];
	$recipe_id = $_POST['recipe_id'];
	$query = "INSERT INTO `notes` (`recipe_id`, `usr_name`, `notes`) VALUES ('".$recipe_id."','".${'First Name'}.' '.${'Last Name'}."','".$notetoadd."')";
	mysql_query($query);
}

// Get the Ingredients and Measurements
${'Ingredients List'} = array();
$i = 1;
while($i <= 15) {
	if($Recipe->Record['ingredient_'.$i] != '') { ${'Ingredients List'}[] = ucwords($Recipe->Record['ingredient_'.$i]); }
	$i++;
}

${'Measurements List'} = array();
$i = 1;
while($i <= 15) {
	if($Recipe->Record['measure_'.$i] != '') { ${'Measurements List'}[] = ucwords($Recipe->Record['measure_'.$i]); }
	$i++;
}

$z=0;
${'Ingredients'} = '';
foreach(${'Ingredients List'} as ${'Ingredient'}) {
	 ${'Ingredients'} .= ${'Measurements List'}[$z].' - '.${'Ingredient'}.'<br />';
	 $z++;
}


// Get all recipe images
${'Rimages'} = '';
${'Rimage List'} = explode(',', $Recipe->Record['images']);
$imgs = $Recipe->Record['images'];
if($imgs == '') {
	${'Rimages'} .= '<img src="../recipes/dishpics/nopic_260x150.jpg" width="260" height="150" alt="Slide 1">';
} else {
foreach(${'Rimage List'} as $image) {
	${'Rimages'} .= '<img src="../recipes/dishpics/'.$image.'" width="260" height="150" alt="Slide 1">';
}
}

// Get the recipe notes
${'Notes'} = array();
${'Check Notes'} = mysql_result(mysql_query('SELECT * FROM `notes` WHERE `recipe_id` = '.$rid.' ORDER BY `id` DESC LIMIT '.${'Number of Notes'}),0);
if(${'Check Notes'}) {
${'Note'} = mysql_query('SELECT * FROM `notes` WHERE `recipe_id` = '.$rid.' ORDER BY `id` DESC LIMIT '.${'Number of Notes'});
while(${'Note Results'} = mysql_fetch_assoc(${'Note'})) {
	${'Notes'}[] = array('note' => ${'Note Results'}['notes'], 'posted_by' => ${'Note Results'}['usr_name'], 'posted_date' => date('n/j/Y', strtotime(${'Note Results'}['date'])));
}
if(${'Notes'}[0]['note'] != '') {
	
	$a=0;
	${'Recipe Notes'} = '';
	if(mysql_num_rows(${'Note'}) < ${'Number of Notes'}) { ${'Number of Notes'} = mysql_num_rows(${'Note'}); }
	while($a < ${'Number of Notes'}) {
	${'Recipe Notes'} .= ${'Notes'}[$a]['note'].'<br />by '.${'Notes'}[$a]['posted_by'].', '.${'Notes'}[$a]['posted_date'].'<br /><hr width="200" align="left" /><br />'; 
		$a++;
	}
}
}

// Get the 'Also Like' Recipes
${'Sort'} = '';
if(${'Recommendations Sort By'} != '') {
	${'Sort'} .= ' ORDER BY `'.${'Recommendations Sort by'}.'`';
} else {
	${'Sort'} .= ' ORDER BY `id`';
}
if(${'Recommendations Sort Order'} != '') {
	${'Sort'} .= ' '.${'Recommendations Sort Order'};
} else {
	${'Sort'} .= ' DESC';
}
${'Recipe Recommendations'} = array();
${'Recipe Likes'} = mysql_result(mysql_query('SELECT * FROM `recipes_like` WHERE `owner` = "'.$rid.'"'), 0);
${'Recipe Likes Query'} = mysql_query('SELECT * FROM `recipes_like` WHERE `owner` = "'.$rid.'" '.${'Sort'}.' LIMIT '.${'Number of Recommendations'});
if(!${'Recipe Likes'}){
${'Recipe Likes Query'} = mysql_query('SELECT * FROM `recipes` ORDER BY `add_date` DESC LIMIT '.${'Number of Recommendations'}) or die(mysql_error());
while(${'Recipe Results'} = mysql_fetch_assoc(${'Recipe Likes Query'})) {
	$d = array();
	foreach(explode(',', ${'Recipe Results'}) as $s){
		$d[] = $s;
	}
	${'Recipe Recommendations'}[] = array('title' => ${'Recipe Results'}['recipe_name'], 'thumbnail' => $d[0], 'url' => '?rid='.${'Recipe Results'}['id']);
}
} else{
	
while(${'Recipe Results'} = mysql_fetch_assoc(${'Recipe Likes Query'})) {
	${'Recipe Recommendations'}[] = array('title' => ${'Recipe Results'}['title'], 'thumbnail' => ${'Recipe Results'}['thumbnail'], 'url' => ${'Recipe Results'}['url']);
}
}

	$a=0;
	${'Recipe Also Like'} = '';
	if(mysql_num_rows(${'Recipe Likes Query'}) < ${'Number of Recommendations'}) { ${'Number of Recommendations'} = mysql_num_rows(${'Recipe Likes Query'}); }
	while($a < ${'Number of Recommendations'}) {
		if(${'Recipe Recommendations'}[$a]['thumbnail'] == '') {
			$recipeThumb = 'nopic_180x130.jpg';
		} else {
			$recipeThumb = ${'Recipe Recommendations'}[$a]['thumbnail'];
		}
				${'Recipe Also Like'} .= '<div class="divContainer">
					<a href="http://50.17.184.116/nutrition/recipeview.php'.${'Recipe Recommendations'}[$a]['url'].'">
						<div class="divGridFrame">
							<div class="divGridContent">
								<img src="http://50.17.184.116/recipes/dishpics/'.$recipeThumb.'" width="180" height="130" />
								<div class="divGridContentText">'.${'Recipe Recommendations'}[$a]['title'].'</div> 
							</div>
						</div>
					</a>
				</div>';
				$a++;
	}


// Get the Ratings
${'Recipe User Ratings'} = array();
${'Recipe Average Ratings'} = array();
${'Recipe Rating Query'} = mysql_query('SELECT * FROM `recipe_ratings` WHERE `owner_r` = "'.$rid.'"');
while(${'Recipe Rating Results'} = mysql_fetch_assoc(${'Recipe Rating Query'})) {
	if(${'Recipe Rating Results'}['owner_u'] == $OwnerID) {
	${'Recipe User Ratings'}[] = array('rating' => ${'Recipe Rating Results'}['rating']);
	}
	${'Recipe Average Ratings'}[] = ${'Recipe Rating Results'}['rating'];
}
${'Recipe User Rating'} = ${'Recipe User Ratings'}[0]['rating'];
if(${'Recipe User Rating'} == '') { ${'Recipe User Rating'} = 'Rate this Recipe'; } else { ${'Recipe User Rating'} = 'You Rated '.${'Recipe User Ratings'}[0]['rating'].' Stars'; }
${'Recipe Average Rating'} = array_sum(${'Recipe Average Ratings'}) / count(${'Recipe Average Ratings'});

// Add/Edit/Delete Recipe

// Get nutrition categories
${'Nutrition Categories'} = array();
${'Nutrition Category'} = '';
${'Nutrition Categories Query'} = mysql_query('SELECT * FROM `nutrition_cats` WHERE `owner` = "'.$rid.'"') or die(mysql_error());
while(${'Nutrition Categories Results'} = mysql_fetch_assoc(${'Nutrition Categories Query'})) {
	${'Nutrition Categories'}[] = '<img src="../assets/images/'.${'Nutrition Categories Results'}['img'].'" />';
}
foreach (${'Nutrition Categories'} as $image) {
	${'Nutrition Category'} .= $image;
}

// Set the recipe variables
${'Prep Time'} = $Recipe->Record['prep_time'];
${'Cook Time'} = $Recipe->Record['bake_time'];
${'Servings'} = $Recipe->Record['servings'];
${'Recipe Name'} = $Recipe->Record['recipe_name'];
${'Recipe ID'} = $rid;
${'Recipe Description'} = $Recipe->Record['description'];
${'Recipe Category'} = $Recipe->Record['type'];
${'Recipe Author'} = $Recipe->Record['author'];
${'Recipe Date'} = date('n/j/Y', strtotime($Recipe->Record['add_date']));
${'Calories'} = $Recipe->Record['calories'];
${'Directions'} = $Recipe->Record['instructions'];


function getRecipes($recipe_type, $fragNum, $start, $limit) {
	
	${'Recipe Type'} = $recipe_type;
	

	if(${'Recipe Type'} == 'featured'){
		$where = "WHERE `featured` = 1 ORDER BY `add_date` DESC";
	}
	if(${'Recipe Type'} == 'newest'){
		$where = "ORDER BY `add_date` DESC";
	}
	if(${'Recipe Type'} == 'healthiest'){
		$where = "ORDER BY `add_date` DESC";
	}
	
	if(${'Recipe Type'} == 'toprated'){
		$sql = "SELECT a.recipe_name,a.id,a.images,avg(b.rating) FROM recipes a
					LEFT JOIN recipe_ratings b
					ON a.id=b.owner_r
					GROUP BY a.id
					ORDER BY avg(b.rating) DESC LIMIT $start, $limit";					
	}elseif(${'Recipe Type'} == 'mostpopular'){
		$sql = "SELECT a.recipe_name,a.id,a.images,count(b.recipe_id) FROM recipes a
					LEFT JOIN recipe_view_log b
					ON a.id=b.recipe_id
					GROUP BY a.id
					ORDER BY count(b.recipe_id) DESC LIMIT $start, $limit";					
	} else {
	$sql = "SELECT * FROM recipes $where LIMIT $start, $limit";
	$sql2 = "SELECT * FROM recipes $where";
	}
	
	$NumberPages = mysql_num_rows(mysql_query($sql2))/12;
	$result = mysql_query($sql);
	$col = 1;
	${'Recipe Results'} = '<div id="fragment-'.$fragNum.'" class="ui-tabs-panel">
									   		<div class="divContainer">';
	
		while($row = mysql_fetch_assoc($result))
		{
	
	if($row['images'] == 'nopic.png' || $row['images'] == '') {
		$img = 'nopic_180x130.jpg';
	} else {
		$pics = array();
		foreach(explode(',', $row['images']) as $imgs) {
			$pics[] .= $imgs;
		}
		$img = $pics[0];
	}
		
	${'Recipe Results'} .= '<div class="div4col'.$col.'">
                                    		<a href="recipeview.php?rid='.$row['id'].'">
												<div class="divGridFrame">
													<div class="divGridContent">
														<img src="/recipes/dishpics/'.$img.'" width="180" height="130" />
														<div class="divGridContentText">'.$row['recipe_name'].'</div>
													</div>
												</div>
                                    		</a>
                                    	</div>';
									if($col == 4) { $col=1; } else { $col++; }
	
		}
		
		${'Recipe Results'} .= '</div></div>';
		
		$results = ${'Recipe Results'};
		
		return $results;
		
}

function numPages($recipe_type) {
	
	${'Recipe Type'} = $recipe_type;
	

	if(${'Recipe Type'} == 'featured'){
		$where = "WHERE `featured` = 1 ORDER BY `add_date` DESC";
	}
	if(${'Recipe Type'} == 'newest'){
		$where = "ORDER BY `add_date` DESC";
	}
	if(${'Recipe Type'} == 'healthiest'){
		$where = "ORDER BY `add_date` DESC";
	}
	
	if(${'Recipe Type'} == 'toprated'){					
		$sql = "SELECT a.recipe_name,a.id,avg(b.rating) FROM recipes a
					LEFT JOIN recipe_ratings b
					ON a.id=b.owner_r
					GROUP BY a.id
					ORDER BY avg(b.rating) DESC";
					
	}elseif(${'Recipe Type'} == 'mostpopular'){					
		$sql = "SELECT a.recipe_name,a.id,count(b.recipe_id) FROM recipes a
					LEFT JOIN recipe_view_log b
					ON a.id=b.recipe_id
					GROUP BY a.id
					ORDER BY count(b.recipe_id) DESC";
					
	} else {
	$sql = "SELECT * FROM recipes $where";
	}
	
	$NumberPages = mysql_num_rows(mysql_query($sql))/12;
	
	return $NumberPages;
}
	?>