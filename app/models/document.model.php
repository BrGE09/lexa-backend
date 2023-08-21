<?php

    require_once './app/controllers/documents.controller.php';
    
     class DocumentModel{

   /*==================================
                METODO INSERT
    ===================================*/ 

    public function document(){
    $recibe = new DocumentController();

        $documente_name = $_REQUEST['documente_name'];
        $route = $_REQUEST['route'];
        $file_size = $_REQUEST['file_size'];
        $registration_date = $_REQUEST['registration_date'];
        $record_time = $_REQUEST['record_time'];
        $id_record = 5370000;
        $id_file = 40;

    $recibe->createDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file);

    }

    $inser = new DocumentModel();
    $ins = $upd->document();

    /*==================================
                METODO SELECT
    ===================================*/ 

    public function select(){
    $selecciona = new DocumentController();

        $documente_name = $_REQUEST['documente_name'];
        $route = $_REQUEST['route'];
        $file_size = $_REQUEST['file_size'];
        $registration_date = $_REQUEST['registration_date'];
        $record_time = $_REQUEST['record_time'];
        $id_record = 5370000;
        $id_file = 40;

        $selecciona->viewDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file,  $id_document);
    }

    $select = new DocumentController();
    $sel = $select->select();

    /*==================================
                METODO DELETE
    ===================================*/ 

    public function update(){

        $update = new DocumentController();

        $id_document = $_REQUEST['id_document'];
        $documente_name = $_REQUEST['documente_name'];
        $route = $_REQUEST['route'];
        $file_size = $_REQUEST['file_size'];
        $registration_date = $_REQUEST['registration_date'];
        $record_time = $_REQUEST['record_time'];
        $id_record = 5370000;
        $id_file = 40;
        
        $update->updateDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file, $id_document); //la variable  $update->updateDocumen que hace referencia a este objeto debe ser la misma update con la que creo el objeto

    }
}

$upd = new DocumentModel();
$ud = $upd->update();

?>
