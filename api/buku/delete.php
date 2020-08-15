<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");

    include_once '../config/database.php';
    include_once '../models/buku.php';

    // Instance database
    $database = new Database();

    // Koneksi ke database
    $db = $database->getKoneksi();

    // Instance buku
    $buku = new Buku($db);  

    // Mendapatkan data inputan
    $data = json_decode(file_get_contents("php://input"));

    $buku->id_buku = $data->id_buku;

    // Jika buku berhasil dihapus
    if($buku->delete()) {
        // set respons kode 200 = OK!
        http_response_code(200);

        // Tampilkan pesan berhasil
        echo json_encode(array("Message" => "Data buku berhasil dihapus"));
    } else {
        // set response kode 503 = service unavailable
        http_response_code(503);

        // Tampilkan pesan gagal
        echo json_encode(array("Message" => "Data buku gagal dihapus"));
    }
?>