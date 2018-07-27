<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function closeToTarget($target_date){ 
    
    $target_date;
    $now = strtotime("today midnight"); 
    $warningDate = strtotime($now. ' + 1 days'); 
    
   if($warningDate == $target_date){
       return  true; 
       echo'true';
   }
   else {
       return false; 
   }
   
    
   }
   
   function allowed_post_params($allowed_params=[]){
       $allowed_array = []; 
       foreach($allowed_params as $param){
           if(isset($_POST[$param])) { 
               $allowed_array[$param] = $_POST[$param]; 
    
           }else {
               $allowed_array[$param] = NULL ;
           }
       } return $allowed_array; 
   } 
  
   $post_params = allowed_post_params(['username', 'password']); 
 
   
   function has_presence($value){
       $trimmed_value = trim($value);
       return isset($trimmed_value) && $trimmed_value !== ""; 
   }
   
   