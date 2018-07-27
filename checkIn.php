<?php

session_start(); 
include('dbconfig.php'); 
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
 
    //this query will insert into rental in and pull data from the rental_item table then delete the unit 
    $sql = " 
	INSERT INTO rental_in (stock, customer) 
	SELECT stock,customer from on_rent
	where unitID = :unitID ;"; 

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
	
	$sql = "DELETE from on_rent where unitID = :unitID;" ;
	$cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
    
    $conn = null; 
    header('Location:unit.php');  
} 
   ?> 