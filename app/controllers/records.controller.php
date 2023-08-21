<?php
require_once './database/database.php';

class RecordsController extends BaseDatos
{

    public function createRecord($nombre, $apM, $apP, $fNacimiento, $correo)
    {

        try {

            $query = "INSERT INTO tbl_records (name, last_name, mother_last_name, birth_date, email)
            VALUES ('$nombre', '$apM', '$apP', '$fNacimiento', '$correo');";

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

    public function address($id, $calle, $noExt, $noInt, $colonia, $ciudad, $estado, $cp, $curp, $rfc)
    {
        try {
            $query = "UPDATE tbl_records SET street = '$calle', outdoor_number = '$noExt', number = '$noInt', cologne = '$colonia', city = '$ciudad', state = '$estado', cp = '$cp', curp =  '$curp', rfc = '$rfc' WHERE id_record = $id;";
            $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function phone($id, $lada, $phone)
    {
        try {
            $query = "UPDATE tbl_records SET lada_number = '$lada', telephone_number = '$phone' WHERE id_record = $id;";
            $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function bank($id, $nombreCta, $idBank, $clabe, $fechaRgtro, $hrRegistro, $hrAct)
    {
        try {
            $query = "UPDATE tbl_records SET name_holder_cb = '$nombreCta', id_bank = '$idBank', account_clabe_cb = '$clabe', registration_date = '$fechaRgtro', record_time = '$hrRegistro', record_update = '$hrAct' WHERE id_record = $id;";
            $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
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
