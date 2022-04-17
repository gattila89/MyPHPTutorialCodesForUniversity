<?php
$conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
if(isset($_POST['submit']))
{    
     $name = $_POST['nev'];
     $egysegar = $_POST['egysegar'];
     $mennyiseg = $_POST['mennyiseg'];
     $beszallitoID = $_POST['beszallito'];

     if(isset($_POST['isSzolgaltatas']) && $_POST['isSzolgaltatas'] == '1') 
     {
         $isSzolgaltatas = TRUE;
     }
     else
     {
         $isSzolgaltatas = FALSE;
     }	


     $sql = "INSERT INTO term_szolg (nev,isSzolgaltatas,egysegar,beszallitoID,mennyiseg) 
            VALUES ('$name','$isSzolgaltatas','$egysegar','$beszallitoID','$mennyiseg')";
     if (mysqli_query($conn, $sql)) 
     {
      header("Location: artikelsList.php");
     } 
     else 
     {
        echo "Hiba: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>