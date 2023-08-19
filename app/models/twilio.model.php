<?php
require '../../vendor/autoload.php';
require_once("../controllers/records.controller.php");
use Twilio\Rest\Client;

class Verificacion
{
    private $sid     = "AC6714f234ca7b5128d3e852dc9ae668ab";
    private $token   = "f2d555d22d2c36b4c45704de92a6aba6";
    private $service = "VA6d28ce87426873c6487387eab696a755";

    public function verificarNumero($lada, $numero)
    {
        $twilio = new Client($this->sid, $this->token);

        if (isset($lada, $numero)) {
            $twilio->verify->v2->services($this->service)
                ->verifications
                ->create($lada . $numero, "sms");
        } else {
            echo ("Verifique su número y/o lada y vuelva a intentarlo.");
        }
    }

    public function validarCodigo($id, $lada, $numero, $codigo)
    {
        $obj    = new RecordsController();
        $twilio = new Client($this->sid, $this->token);

        if (isset($lada, $numero, $codigo)) {
            $verification_check = $twilio->verify->v2->services($this->service)
                ->verificationChecks
                ->create(
                    [
                        "to" => $lada . $numero,
                        "code" => $codigo
                    ]
                );

            if ($verification_check->status === "approved") {
                // $obj->verificaciones();
                return header("Location: ...");
            }
        } else {
            return header("Location: ...");
        }
    }
}

?>