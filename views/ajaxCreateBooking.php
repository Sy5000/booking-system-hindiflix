<?php 
session_start();

require('../model.php');

// return a new patron required for new booking
//   $patronID = add_patron($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email'], $_SESSION['mobile']);
  
//   if($patronID){

//        // calculate # of booking records
//        $reservations = $_SESSION['adultTickets'] + $_SESSION['childTickets'];
       
//        echo "Thank you your booking reference is : S-", $_SESSION['sessionID'], " R-"; 
    
//         for($i=1; $i <= $reservations; $i++){
    
//           // record the bookings, output 
//           $bookingID = addBooking($patronID, $_SESSION['sessionID']);
          
//           echo $bookingID;
          
//           // sperate each tix 
//           if($i != $reservations){
//             echo "-";
//           }
          
//         }
    
//        echo ".";
    
//       } else {
//         echo "Could not create booking!";
//       }

?> 