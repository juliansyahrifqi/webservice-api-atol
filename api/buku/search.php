<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../models/buku.php';
    
    // Instance database
    $database = new Database();
    
    // Koneksi database
    $db = $database->getKoneksi();
    
    // Instance objek buku
    $buku = new Buku($db);
    
    // Mendapatkan keyword untuk data yang akan dicari
    $keywords=isset($_GET["s"]) ? $_GET["s"] : "";
    
    // Query 
    $stmt = $buku->search($keywords);
    $num = $stmt->rowCount();
    
    // Jika record data lebih dari 0
    if($num>0){
    
        // Buat array buku 
        $buku_arr=array();
        $buku_arr["buku"]=array();
    
        // Mengambil data dari tabel
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
            $buku_item = array(
                "id_buku" => $row['id_buku'],
                "judul" => $row['judul'],
                "penulis" => $row['penulis'],
                "penerbit" => $row['penerbit'],
                "deksripsi" => $row['deskripsi'],
                "bahasa" => $row['bahasa'],
                "genre" => $row['genre'],
                "jumlah_halaman" => $row['jumlah_halaman'],
                "tahun_terbit" => $row['tahun_terbit']
            );
    
            // Tambahkan data ke array
            array_push($buku_arr["buku"], $buku_item);
        }
    
        // Set respons kode 200 = OK!
        http_response_code(200);
    
        // Format array ke json
        echo json_encode($buku_arr);
    } else {
        // Jika data tidak ada
        // Set respons kode 404 = not found
        http_response_code(404);
    
        // Tampilkan pesan
        echo json_encode(array("Message" => "Data buku tidak ditemukan"));
    }
?>