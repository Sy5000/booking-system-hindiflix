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

    <!--AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <!--MODAL-->
  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!------PHP REVIEW DATA------->
<?php 

$movieData = getMovieData($movieID); //model
$timeStamp = getMovieSession($sessionID); //model 

?>
<!------PHP REVIEW DATA------->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Movie : <?php echo $movieData['title']; ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><span id="reservation"></span></p>
        <p>Date : <?php echo $timeStamp->format('l jS \o\f F '); ?></p>
        <p>Session time : <?php echo $timeStamp->format('h:i a '); ?></p>
        <p>Patron : <?php echo $_SESSION['lastName'], ', ' , $_SESSION['firstName']; ?></p>
        <p>Admit <?php echo $_SESSION['adultTickets'] + $_SESSION['childTickets']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
  <!-- / MODAL-->
<main>
  
  <div class="container py-4">

    <header class="pb-3 mb-4 border-bottom">
      
      <div class="d-flex justify-content-between">
        <div>
          <a href="home.php" class="align-items-center text-dark text-decoration-none">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg> -->
            <span class="fs-4">HindiFlix Cinema House.</span>
          </a>
        </div>
        
      </div>
    </header>

      <div class="col-md-5 col-lg-12">
      
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:history.back()">Tickets</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirm Booking</li>
          </ol>
        </nav>

      <div class="bg-light heroImgPortal">
        <p>Movie Title</p>
        
      </div>

      <!-- <form method="POST" action="<?php //echo $_SERVER['PHP_SELF']; ?>" > -->
      <br>  
      <h3>Booking Summary</h3>
        <hr class="my-4">
        <h5>Patron</h5>
        <p>Name : <?php echo $_SESSION['lastName'], ', ' , $_SESSION['firstName']; ?></p>
        <p>Email : <?php echo $_SESSION['email']; ?></p>
        <p>Mobile : <?php echo $_SESSION['mobile']; ?></p>
        <h5>Reservations</h5>
        <p><?php echo $_SESSION['adultTickets']; ?> x Adult Ticket<p>
        <!-- do not show if child tickets = 0 -->
        <?php echo (isset($_SESSION['childTickets'])) ? '<p>' . $_SESSION['childTickets'] . ' x Child Ticket</p>' : ''; ?>
        <h5>Total</h5>
        <p><?php echo $_SESSION['childTickets'] + $_SESSION['adultTickets'] ?> Seats Required.</p>
        
        <?php // getPatron(); ?>

        <p></p>
        <br>
        <a href="tickets.php" ><input type="button" value="back / update" ></a>
        <input type="submit" name="submit" id="bookingBtn" value="Confirm reservation">
        <!-- </form> -->
      
      <hr class="my-4" />
    

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022 <!-- replace -->
    </footer>
  </div>
</main>
</body>
</html>
<script>
// AJAX 
// insert a new patron ✅
// insert a new booking ✅
// open modal ✅
// insert booking ID to the DOM (modal)
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