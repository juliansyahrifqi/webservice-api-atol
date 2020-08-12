<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();

    $db = $database->getKoneksi();

    $buku = new Buku($db);  

    $data = json_decode(file_get_contents("php://input"));

    $buku->id_buku = $data->id_buku;

    if($buku->delete()) {
        http_response_code(200);

        echo json_encode(array("Message" => "Data buku berhasil dihapus"));
    } else {
        http_response_code(503);

        echo json_encode(array("Message" => "Data buku gagal dihapus"));
    }
?>