<?php

require_once("../../database/database.php");

class sessionController extends BaseDatos
{
    public function updateSession($id_credentials, $user, $password, $id_record, $registration_date, $record_time)
    {
        try {    

            $query = "UPDATE tbl_credentials SET user='$user',password='$password',id_record='$id_record',registration_date='$registration_date',record_time='$record_time' WHERE id_credentials = $id_credentials";

            if ($this->consulta($query)) {
                header("Location: ...");
            }

        } catch (Exception $e) {
            echo ("Error: Ocurrio un error inesperado: " .$e->getMessage());
        }
    }

        public function mostrarDatos($id_credentials, $user, $password, $id_record, $registration_date, $record_time)
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
?>