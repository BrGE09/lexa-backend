<?php

require_once("../controllers/banks.controller.php");

class BanksModel{

    public function ver(){
        $obj = new BankController();

        $obj->viewBanks();
    }

}