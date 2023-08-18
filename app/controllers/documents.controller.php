<?php

require_once("../../database/database.php");

class RecordsController extends BaseDatos
{
    public function createDocument($dname, $rout, $flSize, $reg_date, $rd_time, $idRd, $idFl){


        try {
            $query = "INSERT INTO  tbl_document (id_document, documente_name, route, file_size, registration_date, record_time, id_record, id_file) VALUES ('$dname','$rout', '$flSize','$reg_date','$rd_time','$idRd','$idFl')";

            if ($this->consulta($query)) {
                header("Location: ...");
            }
        } catch (Exception $e ) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function viewDocument($id){

    }

    public function updateDocument($id){

    }

    public function deleteDocument($id){

    }
}


?>