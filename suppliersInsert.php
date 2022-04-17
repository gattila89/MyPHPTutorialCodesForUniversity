<?php
$conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
if(isset($_POST['submit']))
{    
     $name = $_POST['nev'];
     $email = $_POST['email'];
     $telefon = $_POST['telefon'];
     $cim = $_POST['szekhely'];
     $sql = "INSERT INTO Beszallitok (nev,email,telefon,szekhely) VALUES ('$name','$email','$telefon','$cim')";
     if (mysqli_query($conn, $sql)) 
     {
      header("Location: suppliersList.php");
     } 
     else 
     {
        echo "Hiba: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>