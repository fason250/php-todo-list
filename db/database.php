<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "project1";

    try{
        $db = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
        echo "<script> console.log('connected to database successfully!!') </script>";
    }catch(Exception){
        echo "Failed to connect with database";
    }