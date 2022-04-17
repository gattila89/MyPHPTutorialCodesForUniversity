<?php

$id = $_POST["id"];
$nev = $_POST["nev"];
$egysegar = $_POST["egysegar"];
$mennyiseg = $_POST["mennyiseg"];
$beszallitoID = $_POST["beszallito"];

if(isset($_POST['isSzolgaltatas']) && $_POST['isSzolgaltatas'] == '1') 
{
    $isSzolgaltatas = TRUE;
}
else
{
    $isSzolgaltatas = FALSE;
}	

$conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");

if ($conn->connect_error){
	die("Hiba a kapcsolatban: ". $conn->connect_error);
}

$sql = "UPDATE term_szolg SET nev='$nev', isSzolgaltatas='$isSzolgaltatas', egysegar='$egysegar', mennyiseg='$mennyiseg', beszallitoID='$beszallitoID' WHERE term_szolgID='$id'";

if ($conn->query($sql) === TRUE) 
{
	header("Location: artikelsList.php");
} 
else 
{
	echo "Hiba: ".$sql."<br>".$conn->error;
}

$conn->close();

?>