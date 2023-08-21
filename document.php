<?php

require_once("database/database.php");

class DocumentController extends BaseDatos
{
    public function mostrarDatos()
    {
        try {
            $query = "SELECT * FROM tbl_document";
            return$this -> consulta($query);
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
<form action="app/models/document.model.php" method="POST">
    <div>
        <label for="documente_name">Nombre del documento</label>
        <input type="text" id="documente_name" name="documente_name">
    </div>
    <div>
        <label for="route">Ruta</label>
        <input type="text" id="route" name="route">
    </div>
    <div>
        <label for="file_size">Tamaño del archivo</label>
        <input type="text" id="file_size" name="file_size">
    </div>

    <div>
        <label for="registration_date">registration_date</label>
        <input type="date" id="registration_date" name="registration_date">
    </div>
    <div>
        <label for="record_time">record_time</label>
        <input type="time" id="record_time" name="record_time">
    </div>

    <div>
        <label for="id_record">id_record</label>
        <input type="number" id="id_record" name="id_record">
    </div>
    <div>
        <label for="id_file">id_file</label>
        <input type="number" id="id_file" name="id_file">
    </div>
    <input type="submit" class="btn btn-primary" value="Guardar datos">
</form>

<table>
        <tr>
            <th>ID</th>
            <th>document_name</th>
            <th>route</th>
            <th>file_size</th>
            
        </tr>
        <?php while ($row = $response->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id_document'] ?></td>
            <td><?= $row['document_name'] ?></td>
            <td><?= $row['route'] ?></td>
            <td><?= $row['file_size'] ?></td>
            <th><a href="documentupdate.php?id_document=<?php echo $row['id_document']; ?>" class="btn btn-success">actualizar</a></th>

        </tr>
    <?php } ?>
    </table>

</body>
</html>
