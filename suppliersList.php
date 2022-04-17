<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql_query="SELECT * FROM Beszallitok";
    $result_set=$conn->query($sql_query);
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM Beszallitok WHERE BeszallitoID=".$_GET['delete_id'];
        try 
        {
            mysqli_query($conn, $sql_query);
            header("Location: suppliersList.php");
        } 
        catch(Exception)
        {
            echo "Törles nem sikerül, mert a Beszallitora masik tablaban hivatkozas van";
            echo "<br><a href='suppliersList.php'>Vissza</a>";
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <script type="text/javascript">
    
    function delete_id(id)
    {
        if(confirm('Biztosan törölni akarod a Beszallitot?'))
        {
            window.location.href='suppliersList.php?delete_id='+id;
        }
    }

    </script>

</head>
<body>
    <table>
    <tr>
        <th>Azonosito</th>
        <th>Nev</th>
        <th>Email</th>
        <th>Telefon</th>
        <th>Szekhely</th>
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
                <td><?php echo $row[4]; ?></td>
                <td><a href="suppliersEdit.php?id=<?php echo $row[0];?>">Szerkeszt</a></td>
                <td><a href="javascript:delete_id(<?php echo $row[0]; ?>)">Töröl</a></td>
            </tr>

            <?php
        }
    }
    else
    {
        ?>

        <tr>
        <th colspan="4">Nem talalhato Beszallito az adatbazisban</th>
        </tr>

        <?php
    }
        ?>
    </table>

    <br>
    <a href="suppliersAdd.php">Uj Beszallito hozzaadasa</a>

</body>
</html>