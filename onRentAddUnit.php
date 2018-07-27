<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
			<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
			
<title>Untitled Document</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="unit.php">Rentals Monitor</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="unit.php">View Units <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add Unit
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="add_unit.php">Check Out</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="add_unit_in.php">Check In</a>
          
          
        </div>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <a class="nav-light" href="login.php?out=1">Logout <span class="sr-only">(current)</span></a>
    </form>
  </div>
</nav>	


	
	<?php 
	include('protected.php');
	include('dbconfig.php');
	//init variabes and keep them null to not bring over variables from last entery
	$stock = null; 
	$customer = null; 
        $model = null; 
	$nextService = null; 
        $annualInspection = null; 
	$contact =null; 
	$rentalStartDate = null;
	$unitID = null; 
	
                
                
	//check if there is numeric id in query string
	if((!empty($_GET['unitID'])) && (is_numeric($_GET['unitID']))){
		
		//stroe in a variable 
		$unitID = $_GET['unitID'];
	
		//select all data for the selected unit
		$sql = "SELECT * FROM on_rent where unitID = :unitID"; 
		$cmd = $conn->prepare($sql); 
		$cmd->BindParam(':unitID', $unitID, PDO::PARAM_INT); 
		$cmd->execute(); 
		$units = $cmd->fetchAll(); 
		
		//store each value in a variable for each unti by using a loop 
		foreach($units as $unit){
			$stock = $unit['stock'];
			$customer = $unit['customer']; 
                        $model = $unit['model'];
			$nextService = $unit['nextService']; 
			$annualInspection = $unit['annualInspection']; 
			$contact = $unit['contact'];
			$rentalStartDate = $unit['rentalStartDate'];
			$unitID = $unit['unitID'];
			
		
		$conn = null; 
	}
        }
	?> 
	
    <!-- create form for data entry --> 
	 <div class="container py-2" > 
            <div class="row">
                <div class="mx-auto col-sm-8">
                    <div class="card">
                        <div class="card-header"> 
                            <h4 class="text-center mb-0">Unit Details</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" action="onRentSave.php" method="post">
                                <div class="text-center justify-content-center"> 
                                
                                    <div class="form-group row ">
									
                                        <label class="col-lg-2 col-form-label form-control-label"  for="stock">Stock# *</label>
                                        <div class="col-lg-4"> 
                                            <input  name="stock" class="form-control" id="stock" required value="<?php echo $stock ; ?> " />
                                        </div>

                                        
                                    <label class=" col-lg-2 col-form-label form-control-label" for="customer" >Customer *</label>
                                    <div class="col-lg-4"> 
                                        <input name="customer" id="customer" class="form-control" placeholder="Enter the Unit number" required value="<?php echo $customer ; ?> " />
                                    </div>
                                      </div>
                                    <div class="form-group row "> 
                                        
                                    <label class="col-lg-2 col-form-label form-control-label" for="model" >Model *</label>
                                    <div class="col-lg-4">
                                        <input  name="model" id="model" class="form-control" placeholder="Enter the OC" value="<?php echo $model ; ?> " />      
                                     </div>
                                  
                                      
                                        <label class=" col-lg-2 col-form-label form-control-label  " for="nextService">Next Service</label>
                                            <div class="col-lg-4"> 
                                                <input type="date" name="nextService" class="form-control" id="nextService" placeholder="Enter the Moving Date" value="<?php echo $nextService ; ?> " />
                                            </div>
                                        
                                    </div>
                                     
                                    <div class="form-group row">
 
                                        <label class=" col-lg-2 col-form-label form-control-label" for="annualInspection">Annual Inspection</label>
                                            <div class="col-lg-4">
                                              <input type="date" name="annualInspection"  class="form-control" id="annualInspection"  value="<?php echo $annualInspection ; ?> " />
                                            </div>

                                        <label class=" col-lg-2 col-form-label form-control-label" for="contact"  >Contact</label>
                                            <div class="col-lg-4">
                                              <input  name="contact" class="form-control" id="contact" placeholder="Enter the Target Date" value="<?php echo $contact ; ?> " />
                                            </div>
                                      </div>
                                <div class="form-group row">  
                                    
                                        <label class="col-lg-2 col-form-label form-control-label" for="rentalStartDate" >Rental Start Date</label>
                                        <div class="col-lg-4">
                                        <input type="date" name="rentalStartDate" class="form-control" id="rentalStartDate" placeholder="rentalStartDate" value="<?php echo $rentalStartDate ; ?> " />
                                        </div>
                                     
                                                
                                        
                                </div>
								<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
                                <div class="col-lg-11 text-center"> 
                                    
                                    <button class="btn btn-danger" href="unit.php" >Cancel</button>
                                    <input type="submit" name="btn_save" class="btn btn-primary col-lg-2 " >
                                </div>
                                
                            </form>
                            </div>
                        </div>  
                        
                    </div> 	
                    </div> 
         
        </div>

	
</body>		
</html>