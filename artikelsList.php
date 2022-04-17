<?php
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    
    $sql = "SELECT `term_szolg`.*, `beszallitok`.`nev` AS `BeszallitoNev` FROM `term_szolg` ";
    $sql .= "LEFT JOIN `beszallitok` ON `term_szolg`.`BeszallitoID` = `beszallitok`.`BeszallitoID`";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        echo "<table><tr>
                <th>Azonosito</th>
                <th>Termek neve</th>
                <th>Szolgaltatas?</th>
                <th>Egysegar</th>
                <th>Beszallito neve</th>
                <th>Rendelkezesre allo Mennyiseg</th>
            </tr>";

        while($row = $result->fetch_assoc())
        {
            echo "<tr>
                <td>".$row["Term_szolgID"]."</td>
                <td>".$row["nev"]."</td>
                <td>".$row["isSzolgaltatas"]."</td>
                <td>".$row["egysegar"]."</td>
                <td><a href='suppliersList.php'>".$row["BeszallitoNev"]."</a></td>
                <td>".$row["mennyiseg"]."</td>
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