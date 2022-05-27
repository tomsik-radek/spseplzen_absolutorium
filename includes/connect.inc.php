<?php

    $dbServerName = "localhost";
    $dbUsername = "dbhandler_oSTNd";
    $dbPassword = "PueAK6mJ";
    $dbName = "absolventka";

    $conn = new mysqli($dbServerName,$dbUsername,$dbPassword,$dbName);
    $connNP = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    if(!$connNP){
        die("Connection failed in connect.php: " . mysqli_connect_error());
    }

    //echo "connection to DB successfull <br>";