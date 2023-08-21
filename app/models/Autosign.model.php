<?php

require_once "./app/controllers/records.controller.php";
require_once "./app/controllers/documents.controller.php";

class AutoSignModel
{

    private $auth = "OUQ2NEJDN0QtM0VDQi00MTI5LTk1QTItNjQ2Njc1OEEyMzdEOkNEOTIyQUMxLTYwQzctNDUwQi05QzM2LTQxOTIyRUVEM0NGOQ==";
    private $token;


    // Constuctor de la clase para generar el token cada que la misma sea invocada automáticamente.
    function __construct()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oauth-autosign.doc2sign.com/OAuth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('grant_type' => 'client_credentials', 'ambiente' => '1'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $this->auth
            ),
        ));

        $response = curl_exec($curl);

        $datos = json_decode($response, true);

        return $this->token = $datos["access_token"];

        curl_close($curl);
    }

    // Obtener el documento firmado.
    private function documentoFirmado()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wstestautosign.doc2sign.com/RESTDoc2SignLite/GETDocFirmado?Identificador=123&ambiente=0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $array_data = json_decode($response, true);
        $base = $array_data['GETDocFirmadoResult'];
        $base64PDF = $base;

        if ($decodedPDF = base64_decode($base64PDF, true)) {
            $filename = 'archivo_' . uniqid() . '.pdf';
            $file_path = './pdf/' . $filename;
            if (!is_dir('./pdf')) {
                mkdir('./pdf', 0755, true);
            }
            if (file_put_contents($file_path, $decodedPDF)) {

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_path));
                readfile($file_path);
                unlink($file_path);

                exit;
            } else {
                echo "Error al guardar el archivo PDF.";
            }
        } else {
            echo "El contenido Base64 del PDF es inválido.";
        }
    }

    // Conversión del archivo en Base64
    private function file_to_base64($pathArchivo)
    {
        $file_content = file_get_contents($pathArchivo);
        $base64_string = base64_encode($file_content);
        return $base64_string;
    }

    // Función a utilizar para crear la firma del documento.
    public function firma()
    {

        $idUsuario = $_GET["id"];

        if (isset($idUsuario) && is_numeric($idUsuario)) {
            $id = intval($idUsuario);

            $obj = new RecordsController();
            $doc = new DocumentController();

            $row        = $obj->viewRecord($id);
            $rowArchivo = $doc->viewDocument($id);

            $nombre = $row->nombre;
            $aMaterno = $row->mother_last_name;
            $aPaterno = $row->last_name;
            $rfc = $row->rfc;
            $correo = $row->email;
            $imagenB64 = "b64";

            $pathArchivo = $rowArchivo->route;

            $base64_string = $this->file_to_base64($pathArchivo);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wstestautosign.doc2sign.com/RESTDoc2SignLite/LoadMultipleOES',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "Identificador": "' . $idUsuario . '",
            "Firmantes": [{
            "ApPaterno": "' . $aPaterno . '",
            "ApMaterno": "' . $aMaterno . '",
            "Email": "' . $correo . '",
            "Identificacion": "INE",
            "Imagen": "'.$imagenB64.'",
            "Leyenda": "LEXA Consulting",
            "NombreDocumento": "Contrato para socios",
            "Nombres": "' . $nombre . '",
            "NumeroIdentificacion": "123",
            "Pagina": -1,
            "PosX": -1240,
            "PosY": -10,
            "RFC": "' . $rfc . '",
            "Ubicacion": "0"
            }
        ],
        "FirmaEmpresa": [{
            "ApPaterno": "",
            "ApMaterno": "",
            "Email": "",
            "Identificacion": "",
            "Imagen": "",
            "Leyenda": "",
            "NombreDocumento": "",
            "Nombres": "",
            "NumeroIdentificacion": "",
            "Pagina": 0,
            "PosX": 0,
            "PosY": 0,
            "RFC": "",
            "Ubicacion": "0"
        }],
         "DocumentoBase64": "' . $base64_string . '",
        "MostrarFirmas": 1,
        "AgregarFirmaEmpresa": false
            }
        ',
            CURLOPT_HTTPHEADER => array(
                'ambiente: 0',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            ),
        ));

        $response = curl_exec($curl);

        if ($response != null) {
            $this->documentoFirmado();
        } else {
            echo ("Ocurrió un error al firmar el documento, intente de nuevo más tarde.");
        }


        curl_close($curl);
    }
}
