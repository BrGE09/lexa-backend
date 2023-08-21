<?php

require_once './app/controllers/banks.controller.php';

class BanksModel{

    public function ver(){
        $obj = new BankController();

        $obj->viewBanks();
    }

}