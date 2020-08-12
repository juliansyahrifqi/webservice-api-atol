<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../objects/buku.php';

    $database = new Database();

    $db = $database->getKoneksi();

    $buku = new Buku($db);

    $keywords = isset($_GET["s"]) ? $_GET["s"] : "";

    $stmt = $buku->search($keywords);
    $num = $stmt->rowCount();

    if($num > 0) {
        $buku_arr = array();
        $buku_arr["records"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $buku_item = array(
                "id_buku" => $id_buku,
                "judul_buku" => $judul_buku,
                "penerbit" => $penerbit,
                "penulis" => $penulis,
                "deskripsi" => html_entity_decode($deskripsi),
                "date_created" => $date_created
            );

            array_push($buku_arr["records"], $buku_item);
        }

        http_response_code(200);

        echo json_encode($buku_arr);
    } else {
        http_response_code(404);

        echo json_encode(array("Message" => "Data buku yang dicari tidak ditemukan!"));
    }
?>