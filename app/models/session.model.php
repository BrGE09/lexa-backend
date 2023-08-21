<?php

require_once("../controllers/session.controller.php");

 class SessionModel{

      /*==================================
                METODO UPDATE
    ===================================*/ 

    public function select(){

        $select = new sessionController();
        
        $id_credentials = $_REQUEST['id_credentials'];
        $user = $_REQUEST['user'];
        $password = $_REQUEST['password'];
        $id_record = $_REQUEST['id_record'];
        $registration_date = $_REQUEST['registration_date'];
        $record_time = $_REQUEST['record_time'];

        $select->mostrarDatos($id_credentials, $user, $password, $id_record, $registration_date, $record_time);    
    } 

$sell = new SessionModel();
$sele = $selj->select();


      /*==================================
                METODO UPDATE
    ===================================*/ 
    public function session(){

        $recibe = new sessionController();
        
        $id_credentials = $_REQUEST['id_credentials'];
        $user = $_REQUEST['user'];
        $password = $_REQUEST['password'];
        $id_record = $_REQUEST['id_record'];
        $registration_date = $_REQUEST['registration_date'];
        $record_time = $_REQUEST['record_time'];

        $recibe->updateSession($id_credentials, $user, $password, $id_record, $registration_date, $record_time);    
    } 
}

$rec = new SessionModel();
$bj = $rec->session();

?>