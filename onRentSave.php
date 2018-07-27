<!DOCTYPE html>
<html>
<head>
    <title> saving unit... </title> 
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

</head>
<body> 
<a href="unit.php" title="view unit" > View Units </a> 
<br>


<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);
 session_start();
 include('dbconfig.php');
//include('inputLog.php');

//store form values in variable 
$stock = $_POST['stock'];
   
If(isset($_POST['customer'])){
$customer = $_POST['customer'] ;
    }
 if(isset($_POST['model'])){
     $model = $_POST['model'];
 }  
$nestService= $_POST['nextService'];

$contact = $_POST['contact'];

$rentalStartDate = $_POST['rentalStartDate'];

 //add unit ID in case of editing        
$unitID =$_POST['unitID'];
        
//create flag to track completion status of the form 
$flag = true; 

if(empty($stock)){
    echo 'Stock# is a required Field<br />';
    $flag = false; 
}

if(empty($customer)){
    echo 'Customer is a required Field <br />';
    $flag = false; 
}


if(empty($model)){
    echo 'Model is a required Field <br />';
    $flag = false; 
}



//save only if the form is complete 
if($flag){
   
    try{
 
    
    
      //IF there is already a entry with the unitID then append that unitID, if no unitID is found then create a new ID. this is how the edit workflow is handled    
    if($unitID > 0 ){
        $sql = "UPDATE on_rent stock=:stock,customer=:customer,model=:model,nextService=:nextService,annualInspection=:annualInspection,contact=:contact,rentalStartDate=:rentalStartDate where unitID=:unitID";
      
       }
    else{
        $sql = "INSERT INTO on_rent (stock,customer,model,nextService,annualInspection,contact,rentalStartDate) VALUES ( :stock,:customer,:model,:nextService,:annualInspection,:contact,:rentalStartDate)";    
           
		  }
        
 
        //set up an sql command to save new unit
   
    //store sql query inside cmd variable 
    $cmd= $conn->prepare($sql);
   // writeTOFile($sql);
    //bind named placeholders into variables
    $cmd->bindParam(':stock', $stock, PDO::PARAM_INT);
    $cmd->bindParam(':customer', $customer, PDO::PARAM_INT);
    $cmd->bindParam(':model', $model, PDO::PARAM_STR);
    $cmd->bindParam(':nextService', $nextService, PDO::PARAM_STR);
    $cmd->bindParam(':annualInspection', $annualInspection, PDO::PARAM_STR);
    $cmd->bindParam(':contact', $contact, PDO::PARAM_STR); 
    $cmd->bindParam(':rentalStartDate', $rentalStartDate, PDO::PARAM_STR);
   //bind variable to named place holder ands save inside cmd 
   if($unitID >0){
        $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    }
    //execute query 
    $cmd->execute(); 
    
    echo'<div class="alert alert-success" role="alert"> 
	<h1 class="alert Heading">Success!</h1>
	<p>Unit Saved</p>
	</div>'; 
   
   } catch(Exception $e){
        echo 'Error ' ,$e->getMessage();
    }
    
    $conn = null; 
  // header("refresh:1;url=unit.php"); 
}
else {
    echo 'failed';
}

?>
</body> 

</html>
