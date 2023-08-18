<?php
include_once("resources/views/layout.php");
?>
<body>
<form action="controllers/records.controller.php" method="POST" name="records.php">

    <div>
    <label for="name">name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
    <label for="name">last_name</label>
        <input type="text" id="last_name" name="last_name">
    </div>
    <div>
    <label for="name">mother_last_name</label>
        <input type="text" id="mother_last_name" name="mother_last_name">
    </div>
    <div>
    <label for="name">birth_date</label>
        <input type="text" id="birth_date" name="birth_date">
    </div>
    <div>
    <label for="name">street</label>
        <input type="text" id="street" name="street">
    </div>
    <div>
    <label for="name">outdoor_number</label>
        <input type="text" id="outdoor_number" name="outdoor_number">
    </div>
    <div>
    <label for="name">number</label>
        <input type="text" id="number" name="number">
    </div>
    <div>
    <label for="name">cologne</label>
        <input type="text" id="cologne" name="cologne">
    </div>
    <div>
    <label for="name">city</label>
        <input type="text" id="city" name="city">
    </div>
    <div>
    <label for="name">state</label>
        <input type="text" id="state" name="state">
    </div>
    <div>
    <label for="name">cp</label>
        <input type="text" id="cp" name="cp">
    </div>
    <div>
    <label for="name">curp</label>
        <input type="text" id="curp" name="curp">
    </div>
    <div>
    <label for="name">rfc</label>
        <input type="text" id="rfc" name="rfc">
    </div>
    <div>
    <div>
    <label for="name">telephone_number</label>
        <input type="text" id="telephone_number" name="telephone_number">
    </div>
    <div>
    <label for="name">email</label>
        <input type="text" id="email" name="email">
    </div>
    <div>
    <label for="name">name_holder_cb</label>
        <input type="text" id="name_holder_cb" name="name_holder_cb">
    </div>
    <div>
    <label for="name">id_banks</label>
        <input type="text" id="id_banks" name="id_banks">
    </div>
    <div>
    <label for="name">account_clabe_cb</label>
        <input type="text" id="account_clabe_cb" name="account_clabe_cb">
    </div>
    <div>
    <label for="name">id_status_signature</label>
        <input type="text" id="id_status_signature" name="id_status_signature">
    </div>
    <label for="name">digital_signature</label>
        <input type="text" id="digital_signature" name="digital_signature">
    </div>
    <div>
    <label for="name">document_path</label>
        <input type="text" id="document_path" name="document_path">
    </div>
    <div>
    <label for="name">id_status_record</label>
        <input type="text" id="id_status_record" name="id_status_record">
    </div>
    <div>
    <label for="name">id_rol</label>
        <input type="text" id="id_rol" name="id_rol">
    </div>
    <input type="submit" class="btn btn-primary" value="guardar datos"></input>
    </form>
</body>
</html>
