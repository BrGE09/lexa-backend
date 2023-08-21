<?php

require_once './database/database.php';

class DeviceController extends BaseDatos
{

    public function createDevice($mac, $ip, $device, $fchRgtro, $hrRgtro, $recTime, $credential, $status){

        try {

            $query = "INSERT INTO tbl_device (mac_address, adress_ip, device_type, registration_date, registration_time, record_time, id_credential, id_status) VALUES ('$mac', '$ip', '$device', '$fchRgtro', '$hrRgtro', '$recTime', '$credential', '$status')";

            if ($this->consulta($query)) {
                header("Location: ...");
            }
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado:" . $e);
        }
    }

    public function viewDevice($id)
    {

        try {
            $query = "SELECT * FROM tbl_device WHERE id_device = $id;";

            $response = $this->consulta($query);

            return $response->fetch_object();
        } catch (Exception $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }

    public function updateDevice()
    {
        try {
            //code...
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function deleteDevice($id)
    {

        try {
            $query = "DELETE FROM tbl_credentials WHERE id_record = $id;";
            $this->consulta($query);
        } catch (\Throwable $e) {
            echo ("Error: Ocurrió un error inesperado: " . $e);
        }
    }
}