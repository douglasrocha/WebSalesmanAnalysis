<?php

if(isset($_FILES['myfile']) and !$_FILES['myfile']['error']){
    move_uploaded_file($_FILES['myfile']['tmp_name'], "temp.wav");
}
	
?>