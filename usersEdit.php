<?php
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql = "SELECT * FROM Vevok WHERE VevoID='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();
        
        $nev = $row["nev"];
        $email = $row["email"];
        $telefon = $row["telefon"];
        $cim = $row["cim"];
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

    <form action="usersUpdate.php" method="post">
        <input type='hidden' name='id' value='<?php echo $id?>'>
        <div class="form-group">
            <label>Nev</label>
            <input type="text" name="nev" value='<?php echo $nev?>' class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value='<?php echo $email?>' class="form-control">
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="tel" name="telefon" value='<?php echo $telefon?>' class="form-control">
        </div>
        <div class="form-group">
            <label>Cim</label>
            <input type="text" name="cim" value='<?php echo $cim?>' class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Mentes">
    </form>

</body>
</html>