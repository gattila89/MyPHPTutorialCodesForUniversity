<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

    <form action="usersInsert.php" method="post">
        <div class="form-group">
            <label>Nev</label>
            <input type="text" name="nev" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="tel" name="telefon" class="form-control">
        </div>
        <div class="form-group">
            <label>Cim</label>
            <input type="text" name="cim" class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>

</body>
</html>