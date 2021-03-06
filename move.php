<?php

session_start(); 
include('dbconfig.php'); 
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
 
    //this query will insert into rental in and pull data from the rental_item table then delete the unit 
    $sql = " 
	INSERT INTO on_rent (stock, customer) 
	SELECT stock,customer from rental_item
	where unitID = :unitID ;"; 

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
	
	$sql = "DELETE from rental_item where unitID = :unitID;" ;
	$cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
    
    $conn = null; 
    header('Location:unit.php');  
    
    
}