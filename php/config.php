<?php

$conn = mysqli_connect("localhost", "root", "", "chatapp","3309");
if(!$conn){
    echo"Connected..." .mysqli_connect_error();
}


?>