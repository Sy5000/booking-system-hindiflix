<?php
// DB Credentials
$host = 'localhost';
$db = 'hindiflix';
$user = 'root';
$password = 'root';

//DB connection var
$conn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
// PDO stores all variables as 1 object
$pdo = new PDO($conn, $user, $password);

		if ($pdo) {
		// delete comment out to test connections
		// echo "Connected to '$db' database";
	}

} catch (PDOException $e) {
	echo $e->getMessage();
}
?>