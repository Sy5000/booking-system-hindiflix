
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body>
  <main>
  
    <div class="container py-4">

      <header class="pb-3 mb-4 border-bottom">

        <div class="d-flex justify-content-between">
          <div>
            <a href="#" class="align-items-center text-dark text-decoration-none">
              <span class="fs-4">HindiFlix Cinema House.</span>
            </a>
          </div>

          <div class="logo"><h2>HF</h2></div>

          <div class="p-2">
            <?php $anchorLink = 'movies-section'; // is this required?? ?>
            <a href="home.php" class="p-2">Now Showing</a>
            <a href="?movieStatus=0" class="p-2">Coming Soon</a>
          </div>
        </div>

    </header>

    <div class="heroImgPortal">
      <img src="images/cinemaTwo.jpg" class="heroImgBkg heroIndex" alt="...">
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
                showMoviesCards($movieTable); // view    
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

    <div class="row align-items-md-stretch">
      
      <div class="col-md-6">
   
        <div class="rounded-3 snacksOne p-5 h-100">
            
           <div class="rounded-3 opacity-75 text-light bg-dark p-5">
  
                <h2>Combo Snack Deal</h2>
                <p class="mb-5 mt-5">
                Don't miss out on the mouth-watering snacks available at the cinema!
                We have a wide range of delicious treats from traditional popcorn to Choc Top Ice Creams. Not only will you satisfy your cravings, but you'll also be supporting your local theater. So head over to the snack bar and treat yourself to some delicious goodies to enjoy during the show. Bon appétit!</p>
              <button class="btn btn-outline-light" type="button">View Selection</button>
         
          </div>
          
        </div>

      </div>

      <div class="col-md-6">

        <div class="rounded-3 groupOne p-5 h-100" style="display:flex; align-items:flex-end;opacity:90%;">

          <div class="rounded-3 bg-warning text-dark p-4 w-100" style="opacity:90%;" >
            
            <h2>Group Discounts</h2>
            <p>A perfect opportunity to get together with friends or family and enjoy a movie night without breaking the bank.</p>
            <button class="btn btn-outline-dark" type="button">View Deals</button>
            
          </div>

        </div>  
      </div>  
        <!-- <div class="rounded-3 groupOne p-5">

          <div class="rounded-3 text-light p-5">
            <div class="bg-dark" style="width:90%;z-index:1;height:100%;"></div>
            <h2>Group Discounts</h2>
            <br>
            <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
            <button class="btn btn-outline-info" type="button">Example button</button>
          </div>

        </div>   -->
      


      <!-- <div class="col-md-6">

        <div class="rounded-3 groupOne p-5">

          <div class="rounded-3 opacity-75 text-light p-5">
            <div class="bg-dark" style="width:90%;z-index:1;height:100%;"></div>
            <h2>Group Discounts</h2>
            <br>
            <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
            <button class="btn btn-outline-info" type="button">Example button</button>
          </div>

        </div>  
      </div> -->

    </div>


    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2023 <!-- replace -->
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