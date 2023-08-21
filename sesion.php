
<?php

require_once("database/database.php");

class SessionController extends BaseDatos
{
    public function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM tbl_document";
            $response = $this->consulta($sql);
            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }

    }
}

$obj = new DocumentController();
$response = $obj->mostrarDatos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="app/models/session.model.php" method="POST">

    <div>
        <input type="number" id="id_credentials" name="id_credentials" value="1000000" hidden>
    </div>

    <div>
        <label for="user">user</label>
        <input type="text" id="user" name="user" value="<?php echo $row->user ?>">
    </div>
    <div>
        <label for="password">password</label>
        <input type="text" id="password" name="password" value="<?php echo $row->password ?>">
    </div>
    <div>
        <label for="id_record">id_record</label>
        <input type="text" id="id_record" name="id_record" value="<?php echo $row->id_record ?>">
    </div>

    <div>
        <label for="registration_date">registration_date</label>
        <input type="date" id="registration_date" name="registration_date" value="<?php echo $row->registration_date ?>">
    </div>
    <div>
        <label for="record_time">record_time</label>
        <input type="time" id="record_time" name="record_time" value="<?php echo $row->record_time ?>">
    </div>
    <input type="submit" class="btn btn-primary" value="Guardar datos">
</form>
</body>
</html>
