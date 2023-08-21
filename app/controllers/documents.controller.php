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
                header("Location: /Lexa-Backend/document.php?message=Datos guardados");
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e->getMessage());
        }
    }

    public function viewDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file){

        try {
            $query = "SELECT * FROM  id_document WHERE id_document = $documente_name";
            $response = $this->consulta($query);
            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function updateDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file, $id_document ){

        try {
            $query = "UPDATE tbl_document SET document_name='$documente_name',route='$route',file_size='$file_size',registration_date='$registration_date',record_time ='$record_time', id_record ='$id_record', id_file ='$id_file' WHERE id_document = '$id_document'";
            $this->consulta($query);
        } catch (Exception $e) {
            echo("Error: Ocurrió un error inesperado: " .$e);
        }

    }

    public function deleteDocument($documente_name){

        try {
        $query = "DELETE FROM tbl_records WHERE id_document = $documente_name";
        $response = $this->consulta($query);
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);

        }

    }
}
?>