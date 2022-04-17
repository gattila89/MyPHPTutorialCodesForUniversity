<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    
    $sql = "SELECT * FROM Vevok";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        echo "<table><tr><th>Azonosito</th><th>Vevo neve</th><th>Email</th><th>Telefon</th><th>Cim</th><th colspan='2'>Muveletek</th></tr>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr>
                    <td>".$row["VevoID"]."</td>
                    <td>".$row["nev"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["telefon"]."</td>
                    <td>".$row["cim"]."</td>
                    <td><a href='usersEdit.php'>Szerkeszt</a></td>
                    <td><a href='usersDelete.php'>Töröl</a></td>
                </tr>";
        }
        echo "</table>";
    }
    else {
        echo "Nem talalhato Vevo az adatbazisban";
    }

    echo '<a href="usersAdd.php">Uj vevo hozzaadasa</a>';

    $conn->close();
    echo '<br>';
    echo '<a href="index.html">Vissza</a>';
?>