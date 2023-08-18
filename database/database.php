<?php

class BaseDatos{

    private $mysqli;

    public function __construct(){

        $servidor = "localhost";
        $usuario = "root";
        $pass = "";
        $database = "Lexa";

        $this->mysqli = new mysqli($servidor, $usuario, $pass, $database);

        if(mysqli_connect_errno()){
            printf("La conexión falló");
        }
    }

    public function consulta($query){
        return $this->mysqli->query($query);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }



}
?>