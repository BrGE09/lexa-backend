<?php
require_once("./database/database.php");

class RecordsController extends BaseDatos
{

    public function createRecord($nombre, $apM, $apP, $fNacimiento, $calle, $noExt, $noInt, $colonia, $ciudad, $estado, $cp, $curp, $rfc, $correo, $nombreCta, $idBanco, $clabe, $fechaRegtro, $hrRegistro, $horaAct)
    {

        try {

            $query = "INSERT INTO tbl_records (name, last_name, mother_last_name, birth_date, street, outdoor_number, number, cologne, city, state, cp, curp, rfc, lada_number, telephone_number, email, name_holder_cb, id_banks, account_clabe_cb, registration_date, record_time, record_update)
            VALUES ('$nombre', '$apM', '$apP', '$fNacimiento', '$calle', '$noExt', '$noInt', '$colonia', '$ciudad', '$estado', '$cp', '$curp', '$rfc', '$correo', '$nombreCta', '$idBanco', '$clabe', '$fechaRegtro', '$hrRegistro', '$horaAct');";

            if ($this->consulta($query)) {
                header("Location: /Lexa-Backend/index.php?=Datos guardadosß");
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function viewRecord($id)
    {

        try {
            $query = "SELECT * FROM tbl_records WHERE id_record = $id;";

            $response = $this->consulta($query);

            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function verificaciones($id, $lada, $numero){
        try {
            $query = "UPDATE tbl_records SET lada_number = $lada, telephone_number = $numero WHERE id_record = $id;";
            $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function updateRecord()
    {
        try {
            //code...
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function deleteRecord($id)
    {

        try {
            $query = "DELETE FROM tbl_records WHERE id_record = $id;";
            $response = $this->consulta($query);
        } catch (\Throwable $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }
}
