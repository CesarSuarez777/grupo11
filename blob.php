<?php 
header("Content-type: image/gif"); 

if(isset($_GET['id'])){ 
    $foto = $_GET['id']; 
    echo $foto; 
    }  
?>