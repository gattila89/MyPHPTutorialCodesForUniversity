<?php
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql = "SELECT * FROM Beszallitok WHERE BeszallitoID='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();
        
        $nev = $row["nev"];
        $email = $row["email"];
        $telefon = $row["telefon"];
        $cim = $row["szekhely"];
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <form action="suppliersUpdate.php" method="post">
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
            <input type="text" name="szekhely" value='<?php echo $cim?>' class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Mentes">
        <a href="suppliersList.php" class="btn btn-primary">Vissza</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>