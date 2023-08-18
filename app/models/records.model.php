<?php

require_once("../controllers/records.controller.php");

$control = new RecordsController();

$ahora = new DateTime('now', new DateTimeZone('America/Mexico_city'));

$nombre      = $_REQUEST["name"];
$apM         = $_REQUEST["last_name"];
$apP         = $_REQUEST["mother_last_name"];
$fNacimiento = $_REQUEST["birth_date"];
$calle       = $_REQUEST["street"];
$noExt       = $_REQUEST["outdoor_number"];
$noInt       = $_REQUEST["number"];
$colonia     = $_REQUEST["cologne"];
$ciudad      = $_REQUEST["city"];
$estado      = $_REQUEST["state"];
$cp          = $_REQUEST["cp"];
$curp        = $_REQUEST["curp"];
$rfc         = $_REQUEST["rfc"];
$lada        = $_REQUEST["lada_number"];
$noTlf       = $_REQUEST["telephone_number"];
$correo      = $_REQUEST["email"];
$nombreCta   = $_REQUEST["name_holder_cb"];
$idBanco     = $_REQUEST["id_banks"];
$clabe       = $_REQUEST["account_clabe_cb"];
$fechaRgtro  = $ahora->format("Y-m-d");
$hrRegistro  = $ahora->format("h:i:s");
$hrAct       = $ahora->format("Y-m-d h:i:s");

$crearNuevo = $control->createRecord($nombre, $apM, $apP, $fNacimiento, $calle, $noExt, $noInt, $colonia, $ciudad, $estado, $cp, $curp,     $rfc, $lada, $noTlf, $correo, $nombreCta, $idBanco, $clabe, $fechaRgtro, $hrRegistro, $hrAct);






?>