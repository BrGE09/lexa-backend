<?php
include_once("resources/views/layout.php");
?>

<body>
    <form action="app/models/records.model.php" method="POST">

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
            <input type="date" id="birth_date" name="birth_date">
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
                <label for="name">lada_number</label>
                <input type="text" id="lada_number" name="lada_number">
            </div>
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
        <button type="submit" class="btn btn-primary" value="guardar datos">Guardar datos</button>
    </form>
</body>

</html>