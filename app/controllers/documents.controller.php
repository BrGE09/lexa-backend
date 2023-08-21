<?php

require_once("./database/database.php");

class DocumentController extends BaseDatos
{
    public function createDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file)
    {
        try {
            $query = "INSERT INTO tbl_document (document_name, route, file_size, registration_date, record_time, id_record, id_file) 
                      VALUES ('$documente_name', '$route', '$file_size', '$registration_date', '$record_time', '$id_record', '$id_file')";

            if ($this->consulta($query)) {
                header("Location: /Lexa-Backend/document.php?message=Datos guardados"); //Importante: asegúrate de terminar el script después de la redirección
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e->getMessage());
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