<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");

    $sql_query = "SELECT `term_szolg`.*, `beszallitok`.`nev` AS `BeszallitoNev` FROM `term_szolg` ";
    $sql_query .= "LEFT JOIN `beszallitok` ON `term_szolg`.`BeszallitoID` = `beszallitok`.`BeszallitoID`";

    $result_set=$conn->query($sql_query);

    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM term_szolg WHERE term_szolgID=".$_GET['delete_id'];
        try 
        {
            mysqli_query($conn, $sql_query);
            header("Location: artikelsList.php");
        } 
        catch(Exception)
        {
            echo "Törles nem sikerül, mert a vevöre masik tablaban hivatkozas van";
            echo "<br><a href='artikelsList.php'>Vissza</a>";
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript">
    
    function delete_id(id)
    {
        if(confirm('Biztosan törölni akarod a vevöt?'))
        {
            window.location.href='artikelsList.php?delete_id='+id;
        }
    }

    </script>

</head>
<body>
    <table class="table">
    <tr>
        <th>Azonosito</th>
        <th>Termek neve</th>
        <th>Szolgaltatas?</th>
        <th>Egysegar</th>
        <th>Beszallito neve</th>
        <th>Rendelkezesre allo Mennyiseg</th>
        <th colspan="2">Müveletek</th>
    </tr>

    <?php
    if(mysqli_num_rows($result_set)>0)
    {
        while($row=mysqli_fetch_row($result_set))
        {
            ?>

            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><a href='suppliersList.php'><?php echo $row[6]; ?></td>
                <td><?php echo $row[5]; ?></a></td>
                <td><a href="artikelsEdit.php?id=<?php echo $row[0];?>">Szerkeszt</a></td>
                <td><a href="javascript:delete_id(<?php echo $row[0]; ?>)">Töröl</a></td>
            </tr>

            <?php
        }
    }
    else
    {
        ?>

        <tr>
        <th colspan="4">Nem talalhato Vevö az adatbazisban</th>
        </tr>

        <?php
    }
        ?>
    </table>

    <br>
    <a href="artikelsAdd.php" class="btn btn-primary">Uj Termek/Szolgaltatas hozzaadasa</a>

    <br>
    <br>
    <a href="index.html" class="btn btn-primary">Vissza</a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>