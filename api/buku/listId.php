<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../models/buku.php';

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

    if($buku->judul != null) {

        // Array buku
        $buku_arr = array(
            "id_buku" => $buku->id_buku,
            "judul" => $buku->judul,
            "penulis" => $buku->penerbit,
            "penerbit" => $buku->penulis,
            "deskripsi" => $buku->deskripsi,
            "bahasa" => $buku->bahasa,
            "genre" => $buku->genre,
            "jumlah_halaman" => $buku->jumlah_halaman,
            "tahun_terbit" => $buku->tahun_terbit
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