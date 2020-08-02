<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();
    $db = $database->getKoneksi();

    $buku = new Buku($db);  

    $stmt = $buku->tampil();
    $num = $stmt->rowCount();

    if($num > 0) {
        $buku_arr = array();
        $buku_arr["buku"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $buku_item = array(
                "id_buku" => $id_buku,
                "judul_buku" => $judul_buku,
                "penerbit" => $penerbit,
                "penulis" => $penulis,
                "deskripsi" => $deskripsi,
                "date_created" => $date_created
            );

            array_push($buku_arr["buku"], $buku_item);
        }

        http_response_code(200);

        echo json_encode($buku_arr);
    } else {
        http_response_code(404);

        echo json_encode(array("message" => "Produk tidak ditemukan"));
    }
?>