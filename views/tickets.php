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
              <span class="fs-4">HindiFlix Cinema House.</span>
            </a>
        </div>

        <div class="logo"><h2>HF</h2></div>

        <div class="p-2 invisible">
          <a href="home.php" class="p-2">Now Showing</a>
          <a href="?movieStatus=0" class="p-2">Coming Soon</a>
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
      <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '&rsaquo; ';">
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
        
        <div class="progress">
          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-label="Success striped example" style="width: 50%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>
      
      </div>
      
      <!-- <input class="btn btn-dark" type="submit" name="submit" value="next"> -->
      
      

    </form>


    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; <?php echo date("Y"); ?> 
    </footer>
  </div>
</main>
</body>
</html>
