<?php
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
    $sql_query="
    SELECT s.SzamlaID, v.VevoID, v.nev, s.Datum, SUM((t.egysegar*r.Mennyiseg)) AS Összeg FROM szamlak s 
    INNER JOIN rendelesek r ON s.SzamlaID = r.SzamlaID
    INNER JOIN term_szolg t ON t.Term_szolgID = r.Term_szolgID
    INNER JOIN vevok v ON v.VevoID = s.VevoID
    WHERE s.SzamlaID='$id'
    GROUP BY s.SzamlaID";
    $result_set=$conn->query($sql_query);

    if ($result_set->num_rows > 0){

        $row = $result_set->fetch_assoc();
        
        $vid = $row["VevoID"];
        $szid = $row["SzamlaID"];
        $nev = $row["nev"];
        $datum = $row["Datum"];
        $vegosszeg = $row["Összeg"];

        $sql_query="
        SELECT r.RendelesekID, t.nev, b.nev, t.isSzolgaltatas, t.egysegar, r.mennyiseg, (t.egysegar*r.Mennyiseg) AS Reszösszeg FROM rendelesek r 
        INNER JOIN term_szolg t ON t.Term_szolgID = r.Term_szolgID
        INNER JOIN beszallitok b ON b.BeszallitoID = t.BeszallitoID
        WHERE r.SzamlaID=$szid";
        $result_set2=$conn->query($sql_query);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
        <h5>Szamla ID: <?php echo $szid; ?></h5>
        <h5>Vevo nev: <?php echo $nev; ?></h5>
        <h5>Datum: <?php echo $datum; ?></h5>
        <h5>Vegösszeg: <?php echo $vegosszeg; ?></h5>
    
    <br>

    <table class="table">
    <tr>
        <th>Rendeles Tetel Azonosito</th>
        <th>Termek neve</th>
        <th>Beszallito neve</th>
        <th>Szolgaltatas?</th>
        <th>Egysegar</th>
        <th>Mennyiseg</th>
        <th>Reszösszeg</th>
    </tr>

    <?php
    if($result_set->num_rows > 0 && mysqli_num_rows($result_set2)>0)
    {
        while($row=mysqli_fetch_row($result_set2))
        {
            ?>

            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php if($row[3] == 1) {echo "Igen";} else {echo "Nem";} ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
            </tr>

            <?php
        }
    }
    else
    {
        ?>

        <tr>
        <th colspan="4">Nem talalhato Tetel a szamlaban</th>
        </tr>

        <?php
    }
        ?>
    </table>
    
    <a href="billsUserList.php?id=<?php echo $vid;?>" class="btn btn-primary">Vissza</a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>