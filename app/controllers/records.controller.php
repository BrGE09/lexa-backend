<?php
require_once("../../database/database.php");

class RecordsController extends BaseDatos
{

    public function createRecord($nombre, $apM, $apP, $fNacimiento, $calle, $noExt, $noInt, $colonia, $ciudad, $estado, $cp, $curp, $rfc, $lada, $noTlf, $correo, $nombreCuenta, $idBanco, $clabe, $fechaRegistro, $horaRegistro, $horaActualizacion, $estadoSocio, $rol)
    {

        try {

            $query = "INSERT INTO tbl_records (name, last_name, mother_last_name, birth_date, street, outdoor_number, number, cologne, city, state, cp, curp, rfc, lada_number, telephone_number, email, name_holder_cb, id_banks, account_clabe_cb, id_status_signature, digital_signature, document_path, registration_date, record_time, record_update, id_status_record, id_rol)
            VALUES ('$nombre', '$apM', '$apP', '$fNacimiento', '$calle', '$noExt', '$noInt', '$colonia', '$ciudad', '$estado', '$cp', '$curp', '$rfc', '$lada', '$noTlf', '$correo', '$nombreCuenta', '$idBanco', '$clabe', '$fechaRegistro', '$horaRegistro', '$horaActualizacion', '$estadoSocio', '$rol');";

            if ($this->consulta($query)) {
                header("Location: ...");
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
