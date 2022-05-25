<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql_query="SELECT r.RendelesekID, r.SzamlaID, t.nev, r.Mennyiseg FROM `rendelesek` r INNER JOIN term_szolg t ON r.Term_szolgID=t.Term_szolgID";
    $result_set=$conn->query($sql_query);
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM Rendelesek WHERE RendelesekID=".$_GET['delete_id'];
        try 
        {
            mysqli_query($conn, $sql_query);
            header("Location: incomesList.php");
        } 
        catch(Exception)
        {
            echo "Törles nem sikerül, mert a bevetelre masik tablaban hivatkozas van";
            echo "<br><a href='incomesList.php'>Vissza</a>";
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
        if(confirm('Biztosan törölni akarod a rendelest?'))
        {
            window.location.href='incomesList.php?delete_id='+id;
        }
    }

    </script>

</head>
<body>
    <table class="table">
    <tr>
        <th>Azonosito</th>
        <th>Szamla ID</th>
        <th>Termek neve</th>
        <th>Mennyiseg</th>
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
            </tr>

            <?php
        }
    }
    else
    {
        ?>

        <tr>
        <th colspan="4">Nem talalhato Rendeles az adatbazisban</th>
        </tr>

        <?php
    }
        ?>
    </table>

    <br>
    <!-- <a href="incomesAdd.php" class="btn btn-primary">Uj Rendeles tetel hozzaadasa</a> -->
    <a href="index.html" class="btn btn-primary">Vissza</a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>