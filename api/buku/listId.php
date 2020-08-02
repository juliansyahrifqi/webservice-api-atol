<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();
    $db = $database->getKoneksi();

    $buku = new Buku($db);

    $buku->id_buku = isset($_GET['id']) ? $_GET['id'] : die();

    $buku->listId();

    if($buku->judul_buku != null) {
        $buku_arr = array(
            "id_buku" => $buku->id_buku,
            "judul_buku" => $buku->judul_buku,
            "penerbit" => $buku->penerbit,
            "penulis" => $buku->penulis,
            "deskripsi" => $buku->deskripsi,
            "date_created" => $buku->date_created
        );

        http_response_code(200);

        echo json_encode($buku_arr);
    } else {
        http_response_code(404);

        echo json_encode(array("Message" => "Buku Tidak Ditemukan!"));
    }
?>