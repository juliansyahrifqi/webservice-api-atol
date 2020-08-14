<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    // Instance database
    $database = new Database();
    
    // Class koneksi ke database
    $db = $database->getKoneksi();

    // Instance buku
    $buku = new Buku($db);

    // Set id_buku untuk mendapatkan data yang akan ditampilkan
    $buku->id_buku = isset($_GET['id']) ? $_GET['id'] : die();

    // Method tampilkan data buku berdasarkan id
    $buku->listId();

    if($buku->judul_buku != null) {

        // Array buku
        $buku_arr = array(
            "id_buku" => $buku->id_buku,
            "judul_buku" => $buku->judul_buku,
            "penerbit" => $buku->penerbit,
            "penulis" => $buku->penulis,
            "deskripsi" => $buku->deskripsi,
            "date_created" => $buku->date_created
        );

        // Set response kode 200 = OK!
        http_response_code(200);

        // Format array menjadi json
        echo json_encode($buku_arr);
    } else {
        // Set response kode 404 = Not Found
        http_response_code(404);

        // Tampilkan pesan buku tidak ditemukan
        echo json_encode(array("Message" => "Data buku Tidak Ditemukan!"));
    }
?>