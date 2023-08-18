<?php

require_once("../../database/database.php");

class RecordsController extends BaseDatos{

    public function createRecord(){

        try {

            $query = "INSERT INTO tbl_records (name, last_name, mother_last_name, birth_date, street, outdoor_number, number, cologne, s) VALUES ()";

            if($this->consulta($query))
            {
                header("Location: ...");
            }

        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    
    }

    public function viewRecord(){

    }

    public function updateRecord(){

    }

    public function deleteRecord(){

    }



}
