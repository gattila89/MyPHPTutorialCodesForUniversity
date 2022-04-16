<?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $conn = new mysqli($servername, $username, $pw);
    if($conn)
    {
        echo 'adatbazis ok';
    }
    else
    {
        echo 'adatbazis nem ok';
    }
    echo '<br>';
    echo '<a href="index.php">Vissza</a>';
?>