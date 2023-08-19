<?php

class BaseDatos
{

    private $mysqli;

    public function __construct()
    {
        $servidor = "localhost";
        $usuario = "root";
        $pass = "";
        $database = "Lexa";

        try {
            $this->mysqli = new mysqli($servidor, $usuario, $pass, $database);

            if (mysqli_connect_errno()) {
                printf("La conexión falló");
            }
        } catch (Exception $e) {
            printf("Error al obtener la información, verifique los datos de conexión");
        }
    }

    public function consulta($query)
    {
        return $this->mysqli->query($query);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}
