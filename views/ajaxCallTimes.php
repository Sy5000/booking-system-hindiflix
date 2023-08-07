<?php
session_start();

require('../model.php');

$_SESSION['sessionDate'] = $_POST['sessionDate'];

  if(isset($_SESSION['sessionDate'])){
            
    $sessionDate = $_SESSION['sessionDate'];
    $movieID = $_SESSION['movieID'];

    showSessionTimes($movieID,$sessionDate);

  } else {

    echo '<p class="nav-link disabled">please choose from the session dates available</p>';

}

?>