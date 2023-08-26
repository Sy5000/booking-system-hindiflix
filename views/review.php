<?php require('../model.php'); ?>
<?php 
session_start();
$movieID = $_SESSION['movieID'];
$sessionID = $_SESSION['sessionID'];
?>
<!doctype html>
<html>
<head>
    <title>Booking Page</title>
    <link rel="stylesheet" href="../style.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--barcode wingdings-->
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <!--AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <!------PHP REVIEW DATA------->
  <?php 
  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";

  $movieData = getMovieData($movieID); //model
  $timeStamp = getMovieSession($sessionID); //model 
  ?>
  <!------PHP REVIEW DATA------->
  <main>
  
    <div class="container py-4">

      <header class="pb-3 mb-4 border-bottom">
      
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
            <li class="breadcrumb-item"><a class="link-light" href="javascript:history.back()">Tickets</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirm Booking</li>
          </ol>
        </nav>
      </div>

      <!-- <form method="POST" action="<?php //echo $_SERVER['PHP_SELF']; ?>" > -->
      <div class="row mx-auto col-lg-7">
          <br>  
        <h3>Booking Summary</h3>
      </div>
      
      <hr class="my-4">
    
      <div class="row mx-auto col-lg-7">
          <h5>Patron</h5>
          <p>Name : <?php echo $_SESSION['lastName'], ', ' , $_SESSION['firstName']; ?></p>
          <p>Email : <?php echo $_SESSION['email']; ?></p>
          <p>Mobile : <?php echo $_SESSION['mobile']; ?></p>
      </div>

      <hr>

      <div class="row mx-auto col-lg-7">
          <h5>Reservations</h5>
          <p><?php echo $_SESSION['adultTickets']; ?> x Adult Ticket</p>
          <!-- do not show if child tickets = 0 -->
          <?php echo (isset($_SESSION['childTickets'])) ? '<p>' . $_SESSION['childTickets'] . ' x Child Ticket</p>' : ''; ?>
          <h5>Total</h5>
          <p><?php echo $_SESSION['childTickets'] + $_SESSION['adultTickets'] ?> Seats Required.</p>
          
          <?php // getPatron(); ?>

          <p></p>
      </div>

      <br>
    
      <div class="d-grid gap-2 col-lg-7 mx-auto">
        
        <a href="tickets.php" ><input class="btn btn-secondary col-12" value="back / update" ></a>
        <input class="btn btn-dark" type="submit" name="submit" id="bookingBtn" value="Confirm reservation" role="button">
        
        <div class="progress">
          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-label="Success striped example" style="width: 99%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">99%</div>
        </div>

      </div>
        
      <!-- </form> -->
    
      <footer class="pt-3 mt-4 text-muted border-top">
        &copy; <?php echo date("Y"); ?> 
      </footer>

    </div>

    <!-- Admit : <?php echo $_SESSION['adultTickets'] + $_SESSION['childTickets']; ?> patron(s) -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-light bg-opacity-90 border border-5 rounded-4">
          <div class="modal-header">
            <h1 class="modal-title fs-4" id="staticBackdropLabel">
            Movie : <?php echo $movieData['title']; ?>
            </h1>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0"><span class="faux-barcode">Faux Barcode Area</span></p>
            <p class="pt-0"><span id="reservation"></span></p>
            <hr>
            <p>Patron : <strong><?php echo $_SESSION['lastName'], ', ' , $_SESSION['firstName']; ?></strong></p>
            <p>Date : <?php echo $timeStamp->format('l\, jS \o\f F '); ?></p>
            <p>Session time : <?php echo $timeStamp->format('h:i a '); ?></p>  
          </div>

          <div class="modal-footer">
          
              <p><em>Admit : <?php echo $_SESSION['adultTickets'] + $_SESSION['childTickets']; ?> patron(s)</em></p>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      
          </div>

        </div>
      </div>
    </div>
    <!-- / ModalL-->

  </main>
</body>
</html>
<script>
// AJAX 
// insert a new patron ✅
// insert a new booking ✅
// open modal ✅
// insert booking ID to the DOM (modal) ✅
const bookingBtn = document.getElementById('bookingBtn');
const reservation = document.getElementById('reservation');

$(bookingBtn).click(function(){

$.ajax({
    url: 'ajaxCreateBooking.php',
    type: "POST",
    // data: ({ movieID: movieID }),
    cache: false,
    success: function(response) {

      // no useful data returned
      if(response === ''){
     console.log('no res');
      }
      // ajax created a patron and made a booking
      if(response){
       console.log('res', response);
       // innerhtml the response to the modal
       reservation.innerHTML = response;
       //open modal
       $("#staticBackdrop").modal("show");
      }
    }
  });
});
</script>