<?php 
session_start();

require('../model.php');

$_SESSION['movieID'] = $_POST['movieID'];

    if(isset($_SESSION['movieID'])){

        $movieID = $_SESSION['movieID'];

        $movieSessions = getSessionsData($movieID); // model 

        showSessionDates($movieSessions); //view 

    } else {
        echo '<p>please chose a movie</p>';
    }

//guard clause
if(!$_POST['sessionDate']) return;

$sessionDate = $_POST['sessionDate'];

?>