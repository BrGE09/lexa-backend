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

$obj = new SessionController();

$row = $obj->mostrarDatos();

?>

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
        <input type="number" id="id_document" name="id_document" value="1000003" hidden>
    </div>

<div>
        <label for="documente_name">Nombre del documento</label>
        <input type="text" id="documente_name" name="documente_name" value="<?php echo $row->document_name ?>">
    </div>
    <div>
        <label for="route">Ruta</label>
        <input type="text" id="route" name="route" value="<?php echo $row->route ?>">
    </div>
    <div>
        <label for="file_size">Tamaño del archivo</label>
        <input type="text" id="file_size" name="file_size" value="<?php echo $row->file_size ?>">
    </div>

    <div>
        <label for="registration_date">registration_date</label>
        <input type="date" id="registration_date" name="registration_date" value="<?php echo $row->registration_date ?>">
    </div>
    <div>
        <label for="record_time">record_time</label>
        <input type="time" id="record_time" name="record_time" value="<?php echo $row->record_time ?>">
    </div>

    <div>
        <label for="id_record">id_record</label>
        <input type="number" id="id_record" name="id_record" value="<?php echo $row->id_record ?>">
    </div>
    <div>
        <label for="id_file">id_file</label>
        <input type="number" id="id_file" name="id_file" value="<?php echo $row->id_file ?>">
    </div>
    <input type="submit" class="btn btn-primary" value="Guardar datos">
</form>
</body>
</html>