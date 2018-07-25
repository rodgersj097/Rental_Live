<?php

session_start(); 
include('dbconfig.php');
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
   
    //create sql query to run 
    $sql = "DELETE  FROM rental_in where unitID = :unitID;";
            
            
    //prepare sql statment and bind named placeholders to variables 
    $cmd = $conn->prepare($sql);
    $cmd->bindValue(':unitID', $unitID, PDO::PARAM_INT );
    $cmd->execute(); 
    //close connection to database 
    $conn = null;
    //redirect to main page 
    header('location:unit.php');
}
 