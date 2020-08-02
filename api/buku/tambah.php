<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: POST");
    header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();
    $db = $database->getKoneksi();

    $buku = new Buku($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->judul_buku) && !empty($data->penerbit) && !empty($data->penulis) && !empty($data->deskripsi)) {
        $buku->judul_buku = $data->judul_buku;
        $buku->penerbit = $data->penerbit;
        $buku->penulis = $data->penulis;
        $buku->deksripsi = $data->deskripsi;
        $buku->date_created = date('Y-m-d H:i:s');

        if($buku->tambah()) {
            http_response_code(201);

            echo json_encode(array("Message" => "Data Buku Berhasil Ditambahkan"));
        } else {
            http_response_code(503);

            echo json_encode(array("Message" => "Data Buku Gagal Ditambahkan"));
        }
    } else {
        http_response_code(400);

        echo json_encode(array("Message" => "Gagal! Semua Data Harus Diisi!"));
    }
?>