<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: POST");
    
    include_once '../config/database.php';
    include_once '../models/buku.php';

    // Instance objek database
    $database = new Database();

    // Koneksi database
    $db = $database->getKoneksi();

    // Instance objek buku
    $buku = new Buku($db);

    // Mendapatkan input json
    $data = json_decode(file_get_contents("php://input"));

    // Jika field tidak kosong
    if(!empty($data->judul) && !empty($data->penulis) && !empty($data->penerbit) 
        && !empty($data->deskripsi) && !empty($data->bahasa) && !empty($data->genre)
        && !empty($data->genre) && !empty($data->jumlah_halaman) && !empty($data->tahun_terbit))  {
       
        // Isi property buku
        $buku->judul = $data->judul;
        $buku->penulis = $data->penulis;
        $buku->penerbit = $data->penerbit;
        $buku->deskripsi = $data->deskripsi;
        $buku->bahasa = $data->bahasa;
        $buku->genre = $data->genre;
        $buku->jumlah_halaman = $data->jumlah_halaman;
        $buku->tahun_terbit = $data->tahun_terbit;

        // Jika proses tambah berhasil ( true )
        if($buku->tambah()) {
            // Set respons kode 201 = created
            http_response_code(201);

            // Tampilkan pesan berhasil
            echo json_encode(array("Message" => "Data Buku Berhasil Ditambahkan"));
        } else {
            // Set respons kode 503 = service unavailable
            http_response_code(503);

            // Tampilkan pesan gagal
            echo json_encode(array("Message" => "Data Buku Gagal Ditambahkan"));
        }
    } else {
        // Jika data / field tidak lengkap
        http_response_code(404);

        // Tampilkan pesan gagal
        echo json_encode(array("Message" => "Gagal! Semua Data Harus Diisi!"));
    }
?>