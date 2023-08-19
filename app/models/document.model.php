<?php

require_once("../controllers/documents.controller.php");

class DocumentModel
{
    public function newDocument()
    {

        $dname    = $_REQUEST[""];
        $rout     = $_REQUEST[""];
        $flSize   = $_REQUEST[""];
        $reg_date = $_REQUEST[""];
        $rd_time  = $_REQUEST[""];
        $idRd     = $_REQUEST[""];
        $idF      = $_REQUEST[""];

        $obj = new DocumentController();

        $obj->createDocument($dname, $rout, $flSize, $reg_date, $rd_time, $idRd, $idF);
    }
}
