<?php
if(isset($_POST['submit'])){
    $output = NULL;

    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");

    $termek = $_POST['termek'];
    $mennyiseg = $_POST['mennyiseg'];
    $vevo = $_POST['vevo'];

    $query = "INSERT INTO `szamlak`(`VevoID`, `Datum`) VALUES ($vevo, NOW())";
    $insert_szamla = $conn->query($query);
    if(!$insert_szamla)
    {
        echo $conn->error;
    }
    else {
        $output .= "insert szamla success";
    }

    $query2 = "SELECT SzamlaID FROM szamlak ORDER BY SzamlaID DESC LIMIT 1";
    $result_set=$conn->query($query2);
    $row = $result_set->fetch_assoc();

    $szid = $row['SzamlaID'];
    $counter = 0;
    foreach($termek AS $key => $value)
    {
        $query4 = "SELECT * FROM term_szolg WHERE Term_SzolgID = $value";
        $result_q4 = $conn->query($query4);
        $row_q4 = $result_q4->fetch_assoc();

        $isSzolgaltatas = $row_q4['isSzolgaltatas'];
        $tnev = $row_q4['nev'];
        
        if(!$isSzolgaltatas)
        {
            $osszesMennyiOld = $row_q4['mennyiseg'];
            $megvettMenny = $conn->real_escape_string($mennyiseg[$key]);
            if($megvettMenny > $osszesMennyiOld)
            {
                echo '<script language="javascript">alert("A '. $tnev . ' - nevü termekbol nincs eleg, ezert nem lesz megrendelve.");</script>';
            }
            else
            {
                $ujmenny = $osszesMennyiOld - $megvettMenny;
                $query5 = "UPDATE term_szolg SET mennyiseg = $ujmenny WHERE term_szolgID = $value";
                $result_q5 = $conn->query($query5);

                $query3 = "INSERT INTO `rendelesek`(`Term_szolgID`, `SzamlaID`, `Mennyiseg`) 
                VALUES ($value,$szid,'" . $conn->real_escape_string($mennyiseg[$key]) . "')";
                $insert = $conn->query($query3);
                $counter++;
            }
            
        }
        else 
        {
            $query3 = "INSERT INTO `rendelesek`(`Term_szolgID`, `SzamlaID`, `Mennyiseg`) 
            VALUES ($value,$szid,'" . $conn->real_escape_string($mennyiseg[$key]) . "')";
            $insert = $conn->query($query3);
            $counter++;
        }
    }

    $conn->close();

    if($counter > 0)
    {
        header("Location: billDetails.php?id=$szid");
        exit();    
    }
    else {
        $query6 = "DELETE * FROM szamlak WHERE szamlaID = $szid";
        echo '<script language="javascript">alert("A rendeles nem sikerült, mert nincs termek a szamlaban. A szamla törlesre került.");</script>';
    }
}
?>


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(e){
            var html = '<p /><div id="termekContainer" class="container"><div class="row"><div><select name="termek[]" id="childtermek"><?php $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");$sql_query = "SELECT * FROM `term_szolg` ";$result_set=$conn->query($sql_query);if(mysqli_num_rows($result_set)>0){while($row=mysqli_fetch_row($result_set)){echo "<option value=".$row[0].">".$row[1]."</option>";}}mysqli_close($conn);?></select></div><div><label>Termek Mennyiseg</label><input type="number" id="childmennyiseg" name="mennyiseg[]" class="form-control"></div><a href="#" id="remove" class="btn btn-primary">x</a></div></div>';
            $("#add").click(function(e){
                $("#termekContainer").append(html);
            });
            $("#termekContainer").on('click', '#remove',function(e){
                $(this).parent('div').remove();
            });
            $("#termekContainer").on('dblclick','#childtermek', function(e){
                $(this).val($('#termek').val());
            });
            $("#termekContainer").on('dblclick','#childmennyiseg', function(e){
                $(this).val($('#mennyiseg').val());
            });
        });
    </script>

</head>
<body>

    <form method="POST">
        <div class="form-group">
            <label>Vevö</label>
            <select name="vevo" id="vevo">
                <?php
                    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
                    $sql_query = "SELECT * FROM `vevok` ";
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

            <div id="termekContainer" class="container">
                <div class="row">
                    <div class="col">
                    <label>Termek</label>
                    <select name="termek[]" id="termek">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "iwyrwv_testdb");
                    $sql_query = "SELECT * FROM `term_szolg` ";
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

                    <div class="col">
                    <label>Termek Mennyiseg</label>
                    <input type="number" id="mennyiseg" name="mennyiseg[]" min="1">
                    </div>
                    <div class="col">
                    <label></label>
                    <a href="#" id="add" class="btn btn-primary">+</a>
                    </div>
                </div>
            </div>
            
        </div>
        <input type="SUBMIT" class="btn btn-primary" name="submit">
        <a href="index.html" class="btn btn-primary">Vissza</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>