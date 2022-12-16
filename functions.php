<?php
function getShippingDate($orderDate, $orderTime) {
	
    //$orderTime = "10:00"; // order time 
    //$orderDate = '14-12-2022'; //order date as as today
    $allHolidays = array('15-12-2022','16-12-2022', '17-12-2022','18-12-2022'); //holidays in dates
    $cutOffTime = "11:00"; //cutoff time
    
    if($orderTime >= $cutOffTime) { //if user order after 11am
       //order after 11
           array_push($allHolidays, $orderDate); //adding current date into holiday to prevent shipping today
           while(in_array($orderDate,$allHolidays)) { //checking order date in holidays
               $orderDate = date('d-m-Y', strtotime("$orderDate +1 day")); //check next available day if holiday found
             }
        return $orderDate;
    }else{ //if user order before cutoff time
        //order before 11
         while(in_array($orderDate,$allHolidays)) {
             if($orderDate == date('d-m-Y')){ //check 
                 $orderDate = date('d-m-Y', strtotime("$orderDate +1 day"));
             }else {
                 $orderDate = date('d-m-Y', strtotime("$orderDate +1 day"));
             }
         }
        return $orderDate;
    }
    return false;
}

if(isset($_POST['call'])){
 echo getShippingDate($_POST['date'], $_POST['time']);   
}

?>
