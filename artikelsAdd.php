<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

    <form action="artikelsInsert.php" method="post">
        <div class="form-group">
            <label>Nev</label>
            <input type="text" name="nev" class="form-control">
        </div>
        <div class="form-group">
            <label>Szolgaltatas?</label>
            <input type="checkbox" name="isSzolgaltatas" class="form-control" value='1'>
        </div>
        <div class="form-group">
            <label>Egysegar</label>
            <input type="number" name="egysegar" class="form-control">
        </div>
        <div class="form-group">
            <label>Mennyiseg</label>
            <input type="number" name="mennyiseg" class="form-control">
        </div>
        <div class="form-group">
            <label>Beszallito</label>
            <select name="beszallito">
                <?php
                    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
                    $sql_query = "SELECT * FROM `beszallitok` ";
                    $result_set=$conn->query($sql_query);

                    if(mysqli_num_rows($result_set)>0)
                    {
                        while($row=mysqli_fetch_row($result_set))
                        {
                            echo "<option value=".$row[0].">".$row[1]."</option>";
                        }
                    }
                    mysqli_close($conn);
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Hozzaad">
    </form>

</body>
</html>