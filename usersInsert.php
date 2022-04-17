<?php
$conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
if(isset($_POST['submit']))
{    
     $name = $_POST['nev'];
     $email = $_POST['email'];
     $telefon = $_POST['telefon'];
     $cim = $_POST['cim'];
     $sql = "INSERT INTO Vevok (nev,email,telefon,cim) VALUES ('$name','$email','$telefon','$cim')";
     if (mysqli_query($conn, $sql)) 
     {
        echo "Uj vevö sikeresen hozzaadva";
     } 
     else 
     {
        echo "Hiba: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>