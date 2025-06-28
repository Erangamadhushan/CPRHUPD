<?php
    $servername = "localhost:3307";
    $username = "";
    $password = "";
    $dbname = "cprhupd";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        // echo "Connected successfully";
        echo "<script>console.log('Connected to the database successfully');</script>";
    }
?>