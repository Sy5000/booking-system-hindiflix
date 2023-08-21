
<?php
session_start();
// reset state
session_unset();
session_destroy();
?>
<?php require('../model.php'); ?>

<!doctype html>
<html>
<head>
    <title>Cinema App</title>
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>

    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>
<body>
<main>
  
  <div class="container py-4">

    <header class="pb-3 mb-4 border-bottom">

      <div class="d-flex justify-content-between">
        <div class="">
          <a href="#" class="align-items-center text-dark text-decoration-none">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg> -->
            <span class="fs-4">HindiFlix Cinema House.</span>
          </a>
        </div>
        <div class="p-2">
          <?php $anchorLink = 'movies-section'; ?>
          <a href="home.php" class="p-2">Now Showing</a>
          <a href="?movieStatus=0" class="p-2">Coming Soon</a>
        </div>
      </div>
    </header>

    <div>
    <img src="images/imgThree.jpg" class="heroImg" alt="...">
    </div>

    <br>
    
    <?php 
    // controller here 
    // guard clause to return when movies have no session etc 
    $movieStatus = (isset($_GET['movieStatus'])) ? $_GET['movieStatus'] : '1'; 
    // page default =1 ~active movies |  =0 ~ inactive movies
    echo ($movieStatus === '1') ? '<p>Now Showing</p>' : '<p>Coming Soon</p>' ;
    ?>
    <div class="p-2 mb-0 bg-light rounded-3 scroll-wrapper">
        <div class="container-fluid py-0 ">
            <!-- <div class="scroll-wrapper"> -->
            <div class="scroll-content"> 
                <?php
                $movieTable = getMoviesData($movieStatus); //model
                showMovieCards($movieTable); // view    
                ?>    
            </div>
        </div>
    </div>

    <br>

    <p>Session Times</p>

    <div class="p-3 bg-light border rounded-3">
    
      <ul class="nav nav-pills nav-fill"  id="movDates">
        <p class="nav-link disabled">To view session times please choose a movie</p>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Active</a>
        </li> -->

      </ul>
    

      <!-- <ul class="list-inline text-center">
         
      <div id="movDates">To view session times please choose a movie</div>
          
      </ul> -->

      <table class="table">
        <tbody>

          <tr></tr>

          <tr id="movTimes" class="border-top">

          </tr>
          
        </tbody>
      </table>
    </div>
    
    <br>

    <!-- <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Change the background</h2>
          <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
          <button class="btn btn-outline-light" type="button">Example button</button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Add borders</h2>
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <button class="btn btn-outline-secondary" type="button">Example button</button>
        </div>
      </div>
    </div> -->

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022 <!-- replace -->
    </footer>
  </div>
</main>

<script>

let movBtn = document.getElementsByClassName('movBtn');

$(movBtn).click(function(){

// toggle active movie button
document.querySelectorAll('.movBtn').forEach(el => el.classList.remove("active"));
this.classList.add("active");

// movie choice for AJAX call 
let movieID = $(this).val();

// pass movie choice to php script 
$.ajax({
    url: 'ajaxCallDates.php',
    type: "POST",
    data: ({ movieID: movieID }),
    cache: false,
    success: function(response) {
      // console.log(response);

      // no useful data returned
      if(response === ''){
      document.getElementById("movDates").innerHTML = '<p class="nav-link disabled">Showing dates TBC</p>';
      // reset times if user changes Movie Selection
        document.getElementById("movTimes").innerHTML = ' ';
      }

      if(response){
        // remove old times if user selects new Movie Selection
        document.getElementById("movTimes").innerHTML = ' ';

        // update DOM with server response 
        document.getElementById("movDates").innerHTML = response;

        // new dynamic buttons in DOM
        const movDateBtn = document.querySelectorAll('.movDateBtn');
    
        movDateBtn.forEach(el => el.addEventListener('click', event => {
          // user chooses date. pass value to handler
          callSessionsHandler(el.value); // chosenDate
          
          // toggle active class
          document.querySelectorAll('.movDateBtn').forEach(el => el.classList.remove("active"));
          el.classList.add("active");

        }));
      } 
    }
  });
})

function callSessionsHandler(chosenDate){

  // console.log(chosenDate, 'date passed');

  $.ajax({ 
    url: 'ajaxCallTimes.php',
    type: "POST",
    data: ({ sessionDate: chosenDate }),
    cache: false,
    success: function(response) {
      // no useful data returned
      if(response === ''){
        document.getElementById("movDates").innerHTML = '<p class="nav-link disabled">Showing Times TBC</p>';
      }

      if(response){
        // update DOM with server response 
        document.getElementById("movTimes").innerHTML = response;

      } 
    }

  });
}

</script>

</body>
</html>