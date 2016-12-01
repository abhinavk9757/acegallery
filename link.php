<?php
$link = mysqli_connect('localhost','root','');
    if (!$link) 
        {
            die('Could not connect: ' . mysqli_error());
        }
	
	mysqli_select_db($link,"wpplugin");
?>