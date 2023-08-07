<?php

echo '<h1>Confirm booking details</h1>';

require('config.php');


function get_patronID(){
    global $pdo;
    $patron = $pdo->query("SELECT * FROM patron ORDER BY patronID DESC LIMIT 1");
    return $patron;
}
$patron = get_patronID();

forEach($patron as $row){
    echo "patron ID here - - >";
    echo $row['patronID'];
}

?>