<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();
    $db = $database->getKoneksi();

    $buku = new Buku($db);

    $data = json_decode(file_get_contents("php://input"));

    $buku->id_buku = $data->id_buku;

    $buku->judul_buku = $data->judul_buku;
    $buku->penerbit = $data->penerbit;
    $buku->penulis = $data->penulis;
    $buku->deskripsi = $data->deskripsi;
    $buku->date_created = $data->date_created;

    if($buku->update()) {
        http_response_code(200);

        echo json_encode(array("Message" => "Data buku berhasil diupdate"));
    } else {
        http_response_code(503);

        echo json_encode(array("Message" => "Data buku gagal diupdate"));
    }
?>