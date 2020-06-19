<?php

if(!empty($_POST["send"])) {
	$name = $_POST["userName"];
	$content = $_POST["content"];

	$conn = mysqli_connect("localhost", "root", "", "savepeats") or die("Connection Error: " . mysqli_error($conn));
	mysqli_query($conn, "INSERT INTO login (user_name,content) VALUES ('" . $name. "','" . $content. "')");
	$insert_id = mysqli_insert_id($conn);
	//if(!empty($insert_id)) {
	   $message = "You successfully.";
	   $type = "success";
	//}
}
require_once "suborder.php";

include "read.php";
?>