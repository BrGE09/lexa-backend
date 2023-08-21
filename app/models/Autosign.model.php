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

    // Obtener del documento firmado.
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
            "Imagen": "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",
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
