<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="app/models/document.model.php" method="POST">
    <div>
    <label for="name">dname</label>
        <input type="text" id="dname" name="dname">
    </div>
    <div>
    <label for="apM">rout</label>
        <input type="text" id="rout" name="rout">
    </div>
    <div>
    <label for="apP">flSize</label>
        <input type="text" id="flSize" name="flSize">
    </div>
    <div>
    <label for="name">reg_date</label>
        <input type="text" id="reg_date" name="reg_date">
    </div>
    <div>
    <label for="name">rd_time</label>
        <input type="text" id="rd_time" name="rd_time">
    </div>

    <div>
    <label for="name">idRd</label>
        <input type="text" id="idRd" name="idRd">
    </div>
    <div>
    <label for="name">idFl</label>
        <input type="text" id="idFl" name="idFl">
    </div>
    
    <input type="submit" class="btn btn-primary" value="guardar datos"></input>
    </form>
</body>
</html>
