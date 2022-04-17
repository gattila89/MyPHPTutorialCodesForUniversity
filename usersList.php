<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql_query="SELECT * FROM Vevok";
    $result_set=$conn->query($sql_query);
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM Vevok WHERE VevoID=".$_GET['delete_id'];
        try 
        {
            mysqli_query($conn, $sql_query);
            header("Location: usersList.php");
        } 
        catch(Exception)
        {
            echo "Törles nem sikerül, mert a vevöre masik tablaban hivatkozas van";
            echo "<br><a href='usersList.php'>Vissza</a>";
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
        if(confirm('Biztosan törölni akarod a vevöt?'))
        {
            window.location.href='usersList.php?delete_id='+id;
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
        <th>Cim</th>
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
                <td><a href="usersEdit.php?id=<?php echo $row[0];?>">Szerkeszt</a></td>
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
    <a href="usersAdd.php">Uj Vevo hozzaadasa</a>

</body>
</html>