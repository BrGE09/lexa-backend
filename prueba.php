<?php

<<<<<<< HEAD
include_once("app/models/document.model.php");

$recibe = new DocModel();

recibe->newDoc();

?>
=======
require("app/models/Autosign.model.php");

$obj = new AutoSignModel();

$obj->firma();
>>>>>>> df19fdc (Autosign)
