<?php
function connect_db($host_name,$host_user,$host_pass,$name_db)
{
	$conn_db=mysqli_connect($host_name,$host_user,$host_pass);
	if(!$conn_db)
	{
	    echo "Error connection to localhost".mysqli_error(); exit();
	}
	mysqli_set_charset($conn_db,"utf8");
	/*
	$select_db=mysqli_select_db($conn_db,$name_db);
	if(!$select_db)
	{
	    echo "Error connection to database".mysqli_error(); exit();
	}
	*/
}
$host_name="localhost";
$host_user="root";
$host_pass="";
$name_db="bukdrive";
$site_name="Red rose";
connect_db($host_name,$host_user,$host_pass,$name_db);
GLOBAL $connection;
$connection = mysqli_connect($host_name,$host_user,$host_pass,$name_db);
if (mysqli_connect_errno())
{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($connection,"utf8");
//mysqli_query("SET NAMES utf8");
define("SERVER",$host_name);
define("DATABASE",$name_db);
define("USERNAME",$host_user);
define("PASSWORD",$host_pass);
function mysqli_getResult($query_string)
{
	$server = SERVER;
	$conn = mysqli_connect($server,USERNAME,PASSWORD);
	if(!$conn) die("Error: " . mysqli_error());
	$db = mysqli_select_db(DATABASE,$conn);
	$query = mysqli_query($query_string,$conn);
	$record = array();
	if($query)
	 while($row = mysqli_fetch_array($query))	$record[] = $row;
	return $record;
	mysqli_close($conn);
}
function mysqli_getRow($query_string)
{
	$server = SERVER;
	$conn = mysqli_connect($server,USERNAME,PASSWORD);
	if(!$conn) die("Error: " . mysqli_error());
	$db = mysqli_select_db(DATABASE,$conn);
	$result = mysqli_query($query_string,$conn);
	$row_num = mysqli_num_rows($result);
	return $row_num;
}
function mysqli_getQuery($query_string)
{
	$server = SERVER;
	$conn = mysqli_connect($server,USERNAME,PASSWORD);
	if(!$conn) die("Error: " . mysqli_error());
	$db = mysqli_select_db(DATABASE,$conn);
	$query = mysqli_query($query_string,$conn);
	return $query;
}
?>