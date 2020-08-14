<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    
    include_once '../config/database.php';
    include_once '../objects/buku.php';

    // Instance objek database
    $database = new Database();

    // Koneksi database
    $db = $database->getKoneksi();

    // Instance objek buku
    $buku = new Buku($db);

    // Mengambil data yang akan di edit
    $data = json_decode(file_get_contents("php://input"));

    // Mendapat id buku yang akan diedit
    $buku->id_buku = $data->id_buku;

    // Set nilai yang akan diedit
    $buku->judul_buku = $data->judul_buku;
    $buku->penerbit = $data->penerbit;
    $buku->penulis = $data->penulis;
    $buku->deskripsi = $data->deskripsi;
    $buku->date_created = $data->date_created;

    // Jika update berhasil
    if($buku->update()) {

        // Set respons kode 200 = OK!
        http_response_code(200);

        // Tampilkan pesan berhasil
        echo json_encode(array("Message" => "Data buku berhasil diupdate"));
    } else {
        
        // Jika update gagal
        // Set respons kode 503 = service unavailable
        http_response_code(503);

        // Tampilkan pesan gagal
        echo json_encode(array("Message" => "Data buku gagal diupdate"));
    }
?>