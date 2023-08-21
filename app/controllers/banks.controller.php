<?php

require_once './database/database.php';

class BankController extends BaseDatos
{

    public function createBank()
    {
    }

    public function viewBanks()
    {

        $query = "SELECT * FROM tbl_banks;";

        $response = $this->consulta($query);

        return $response->fetch_object();
    }

    public function updateBank()
    {
        $query = "UPDATE tbl_banks SET ...;";
        $this->consulta($query);
    }

    public function deleteBank()
    {
    }
}