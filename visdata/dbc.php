<?php
define ("DB_HOST", "UsrVisData.db.11043774.hostedresource.com"); // set database host
define ("DB_USER", "UsrVisData"); // set database user
define ("DB_PASS","P@55word"); // set database password
define ("DB_NAME","UsrVisData"); // set database name

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

?>



