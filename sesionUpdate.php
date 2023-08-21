
<?php

require_once("database/database.php");

class SessionController extends BaseDatos
{
    public function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM tbl_credentials";
            $response = $this->consulta($sql);
            return $response->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }

    }
}


$sessionController = new SessionController();
$datos = $sessionController->mostrarDatos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>record</th>
            
        </tr>
        <?php foreach ($datos as $row) { ?>
        <tr>
            <td><?php echo $row['id_credentials']; ?></td>
            <td><?php echo $row['user']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['id_record']; ?></td>
            <th><a href="sesion.php?id_credentials=<?php echo $row['id_credentials']; ?>" class="btn btn-success">actualizar</a></th>

        </tr>
    <?php } ?>
    </table>

</body>
</html>