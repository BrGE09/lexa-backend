<?php
require_once './vendor/autoload.php';
include_once "./config/timezone.php";
require_once './app/controllers/records.controller.php';
require_once './app/controllers/credentials.controller.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CorreoModel
{

    public function verif()
    {
        $id = $_REQUEST["id"];

        $obj = new RecordsController();
        $cdt = new CredentialsController();

        $datos = $obj->viewRecord($id);
        $fechas = new DateTime();

        $dateRegister  = $fechas->format("Y-m-d");
        $timeRegister  = $fechas->format("h:i:s");

        // Generate a random username
        $username = $datos->name . '_' . uniqid();

        // Generate a random password
        $password = bin2hex(random_bytes(8)); // Generates an 8-character random password in hexadecimal format

        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jonatansamuelamarojuarez@gmail.com'; // Correo de la empresa
            $mail->Password = 'vamtznwzjztvvxbk'; // Contraseña del correo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('jonatansamuelamarojuarez@gmail.com', 'Islas Gower & Compañia Sucesores'); //Correo de la empresa y su nombre
            $mail->addAddress($datos->email); 

            $mail->isHTML(true);
            $mail->Subject = 'Credenciales de acceso a Islas Gower & Compañia Sucesores';
            $mail->Body = '<h1><b>Bienvenido a Islas Gower & Compañia Sucesores.</b></h1> <br><br> Aquí están tus credenciales de acceso: <br> Usuario: ' . $username . '<br> Contraseña: ' . $password . '<br><br> Link de acceso: <br> http://localhost/formulario-islas/login/login.php';

            $mail->send();
            echo 'CORREO ENVIADO';


            $cdt->createCredential($username, $password, $id, $dateRegister, $timeRegister);
        } catch (Exception $e) {
            echo 'Error al enviar el correo: ' . $e;
        }
    }
}
