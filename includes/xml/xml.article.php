<?php
require_once('../../includes/inc.main.php');
$ArticleID = $_GET['article'];
/* Get all the calendar items by user.
* 
* User id is defined by $OwnerID
*/
header ("content-type: text/xml");
echo SingleArticleXML('articles',$ArticleID);
?>