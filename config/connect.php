<?php
ini_set("error_reporting", 1);
ini_set("display_errors", E_ALL);

// ---------------- Some constants (START) ----------------------
/* LOCAL SERVER DETAILS */
/*
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "rootwdp");
define("DATABASE", "fund");
*/

 /*LIVE SERVER  DETAILS */
define("HOST", "thefundraiser.db.11043774.hostedresource.com");
define("USER", "thefundraiser");
define("PASSWORD", "LightLife498@");
define("DATABASE", "thefundraiser");

// ---------------- Database connectivity (START) -------------------------
$con = "";
// create function to connect to database
function connect()
{
	global $con;
	$con = mysql_connect(HOST, USER, PASSWORD);
	
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	if(!mysql_select_db(DATABASE))
	{
		die('Could not select database: ' . mysql_error());
	}
}

// function to disconnect from database
function disconnect()
{
	global $con;
	mysql_close($con);
}
// ---------------- Database connectivity (END) -------------------------

// call connect function to connect to database
connect();
?>