<?php require('config.php'); ?>
<?php
// functions 
// default. active '1' || user requests coming soon '0'
function getMoviesData($movieStatus){
  global $pdo;
  $movieTable = $pdo->query('SELECT * FROM Movie WHERE active =' . $movieStatus);
  return $movieTable;
}

function showMoviesCards($movieTable){
  foreach ($movieTable as $row)
  {
    echo '<div class="card d-inline-block" data-movieID=' . $row['movieID'] . '>';

    echo '<img class="card-img-top" src="' . $row['thumb'] . '" alt="">
    <h5 class="card-title">' . $row['title'] . '</h5>
    <p class="card-title">' . $row['year'] . '</p>
    <button class="btn btn-outline-secondary movBtn" type="button" value="' . $row['movieID'] . '" >sessions</button>';
    //echo '<button class="btn btn-outline-secondary">but link</button>';
    echo '</div>';
  }
}

function getSessionsData($movieID){
  global $pdo;
  $movieSessions = $pdo->query('SELECT * FROM Sessions WHERE MovieID =' . $movieID);
  return $movieSessions;
}

// generate date links by movie chosen
function showSessionDates($movieSessions){

  $lastDate = null; //echo 

  foreach($movieSessions as $row){
    
    $session = date_create($row['sessionDate']);
    $date = date_format($session, 'Y-m-d');

    if (is_null($lastDate) || $lastDate !== $date) {
      // echo "<a href='home.php?movieID={$row['movieID']}&sessionDate={$date}#movies-section'><li class='list-inline-item'><h6 class='display-8'>" . $session->format('d/m/y') . "</h6></li></a>";
      // echo ' <button class="btn btn-outline-secondary movDateBtn" type="button" value="' . $date . '" >' . $session->format('d/m/y') . '</button> ';
      echo '<li class="nav-item">';
      echo '<button class="nav-link movDateBtn" value="' . $date . '">'. $session->format('d/m/y') .'</button>'; 
      echo '</li>';
    }

    $lastDate = $date;
    echo "<br>";
  }
}

// generate movie sessions by date chosen
function showSessionTimes($movieID,$sessionDate){

  global $pdo;
  $movieTimes = $pdo->query("SELECT *
  FROM Sessions 
  WHERE sessionDate LIKE '%{$sessionDate}%'
  AND movieID = {$movieID}");

  $counter = 0;

  forEach($movieTimes as $row){

    $time = date_create($row['sessionDate']);
    
    if($counter < 1){
      echo '<th scope="row"><h4>' . $time->format('l') . '</h4></th>';
      $counter++;
    }

    echo "<td><a href='tickets.php?movieID={$movieID}&sessionID={$row['sessionID']}'><button class='btn btn-outline-secondary'> 
    <!--ID={$row['sessionID']}--> " . $time->format('h:i A') . "</button></a></td>";
  }
}

// new patron function (prepared)
function add_patron($firstName, $lastName, $email, $mobile)
{
	global $pdo;
	$sql = "INSERT INTO patron ( firstName, lastName, email, mobile)
  	VALUES ('$firstName', '$lastName', '$email', '$mobile');";
	$statement = $pdo->prepare($sql);
	$statement->bindValue(':firstName', $firstName);
	$statement->bindValue(':lastName', $lastName);
	$statement->bindValue(':email', $email);
  $statement->bindValue(':mobile', $mobile);
	$statement->execute();
	$statement->closeCursor();
  // return the Primary Key created by the last INSERT cmd
	$patronID = $pdo->lastInsertId();
  return $patronID;
}
// new booking (prepared)
function addBooking($patronID,$sessionID){
  global $pdo;
  $sql = "INSERT INTO Booking ( patronID, sessionID)
   VALUES ('$patronID', '$sessionID');";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':patronID', $patronID);
  $statement->bindValue(':sessionID', $sessionID);
  $statement->execute();
  $statement->closeCursor();
  // return PK from last INSERT cmd
  $bookingID = $pdo->lastInsertId();
  return $bookingID;
}
// review page functions 
function getMovieData($movieID){
  global $pdo;
  $result = $pdo->query('SELECT * FROM Movie WHERE movieID =' . $movieID);
  // fetch() is method for single row array 
  $movieData = $result->fetch();
  return $movieData;
}

function getMovieSession($sessionID){
  global $pdo;
  $result = $pdo->query('SELECT * FROM Sessions WHERE sessionID =' . $sessionID);
  $movieSession = $result->fetch();
  
  $timeStamp = date_create($movieSession[2]); // i = ['sessionDate']
  return $timeStamp;
  // echo $timeStamp->format('h:i a ');
  // echo $timeStamp->format('l jS \o\f F ');
}

?>