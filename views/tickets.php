<?php require('../model.php'); ?>
<?php 
session_start();
$mobileErr = null;
// avoid resetting sessionID if user navigates < from review.php
if(!isset($_SESSION['sessionID'])){
  $_SESSION['sessionID'] = $_GET['sessionID'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // update global session vars
    $_SESSION['adultTickets'] = $_POST['adultTicket'];
    $_SESSION['childTickets'] = $_POST['childTicket'];
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['email'] = $_POST['email'];

    // update to str_contains() php8+ (strpos, $haystack, $needle)
    if(strpos($_POST['mobile'], ' ') !== false || strlen($_POST['mobile']) < 10) {
      $mobileErr = "Please enter a valid Phone Number (10 digits minimun, No Spaces)!";
    } else {
      $_SESSION['mobile'] = $_POST['mobile'];
    }

  if($_SESSION['adultTickets'] && $_SESSION['firstName'] && $_SESSION['lastName'] && $_SESSION['email'] && $_SESSION['mobile'] && !$mobileErr){

    header('Location: review.php');

  } else {
    echo "Could not submit form, Please try again!";
  }

}
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>
<?php 
$movieID = $_SESSION['movieID'];
$sessionID = $_SESSION['sessionID'];
$movieData = getMovieData($movieID); //model
$timeStamp = getMovieSession($sessionID); //model 
?>
<!doctype html>
<html>
<head>
    <title>Booking Page</title>
    <link rel="stylesheet" href="../style.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main>
  
  <div class="container py-4">

    <header class="pb-3 mb-4 border-bottom mb-0">
      
      <div class="d-flex justify-content-between">
        <div>
          <a href="home.php" class="align-items-center text-dark text-decoration-none">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg> -->
            <span class="fs-4">HindiFlix Cinema House.</span>
          </a>
        </div>
        
      </div>
    </header>

    <div class="mb-0 heroImgPortal" >
      <!-- <img src="https://upload.wikimedia.org/wikipedia/en/9/99/Dangal_Poster.jpg" class="heroBkg" alt="" > -->
      <img src="<?php echo $movieData['thumb']; ?>" class="heroBkg" alt="<?php echo $movieData['title']; ?> bollywood movie poster promo image XL" >
        
      <div class="mask">

        <div class="mask-content">
          <div>
            <p>Movie : </p>
            <h3><?php echo $movieData['title']; ?></h3>
            <p><?php echo $movieData['year']; ?></p>
          </div>

          <div>
            <img src="<?php echo $movieData['thumb']; ?>" class="movThumb" alt="<?php echo $movieData['title']; ?> bollywood movie poster promo image thumbnail">
          </div>
          
          <div>
          <p>Screening : </p>
            <h4><?php echo $timeStamp->format('l'); ?></h4>
            <p><?php echo $timeStamp->format('h:i a '); ?></p>
          </div>
        </div>
          
        </div>
        
    </div>

    <div class="p-3 bg-dark mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-white">
          <li class="breadcrumb-item"><a class="link-light" href="home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tickets</li>
        </ol>
      </nav>
    </div>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>" >

      <div class="row mx-auto col-lg-7">
        <h4>Ticket options</h4>
      </div>

      <div class="row justify-content-center">
          <div class="col-lg-3">
              <label for="adultTicket" class="form-label">Adults</label>
              <input min="1" max="4" type="number" class="form-control" name="adultTicket" value="<?php echo (isset($_SESSION['adultTickets']) ? $_SESSION['adultTickets'] : ''); ?>" required>
          </div>
          <div class="col-lg-3">
              <label for="childTicket" class="form-label">Children (18 and under)</label>
              <input min="0" max="4" type="number" class="form-control" name="childTicket" value="<?php echo (isset($_SESSION['childTickets']) ? $_SESSION['childTickets'] : '0'); ?>" required>
          </div>
      </div>

      <hr class="my-4">
      
      <div class="row mx-auto col-lg-7">
        <h4>Booking details</h4>
      </div>

      <div class="row justify-content-center">
        
        <div class="col-lg-3">
              <label for="fName" class="form-label">First Name:</label>
              <input type="text" class="form-control" name="firstName" value="<?php echo (isset($_SESSION['firstName']) ? $_SESSION['firstName'] : ''); ?>" required>
          </div>
          <div class="col-lg-3">
              <label for="lName" class="form-label">Last Name:</label>
              <input type="text" class="form-control" name="lastName" value="<?php echo (isset($_SESSION['lastName']) ? $_SESSION['lastName'] : ''); ?>" required>
          </div>

      </div>

      <div class="mx-auto  col-lg-6">
          <label for="email" class="form-label">E-mail:</label>
          <input type="email" class="form-control" name="email" value="<?php echo (isset($_SESSION['email']) ? $_SESSION['email'] : ''); ?>" required>
      </div>

      <div class="mx-auto  col-lg-6">
          <label for="mobile" class="form-label">Phone number:</label>
          <input type="tel" class="form-control" name="mobile" value="<?php echo (isset($_SESSION['mobile']) ? $_SESSION['mobile'] : ''); ?>" required>
          <span><?php echo (isset($mobileErr)) ? $mobileErr : '';  ?></span>
      </div>

      <br>

      <div class="d-grid gap-2 col-6 mx-auto">
        <!-- <button class="btn btn-primary" type="button">Button</button> -->
        <button class="btn btn-dark" type="submit" name="submit">Next</button>
      </div>
      
      <!-- <input class="btn btn-dark" type="submit" name="submit" value="next"> -->
      
    </form>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022 <!-- replace -->
    </footer>
  </div>
</main>
</body>
</html>
