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
    echo '<br>';
    echo '<a href="index.php">Vissza</a>';
?>