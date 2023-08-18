<?php

require_once("../../database/database.php");

class VoucherController extends BaseDatos
{

    public function createVoucher($folio, $cia, $sourceAccount, $noPartner, $partner, $banco, $idBanco, $cuentaBanco, $clabe, $importe, $fecha, $estado, $fase, $diaPago){

        try {

            $query = "INSERT INTO tbl_voucher (folio, cia, source_account, no_partner, partner, bank, id_bank, bank_account, clabe, import, voucher_date, status, phase, pay_date) VALUES ('$folio', '$cia', '$sourceAccount', '$noPartner', '$partner', '$banco', '$idBanco', '$cuentaBanco', '$clabe', '$importe', '$fecha', '$estado', '$fase', '$diaPago')";

            if ($this->consulta($query)) {
                header("Location: ...");
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function generateVoucher($folio)
    {

        try {
            $query = "SELECT folio, partner, import FROM tbl_voucher WHERE folio = $folio;";

            $response = $this->consulta($query);

            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }
}
