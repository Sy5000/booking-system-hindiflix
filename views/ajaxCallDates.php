<?php
session_start();

require('../model.php');

$_SESSION['movieID'] = $_POST['movieID'];

if(isset($_SESSION['movieID'])){

          $movieID = $_SESSION['movieID'];

          $movieSessions = getSessionData($movieID); // model 
          // return every session of movie by ID 

          showSessionDates($movieSessions); //view 

        } else {
          echo '<p class="nav-link disabled">please choose from the movie titles available</p>';
        }

?>