<?php

require_once './database/database.php';

class CredentialsController extends BaseDatos
{

    public function createCredential($nombre, $pass, $idR, $fechaRegistro, $horaRegistro){

        try {

            $query = "INSERT INTO tbl_credentials (user, password, id_record, registration_date, record_time) VALUES ('$nombre', '$pass', '$idR', '$fechaRegistro', '$horaRegistro')";

            if ($this->consulta($query)) {
                header("Location: ...");
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function viewCredentials($id)
    {

        try {
            $query = "SELECT * FROM tbl_credentials WHERE id_credential = $id;";

            $response = $this->consulta($query);

            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function updateCredential()
    {
        try {
            //code...
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function deleteCredential($id)
    {

        try {
            $query = "DELETE FROM tbl_credentials WHERE id_record = $id;";
            $response = $this->consulta($query);
        } catch (\Throwable $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }
}
