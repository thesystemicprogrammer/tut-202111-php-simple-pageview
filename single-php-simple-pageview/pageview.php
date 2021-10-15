<?php

header("Content-Type:application/json");

$connection = connectDB();

$result = $connection->query("SELECT * FROM pageviews");
$rows = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($rows);

$result->free_result();
$connection->close();

function connectDB() {
    $connection = mysqli_connect("localhost","tomber", "tomber", "pageview");
    if (mysqli_connect_errno()){
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	    die();
	}

    return $connection;
}
?>