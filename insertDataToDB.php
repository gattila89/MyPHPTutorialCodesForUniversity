<?php
    $servername = "localhost";
    $username = "root";
    $pw = "";

    //Check db connection
    try
    {
        $conn = new mysqli($servername, $username, $pw);
        echo 'adatbazishoz csatlakozas sikeres';
    }
    catch(Exception $e)
    {
        echo '<br>';
        echo 'adatbazishoz csatlakozas sikertelen';
        echo '<br>';
        echo $e->error_get_last;
    }

    $sql = "use iwyrwv_testdb";
    $conn->query($sql);

    //Check if tables exist
    $sql = "SELECT 1 FROM Vevok";
    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Vevok tabla letezik';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "SELECT 1 FROM Beszallitok";
    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Beszallitok tabla letezik';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "SELECT 1 FROM Szamlak";
    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Szamlak tabla letezik';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "SELECT 1 FROM Term_szolg";
    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Term_szolg tabla letezik';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "SELECT 1 FROM Rendelesek";
    try {
        $conn->query($sql);
        echo '<br>';
        echo 'Rendelesek tabla letezik';
    } catch (Excepreion $th) {
        echo $th->error_get_last;
    }

    $sql = "INSERT INTO Vevok (nev, email, telefon, cim) VALUES ('Attila','gattil@yahoo.com','123456','Kereszt utca 13')";
    $conn->query($sql);
    $sql = "INSERT INTO Vevok (nev, email, telefon, cim) VALUES ('Elemer','elemer@yahoo.com','123436','Sas utca 1')";
    $conn->query($sql);
    $sql = "INSERT INTO Vevok (nev, email, telefon, cim) VALUES ('Feri','feri123@yahoo.com','1234567','Jos utca 11')";
    $conn->query($sql);
    $sql = "INSERT INTO Vevok (nev, email, telefon, cim) VALUES ('Geza','gezalegjobb@yahoo.com','123256','Apati ter 5')";
    $conn->query($sql);
    $sql = "INSERT INTO Vevok (nev, email, telefon, cim) VALUES ('Joco','jocovagyok@yahoo.com','567894','Jozsef utca 13')";
    $conn->query($sql);

    echo '<br>';
    echo 'Vevok beillesztve';

    $sql = "INSERT INTO Beszallitok (nev, email, telefon, szekhely) VALUES ('Huncut Kft.','huncut@yahoo.com','123456','Huncut utca 13')";
    $conn->query($sql);
    $sql = "INSERT INTO Beszallitok (nev, email, telefon, szekhely) VALUES ('Jozsi es fiai','jozsi@yahoo.com','123436','Jozsi utca 1')";
    $conn->query($sql);
    $sql = "INSERT INTO Beszallitok (nev, email, telefon, szekhely) VALUES ('MekBela','mekbela@yahoo.com','1234567','MekBela utca 11')";
    $conn->query($sql);
    $sql = "INSERT INTO Beszallitok (nev, email, telefon, szekhely) VALUES ('Tejbepapi gmbh','tejbepapi@yahoo.com','123256','Tejbepapi ter 5')";
    $conn->query($sql);
    $sql = "INSERT INTO Beszallitok (nev, email, telefon, szekhely) VALUES ('Jozsef Szatmari','jocivagyok@yahoo.com','567894','Szatmari utca 13')";
    $conn->query($sql);
    
    echo '<br>';
    echo 'Beszallitok beillesztve';

    $sql = "INSERT INTO Term_szolg (nev, isSzolgaltatas, egysegar, BeszallitoID, mennyiseg) VALUES ('WC tisztito', FALSE, 50, 1, 100)";
    $conn->query($sql);
    $sql = "INSERT INTO Term_szolg (nev, isSzolgaltatas, egysegar, BeszallitoID, mennyiseg) VALUES ('Ablaktisztito', FALSE, 60, 1, 100)";
    $conn->query($sql);
    $sql = "INSERT INTO Term_szolg (nev, isSzolgaltatas, egysegar, BeszallitoID, mennyiseg) VALUES ('Bonyolult alkatresz', FALSE, 150, 2, 75)";
    $conn->query($sql);
    $sql = "INSERT INTO Term_szolg (nev, isSzolgaltatas, egysegar, BeszallitoID, mennyiseg) VALUES ('Dupla hamburger', FALSE, 87, 3, 10)";
    $conn->query($sql);
    $sql = "INSERT INTO Term_szolg (nev, isSzolgaltatas, egysegar, BeszallitoID, mennyiseg) VALUES ('Erotikus masszazs', TRUE, 500, 5, 0)";
    $conn->query($sql);
    
    
    echo '<br>';
    echo 'Term_szolg adatok beillesztve';

    $sql = "INSERT INTO Szamlak (VevoID, Datum) VALUES (1, '2018-08-11 13:30:00')";
    $conn->query($sql);
    $sql = "INSERT INTO Szamlak (VevoID, Datum) VALUES (1, '2019-08-11 13:30:00')";
    $conn->query($sql);

    echo '<br>';
    echo 'Szamlak beillesztve';

    $sql = "INSERT INTO Rendelesek (Term_szolgID, SzamlaID, Mennyiseg) VALUES (1, 1, 10)";
    $conn->query($sql);
    $sql = "INSERT INTO Rendelesek (Term_szolgID, SzamlaID, Mennyiseg) VALUES (2, 1, 10)";
    $conn->query($sql);
    $sql = "INSERT INTO Rendelesek (Term_szolgID, SzamlaID, Mennyiseg) VALUES (4, 2, 1)";
    $conn->query($sql);
    $sql = "INSERT INTO Rendelesek (Term_szolgID, SzamlaID, Mennyiseg) VALUES (5, 2, 1)";
    $conn->query($sql);

    $conn->close();
    
    echo '<br>';
    echo 'Rendelesek beillesztve';

    echo '<br>';
    echo '<a href="index.html">Vissza</a>';
?>