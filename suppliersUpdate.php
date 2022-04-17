<?php

$id = $_POST["id"];
$nev = $_POST["nev"];
$email = $_POST["email"];
$telefon = $_POST["telefon"];
$cim = $_POST["szekhely"];

$conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");

if ($conn->connect_error){
	die("Hiba a kapcsolatban: ". $conn->connect_error);
}

$sql = "UPDATE Beszallitok SET nev='$nev', email='$email', telefon='$telefon', szekhely='$cim' WHERE BeszallitoID='$id'";

if ($conn->query($sql) === TRUE) 
{
	header("Location: suppliersList.php");
} 
else 
{
	echo "Hiba: ".$sql."<br>".$conn->error;
}

$conn->close();

?>