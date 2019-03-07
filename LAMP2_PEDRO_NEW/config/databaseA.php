<?php

$db =  mysqli_connect('localhost','lamp3user','Test123!','pedro');

if (mysqli_connect_errno()){
	echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
      Please try again later</p>";
}

$success = 0;
