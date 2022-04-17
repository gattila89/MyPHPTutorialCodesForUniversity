<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>