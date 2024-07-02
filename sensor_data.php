
<?php

$hostname = "localhost";
$username = "root";
$password = "seguros2021";
$database = "sensor_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

echo "Se conecto a la Base de datos";

if(isset($_POST["temperature"]) && isset($_POST["humidity"]) && isset($_POST["controlador"])){
    
    $t = $_POST["temperature"];
	$h = $_POST["humidity"];
    $c = $_POST["controlador"];
    
    $sql = "INSERT INTO dht22 (controlador,temperatura, humedad) values (".$c.", ".$t.", ".$h.")";

    if(mysqli_query($conn, $sql)){
        echo "\nNew record created successfully";

    }else{

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

?>