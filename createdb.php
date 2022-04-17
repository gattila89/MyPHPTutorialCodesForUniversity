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
        echo '<br>';
        echo 'adatbazis nem ok';
        echo '<br>';
        echo $e->error_get_last;
    }

    $sql = "CREATE DATABASE IF NOT EXISTS iwyrwv_testdb";
    $conn->query($sql);
    echo '<br>';
    echo 'Adatbazis letrehozva';

    $sql = "use iwyrwv_testdb";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS Vevok(";
    $sql .= "VevoID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "nev VARCHAR(50),";
    $sql .= "email VARCHAR(50),";
    $sql .= "telefon VARCHAR(50),";
    $sql .= "cim VARCHAR(50))";

    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Vevok tabla letrehozva';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "CREATE TABLE IF NOT EXISTS Beszallitok(";
    $sql .= "BeszallitoID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "nev VARCHAR(50),";
    $sql .= "email VARCHAR(50),";
    $sql .= "telefon VARCHAR(50),";
    $sql .= "szekhely VARCHAR(50))";

    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Beszallitok tabla letrehozva';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "CREATE TABLE IF NOT EXISTS Term_szolg(";
    $sql .= "Term_szolgID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "nev VARCHAR(50),";
    $sql .= "isSzolgaltatas BOOLEAN,";
    $sql .= "egysegar INT,";
    $sql .= "BeszallitoID INT UNSIGNED,";
    $sql .= "mennyiseg INT,";
    $sql .= "FOREIGN KEY (BeszallitoID) REFERENCES Beszallitok(BeszallitoID))";

    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Term_szolg tabla letrehozva';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "CREATE TABLE IF NOT EXISTS Szamlak(";
    $sql .= "SzamlaID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "VevoID INT UNSIGNED,";
    $sql .= "Datum TIMESTAMP,";
    $sql .= "FOREIGN KEY (VevoID) REFERENCES Vevok(VevoID))";

    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Szamlak tabla letrehozva';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "CREATE TABLE IF NOT EXISTS Rendelesek(";
    $sql .= "RendelesekID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "Term_szolgID INT UNSIGNED,";
    $sql .= "SzamlaID INT UNSIGNED,";
    $sql .= "Mennyiseg INT,";
    $sql .= "FOREIGN KEY (Term_szolgID) REFERENCES Term_szolg(Term_szolgID),";
    $sql .= "FOREIGN KEY (SzamlaID) REFERENCES Szamlak(SzamlaID))";

    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Rendelesek tabla letrehozva';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }


    echo '<br>';
    echo '<a href="index.html">Vissza</a>';
?>