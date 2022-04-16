<?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    try
    {
        $conn = new mysqli($servername, $username, $pw);
        echo 'adatbazis ok';
    }
    catch(Exception $e)
    {
        echo 'adatbazis nem ok';
        echo '<br>';
        echo $e->error_get_last;
    }

    $sql = "CREATE DATABASE IF NOT EXISTS iwyrwv_testdb";
    $conn->query($sql);
    echo '<br>';
    echo 'Adatbazis letrehozva';


    echo '<br>';
    echo '<a href="index.html">Vissza</a>';
?>