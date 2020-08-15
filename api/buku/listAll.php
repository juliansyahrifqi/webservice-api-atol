<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../models/buku.php';

    // Instance database
    $database = new Database();
    
    // Class koneksi db
    $db = $database->getKoneksi();

    // Instance buku
    $buku = new Buku($db);  

    // query buku
    $stmt = $buku->listAll();
    $num = $stmt->rowCount();

    // Jika ditemukan record lebih dari 0
    if($num > 0) {
        // Array buku
        $buku_arr = array();
        $buku_arr["buku"] = array();

        // Mendapatkan data dari tabel database
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // Mendapatkan data buku
            $buku_item = array(
                "id_buku" => $row['id_buku'],
                "judul" => $row['judul'],
                "penulis" => $row['penerbit'],
                "penerbit" => $row['penulis'],
                "deskripsi" => $row['deskripsi'],
                "bahasa" => $row['bahasa'],
                "genre" => $row['genre'],
                "jumlah_halaman" => $row['jumlah_halaman'],
                "tahun_terbit" => $row['tahun_terbit']
            );

            // Tambahkan data ke record array
            array_push($buku_arr["buku"], $buku_item);
        }

        // set respons kode 200 = OK
        http_response_code(200);

        // Tampilkan data json dari array buku
        echo json_encode($buku_arr);
    } else {
        // set respons kode 404 = Not Found
        http_response_code(404);

        // Tampilkan pesan
        echo json_encode(array("message" => "Belum ada data buku"));
    }
?>