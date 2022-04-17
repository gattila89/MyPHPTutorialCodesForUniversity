<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    
    $sql = "SELECT * FROM `beszallitok`";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        echo "<table><tr>
                <th>Azonosito</th>
                <th>Beszallito neve</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Szekhely neve</th>
            </tr>";

        while($row = $result->fetch_assoc())
        {
            echo "<tr>
                <td>".$row["BeszallitoID"]."</td>
                <td>".$row["nev"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["telefon"]."</td>
                <td>".$row["szekhely"]."</td>
                </tr>";
        }
        echo "</table>";
    }
    else {
        echo "Nem talalhato Termek az adatbazisban";
    }

    $conn->close();
    echo '<br>';
    echo '<a href="index.html">Vissza</a>';
?>