<?php
session_start();

require('../model.php');

$_SESSION['movieID'] = $_POST['movieID'];

if(isset($_SESSION['movieID'])){

              $movieID = $_SESSION['movieID'];

            $movieSessions = getSessionsData($movieID); // model 
            // return every session of movie by ID 

            showSessionDates($movieSessions); //view 

          } else {
            echo '<p>please chose a movie</p>';
          }

?>