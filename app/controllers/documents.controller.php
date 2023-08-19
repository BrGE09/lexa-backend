<?php

require_once("../../database/database.php");

class DocumentController extends BaseDatos
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

        try {
            $query = "SELECT * FROM  id_document WHERE id_document = $id";

            $response = $this->consulta($query);

            return $response->fetch_object();

        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function updateDocument($id){

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function deleteDocument($id){

        try {
        $query = "DELETE FROM tbl_records WHERE id_document = $id";
        $response = $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);

        }

    }
}


?>