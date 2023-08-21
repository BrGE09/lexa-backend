<?php

    require_once("../controllers/documents.controller.php");
    
    $recibe = new DocumentController();

    $documente_name = $_REQUEST['documente_name'];
    $route = $_REQUEST['route'];
    $file_size = $_REQUEST['file_size'];
    $registration_date = $_REQUEST['registration_date'];
    $record_time = $_REQUEST['record_time'];
    $id_record = 5370000;
    $id_file = 40;

    $recibe->createDocument($documente_name, $route, $file_size, $registration_date, $record_time, $id_record, $id_file);


?>
